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
     * 4.6 分账接收方查询
     *
     * @throws GuzzleException
     * @throws JsonException
     */
    public function sendMerchRevQueryRequest(string $mchId): array
    {
        $data = $this->client->filterNullValues([
            'mch_id' => $mchId,
        ]);

        return $this->client->sendRequest('fund/ledger/api/merch/rev/query', $data);
    }

    /**
     * 4.7 绑定分账接收方
     *
     * @throws GuzzleException
     * @throws JsonException
     */
    public function sendMerchRevBindRequest(string $mchId, string $revMchId, string $notifyUrl, array $sourceIds): array
    {
        $data = $this->client->filterNullValues([
            'mch_id' => $mchId,
            'rev_mch_id' => $revMchId,
            'notify_url' => $notifyUrl,
            'source_ids' => $sourceIds,
        ]);

        return $this->client->sendRequest('fund/ledger/api/merch/rev/bind', $data);
    }

    /**
     * 4.8 解绑分账接收方
     *
     * @throws GuzzleException
     * @throws JsonException
     */
    public function sendMerchRevUnBindRequest(string $mchId, string $revMchId): array
    {
        $data = $this->client->filterNullValues([
            'mch_id' => $mchId,
            'rev_mch_id' => $revMchId,
        ]);

        return $this->client->sendRequest('fund/ledger/api/merch/rev/unbind', $data);
    }

    /**
     * 4.9 绑定关系查询
     *
     * @throws GuzzleException
     * @throws JsonException
     */
    public function sendMerchRevBindQueryRequest(string $mchId, string $revMchId): array
    {
        $data = $this->client->filterNullValues([
            'mch_id' => $mchId,
            'rev_mch_id' => $revMchId,
        ]);

        return $this->client->sendRequest('fund/ledger/api/merch/rev/bind/query', $data);
    }

    /**
     * 4.10 文件上传
     *
     * @throws GuzzleException
     * @throws JsonException
     */
    public function sendMerchFileUploadRequest(string $fileBase64): array
    {
        $data = $this->client->filterNullValues([
            'file_base64' => $fileBase64,
        ]);

        return $this->client->sendRequest('fund/ledger/api/merch/file/upload', $data);
    }

    /**
     * 5.1 分账交易请求
     *
     * @throws GuzzleException
     * @throws JsonException
     */
    public function sendOrderSplitRequest(
        string $mchId,
        string $outOrderNo,
        string $transactionId,
        int $totalAmount,
        array $receivers
    ): array {
        $data = $this->client->filterNullValues([
            'mch_id' => $mchId,
            'out_order_no' => $outOrderNo,
            'transaction_id' => $transactionId,
            'total_amount' => $totalAmount,
            'receivers' => $receivers,
        ]);

        return $this->client->sendRequest('fund/ledger/api/order/split', $data);
    }

    /**
     * 5.2 分账交易结果查询
     *
     * @throws GuzzleException
     * @throws JsonException
     */
    public function sendOrderSplitQueryRequest(
        string $mchId,
        ?string $outOrderNo = null,
        ?string $orderNo = null
    ): array {
        $data = $this->client->filterNullValues([
            'mch_id' => $mchId,
            'order_no' => $orderNo,
            'out_order_no' => $outOrderNo,
        ]);

        return $this->client->sendRequest('fund/ledger/api/order/split/query', $data);
    }

    /**
     * 5.3 分账回退请求
     *
     * @throws GuzzleException
     * @throws JsonException
     */
    public function sendOrderRefundRequest(
        string $mchId,
        string $outReturnNo,
        string $revMchId,
        int $amount,
        ?string $outOrderNo = null,
        ?string $orderNo = null,
        ?string $description = null
    ): array {
        $data = $this->client->filterNullValues([
            'mch_id' => $mchId,
            'order_no' => $orderNo,
            'out_order_no' => $outOrderNo,
            'out_return_no' => $outReturnNo,
            'rev_mch_id' => $revMchId,
            'amount' => $amount,
            'description' => $description,
        ]);

        return $this->client->sendRequest('fund/ledger/api/order/refund', $data);
    }

    /**
     * 5.4 分账回退结果查询
     *
     * @throws GuzzleException
     * @throws JsonException
     */
    public function sendOrderRefundQueryRequest(
        string $mchId,
        ?string $outReturnNo = null,
        ?string $returnNo = null,
    ): array {
        $data = $this->client->filterNullValues([
            'mch_id' => $mchId,
            'return_no' => $returnNo,
            'out_return_no' => $outReturnNo,
        ]);

        return $this->client->sendRequest('fund/ledger/api/order/refund/query', $data);
    }

    /**
     * 5.5 交易订单查询
     *
     * @throws GuzzleException
     * @throws JsonException
     */
    public function sendOrderTransQueryRequest(
        string $mchId,
        string $transactionId
    ): array {
        $data = $this->client->filterNullValues([
            'mch_id' => $mchId,
            'transaction_id' => $transactionId,
        ]);

        return $this->client->sendRequest('fund/ledger/api/order/trans/query', $data);
    }
}
