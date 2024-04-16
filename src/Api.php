<?php

namespace Cooper\JlPayAllocate;

use GuzzleHttp\Exception\GuzzleException;
use JsonException;

class Api
{
    private Client $client;

    public function __construct(string $publicKey, string $privateKey, string $orgCode, bool $uat = false)
    {
        $this->client = new Client($publicKey, $privateKey, $orgCode, $uat);
    }

    /**
     * 4.1 分账业务开通
     *
     * @throws GuzzleException
     * @throws JsonException
     */
    public function sendMerchIssueOpenRequest(
        string $mchId,
        string $ledgerModule,
        int $maxSplitRate,
        array $sourceIds
    ): array {
        $data = $this->client->filterNullValues([
            'mch_id' => $mchId,
            'ledger_module' => $ledgerModule,
            'max_split_rate' => $maxSplitRate,
            'source_ids' => $sourceIds,
        ]);

        return $this->client->sendRequest('fund/ledger/api/merch/issue/open', $data);
    }

    /**
     * 4.2 分账业务信息变更
     *
     * @throws GuzzleException
     * @throws JsonException
     */
    public function sendMerchIssueUpdateRequest(
        string $mchId,
        ?string $ledgerModule = null,
        ?int $maxSplitRate = null,
        ?array $sourceIds = null
    ): array {
        $data = $this->client->filterNullValues([
            'mch_id' => $mchId,
            'ledger_module' => $ledgerModule,
            'max_split_rate' => $maxSplitRate,
            'source_ids' => $sourceIds,
        ]);

        return $this->client->sendRequest('fund/ledger/api/merch/issue/update', $data);
    }

    /**
     * 4.3 分账业务信息查询
     *
     * @throws GuzzleException
     * @throws JsonException
     */
    public function sendMerchIssueQueryRequest(string $mchId): array
    {
        $data = $this->client->filterNullValues([
            'mch_id' => $mchId,
        ]);

        return $this->client->sendRequest('fund/ledger/api/merch/issue/query', $data);
    }

    /**
     * 5.2 分账交易结果查询
     *
     * @throws GuzzleException
     * @throws JsonException
     */
    public function sendOrderSplitRequest(string $mchId, ?string $outOrderNo = null, ?string $orderNo = null): array
    {
        $data = $this->client->filterNullValues([
            'mch_id' => $mchId,
            'order_no' => $orderNo,
            'out_order_no' => $outOrderNo,
        ]);

        return $this->client->sendRequest('fund/ledger/api/order/split/query', $data);
    }
}
