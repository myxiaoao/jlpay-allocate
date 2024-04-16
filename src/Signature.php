<?php

namespace Cooper\JlPayAllocate;

use Rtgm\sm\RtSm2;

class Signature
{
    protected RtSm2 $sm2;

    protected string $publicKey;

    protected string $privateKey;

    public function __construct(string $publicKey, string $privateKey)
    {
        $this->sm2 = new RtSm2('base64');
        $this->publicKey = $publicKey;
        $this->privateKey = $privateKey;
    }

    public function sign(string $data): string
    {
        return $this->sm2->doSign($data, $this->privateKey);
    }

    public function verify(string $data, string $sign): bool
    {
        return $this->sm2->verifySign($data, $sign, $this->publicKey);
    }
}
