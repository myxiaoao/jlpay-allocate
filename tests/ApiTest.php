<?php

use Cooper\JlPayAllocate\Api;
use Cooper\JlPayAllocate\Signature;

const PUBLIC_KEY = '8f191de3d3f7acd064fb896f0c231654813f995d94a69421aed693920b63abadcb21152049adfb4ef35c43e9216f4ad402e2b429b0e42cf959bf66271c18e629';
const PRIVATE_KEY = '5c1e714fb3828ceb5fec2af8475e254b3bbdda542a660f0238293228f13612f3';
const ORG_CODE = '50720711';

it('test verify', function () {
    $signature = new Signature(PUBLIC_KEY, PRIVATE_KEY);
    $sign = $signature->verify(
        'nonce_str=x4O1Gh5iPXW2rKaLf054gE2YLXn0ahHb&order_no=61106708379852213248&org_code=50720711&out_order_no=827513328929341770767&receivers=[{"rev_mch_id":"849584307420004","amount":2000,"description":"ceshi","result":"SUCCESS","detail_id":"61106708379852082176","create_time":"2023-08-16 08:54:36","finish_time":"2024-03-22 10:42:55"}]&ret_code=00&ret_msg=OK&state=FINISHED&timestamp=2024-04-15 16:31:22&total_amount=2000&transaction_id=451095914701560505958427',
        'MEUCIQCCJXlsRiTCYl0rjWNW49x8OGJTb/S6kKNrbdveQJ2V9gIgTK8YXaDZgPRmt28fcklF2ICWXVJbxEV4rpMOuZNMc7g='
    );
    expect($sign)->toBeTrue();
});

it('test order split query', function () {
    $api = new Api(PUBLIC_KEY, PRIVATE_KEY, ORG_CODE, true);
    $response = $api->sendOrderSplitQueryRequest(mchId: '849584358120018', orderNo: '61106708379852213248');
    expect($response['ret_msg'])->toBe('OK');
});
