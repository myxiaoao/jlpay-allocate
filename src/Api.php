<?php

declare(strict_types=1);

namespace Cooper\JlPayAllocate;

use GuzzleHttp\Exception\GuzzleException;
use JsonException;

class Api
{
    private Client $client;

    public function __construct(
        string $publicKey,
        string $privateKey,
        string $orgCode,
        bool $uat = false,
        array $options = []
    ) {
        $this->client = new Client($publicKey, $privateKey, $orgCode, $uat, $options);
    }

    public static function make(array $config): self
    {
        return new self(
            $config['public_key'],
            $config['private_key'],
            $config['org_code'],
            $config['uat'] ?? false,
            $config['options'] ?? []
        );
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
     * 4.4 接收方开户
     *
     * @throws GuzzleException
     * @throws JsonException
     */
    public function sendMerchRevOpenRequest(
        string $merchType,
        ?string $mchId = null,
        ?string $licenseNumber = null,
        ?string $licenseName = null,
        ?string $licenseAddress = null,
        ?string $licenseBeginDate = null,
        ?string $licenseEndDate = null,
        ?string $licenseFrontSourceId = null,
        ?string $licenseBackSourceId = null,
        ?string $legalName = null,
        ?string $legalNumber = null,
        ?string $legalBeginDate = null,
        ?string $legalEndDate = null,
        ?string $legalFrontSourceId = null,
        ?string $legalBackSourceId = null,
        ?string $mobile = null,
        ?string $bankCardNo = null,
        ?string $bankCardName = null,
        ?string $bankCode = null,
        ?string $bankName = null,
        ?string $bankBranchCode = null,
        ?string $bankBranchName = null,
        ?string $bankFrontSourceId = null
    ): array {
        $data = $this->client->filterNullValues([
            'merch_type' => $merchType,
            'mch_id' => $mchId,
            'license_number' => $licenseNumber,
            'license_name' => $licenseName,
            'license_address' => $licenseAddress,
            'license_begin_date' => $licenseBeginDate,
            'license_end_date' => $licenseEndDate,
            'license_front_source_id' => $licenseFrontSourceId,
            'license_back_source_id' => $licenseBackSourceId,
            'legal_name' => $legalName,
            'legal_number' => $legalNumber,
            'legal_begin_date' => $legalBeginDate,
            'legal_end_date' => $legalEndDate,
            'legal_front_source_id' => $legalFrontSourceId,
            'legal_back_source_id' => $legalBackSourceId,
            'mobile' => $mobile,
            'bank_card_no' => $bankCardNo,
            'bank_card_name' => $bankCardName,
            'bank_code' => $bankCode,
            'bank_name' => $bankName,
            'bank_branch_code' => $bankBranchCode,
            'bank_branch_name' => $bankBranchName,
            'bank_front_source_id' => $bankFrontSourceId,
        ]);

        return $this->client->sendRequest('fund/ledger/api/merch/rev/open', $data);
    }

    /**
     * 4.5 变更接收方信息变更
     *
     * @throws GuzzleException
     * @throws JsonException
     */
    public function sendMerchRevSettleUpdateRequest(
        string $mchId,
        string $bankCardNo,
        string $bankCardName,
        string $bankCode,
        string $bankName,
        string $bankBranchCode,
        string $bankBranchName,
        string $bankFrontSourceId
    ): array {
        $data = $this->client->filterNullValues([
            'mch_id' => $mchId,
            'bank_card_no' => $bankCardNo,
            'bank_card_name' => $bankCardName,
            'bank_code' => $bankCode,
            'bank_name' => $bankName,
            'bank_branch_code' => $bankBranchCode,
            'bank_branch_name' => $bankBranchName,
            'bank_front_source_id' => $bankFrontSourceId,
        ]);

        return $this->client->sendRequest('fund/ledger/api/merch/rev/settle/update', $data);
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

    /**
     * 6.1 余额分账请求
     *
     * @throws GuzzleException
     * @throws JsonException
     */
    public function sendBalanceSplitRequest(
        string $mchId,
        string $outOrderNo,
        int $totalAmount,
        array $receivers
    ): array {
        $data = $this->client->filterNullValues([
            'mch_id' => $mchId,
            'out_order_no' => $outOrderNo,
            'total_amount' => $totalAmount,
            'receivers' => $receivers,
        ]);

        return $this->client->sendRequest('fund/ledger/api/balance/split', $data);
    }

    /**
     * 6.2 余额分账结果查询
     *
     * @throws GuzzleException
     * @throws JsonException
     */
    public function sendBalanceSplitQueryRequest(
        ?string $outOrderNo = null,
        ?string $orderNo = null,
    ): array {
        $data = $this->client->filterNullValues([
            'out_order_no' => $outOrderNo,
            'order_no' => $orderNo,
        ]);

        return $this->client->sendRequest('fund/ledger/api/balance/split/query', $data);
    }

    /**
     * 6.3 余额分账回退请求
     *
     * @throws GuzzleException
     * @throws JsonException
     */
    public function sendBalanceRefundRequest(
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

        return $this->client->sendRequest('fund/ledger/api/balance/refund', $data);
    }

    /**
     * 6.4 余额分账回退结果查询
     *
     * @throws GuzzleException
     * @throws JsonException
     */
    public function sendBalanceRefundQueryRequest(
        ?string $outReturnNo = null,
        ?string $returnNo = null,
    ): array {
        $data = $this->client->filterNullValues([
            'return_no' => $returnNo,
            'out_return_no' => $outReturnNo,
        ]);

        return $this->client->sendRequest('fund/ledger/api/balance/refund/query', $data);
    }

    /**
     * 6.5 账户余额查询
     *
     * @throws GuzzleException
     * @throws JsonException
     */
    public function sendBalanceQueryRequest(
        string $mchId,
        string $accountType,
    ): array {
        $data = $this->client->filterNullValues([
            'mch_id' => $mchId,
            'account_type' => $accountType,
        ]);

        return $this->client->sendRequest('fund/ledger/api/balance/query', $data);
    }

    /**
     * 7.1 申请分账账单
     *
     * @throws GuzzleException
     * @throws JsonException
     */
    public function sendBillApplyUrlRequest(
        string $billDate
    ): array {
        $data = $this->client->filterNullValues([
            'bill_date' => $billDate,
        ]);

        return $this->client->sendRequest('fund/ledger/api/bill/apply/url', $data);
    }
}
