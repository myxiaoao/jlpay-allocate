<?php

function generateNumericOrderNo($length = 21): string
{
    $digits = '0123456789';
    $outOrderNo = '';

    for ($i = 0; $i < $length; $i++) {
        $outOrderNo .= $digits[random_int(0, strlen($digits) - 1)];
    }

    return $outOrderNo;
}
