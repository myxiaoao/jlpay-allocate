<?php

it('test verify', function () {
    $sign = signature()->verify(
        'nonce_str=x4O1Gh5iPXW2rKaLf054gE2YLXn0ahHb&order_no=61106708379852213248&org_code=50720711&out_order_no=827513328929341770767&receivers=[{"rev_mch_id":"849584307420004","amount":2000,"description":"ceshi","result":"SUCCESS","detail_id":"61106708379852082176","create_time":"2023-08-16 08:54:36","finish_time":"2024-03-22 10:42:55"}]&ret_code=00&ret_msg=OK&state=FINISHED&timestamp=2024-04-15 16:31:22&total_amount=2000&transaction_id=451095914701560505958427',
        'MEUCIQCCJXlsRiTCYl0rjWNW49x8OGJTb/S6kKNrbdveQJ2V9gIgTK8YXaDZgPRmt28fcklF2ICWXVJbxEV4rpMOuZNMc7g='
    );
    expect($sign)->toBeTrue();
});

it('test order split', function () {
    $response = makeApi()->sendOrderSplitRequest(
        mchId: '849584358120018',
        outOrderNo: generateNumericOrderNo(),
        transactionId: '61106708379852213248',
        totalAmount: 100,
        receivers: [
            [
                'rev_mch_id' => '849584307420004',
                'amount' => 100,
                'description' => 'test',
            ],
        ]
    );
    expect($response['ret_code'])
        ->toBe('50021')
        ->and($response['ret_msg'])
        ->toBe('商户订单不存在');
});

it('test order split query', function () {
    $response = newApi()->sendOrderSplitQueryRequest(mchId: '849584358120018', orderNo: '61106708379852213248');
    expect($response['ret_msg'])->toBe('OK');
});

it('test order trans query', function () {
    $response = newApi()->sendOrderTransQueryRequest(
        mchId: '849584358120018',
        transactionId: '451095914701560505958427'
    );
    expect($response['ret_msg'])->toBe('OK');
});
