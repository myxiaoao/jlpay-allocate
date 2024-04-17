<?php

declare(strict_types=1);

namespace Cooper\JlPayAllocate;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use JsonException;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use RuntimeException;

class Client
{
    public const BASE_URL = 'https://api.jlpay.com/';

    public const UAT_BASE_URL = 'https://api-uat.jlpay.com/';

    private string $baseUrl;

    private string $orgCode;

    private GuzzleClient $client;

    private Signature $signature;

    public function __construct(
        string $publicKey,
        string $privateKey,
        string $orgCode,
        bool $uat = false,
        array $options = []
    ) {
        date_default_timezone_set('Asia/Shanghai');

        $this->signature = new Signature($publicKey, $privateKey);
        $this->orgCode = $orgCode;
        $this->baseUrl = $uat ? self::UAT_BASE_URL : self::BASE_URL;
        $this->client = $this->getGuzzleClient($options);
    }

    private function getGuzzleClient($options): GuzzleClient
    {
        if (isset($options['logger']['path']) && is_array($options['logger'])) {
            $logger = new Logger($options['logger']['name'] ?? 'jlpay-allocate');
            $logger->pushHandler(
                new RotatingFileHandler($options['logger']['path'], $options['logger']['day'] ?? 30)
            );

            $stack = HandlerStack::create();
            $stack->push(
                Middleware::log(
                    $logger,
                    new MessageFormatter('{method} - {target} - HTTP/{version} - {code} - {req_body} - {res_body}')
                )
            );

            return new GuzzleClient(['handler' => $stack]);
        }

        return new GuzzleClient();
    }

    public function filterNullValues(array $data): array
    {
        return array_filter($data, function ($value) {
            return $value !== null;
        });
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function sendRequest(string $endpoint, array $data): array
    {
        $url = $this->baseUrl.ltrim($endpoint, '/');

        $data['org_code'] = $this->orgCode;
        $data['timestamp'] = date('Y-m-d H:i:s');
        $data['nonce_str'] = substr(bin2hex(random_bytes(16)), 0, 8);
        $data['sign_type'] = 'SM3WithSM2WithDer';

        $sign = $this->sign($data);
        $preg_replace = preg_replace('/[\r\n]/', '', $sign);
        $data['sign'] = $preg_replace;

        $response = $this->client->request('POST', $url, [
            'json' => $data,
            'headers' => ['Content-Type' => 'application/json'],
        ]);

        $body = json_decode((string) $response->getBody(), true, 512, JSON_THROW_ON_ERROR);

        $sign = $body['sign'] ?? '';
        if ($sign !== '') {
            $toSortedQueryString = $this->toSortedQueryString($body);
            $verify = $this->signature->verify($toSortedQueryString, $sign);
            if (! $verify) {
                throw new RuntimeException('签名检校失败');
            }
        }

        return $body;
    }

    /**
     * @throws JsonException
     */
    private function sign(array $data): string
    {
        return $this->signature->sign($this->toSortedQueryString($data));
    }

    /**
     * @throws JsonException
     */
    private function toSortedQueryString(array $properties): string
    {
        unset($properties['sign']);
        ksort($properties);
        $queryString = '';
        foreach ($properties as $key => $value) {
            if ($value !== null && $value !== '') {
                if ($queryString !== '') {
                    $queryString .= '&';
                }
                $tempValue = $value;
                if (is_object($value) || is_array($value)) {
                    $tempValue = json_encode($value, JSON_THROW_ON_ERROR);
                }
                $queryString .= "$key=$tempValue";
            }
        }

        return $queryString;
    }
}
