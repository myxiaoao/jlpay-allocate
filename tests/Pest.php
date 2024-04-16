<?php

use Cooper\JlPayAllocate\Api;
use Cooper\JlPayAllocate\Signature;

const PUBLIC_KEY = '8f191de3d3f7acd064fb896f0c231654813f995d94a69421aed693920b63abadcb21152049adfb4ef35c43e9216f4ad402e2b429b0e42cf959bf66271c18e629';
const PRIVATE_KEY = '5c1e714fb3828ceb5fec2af8475e254b3bbdda542a660f0238293228f13612f3';
const ORG_CODE = '50720711';

function signature(): Signature
{
    return new Signature(PUBLIC_KEY, PRIVATE_KEY);
}

function makeApi(): Api
{
    return Api::make([
        'public_key' => PUBLIC_KEY,
        'private_key' => PRIVATE_KEY,
        'org_code' => ORG_CODE,
        'uat' => true,
    ]);
}

function newApi(): Api
{
    return new Api(PUBLIC_KEY, PRIVATE_KEY, ORG_CODE, true);
}

function generateNumericOrderNo($length = 21): string
{
    $digits = '0123456789';
    $outOrderNo = '';

    for ($i = 0; $i < $length; $i++) {
        $outOrderNo .= $digits[random_int(0, strlen($digits) - 1)];
    }

    return $outOrderNo;
}
