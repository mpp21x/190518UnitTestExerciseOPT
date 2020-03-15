<?php


namespace Test;


use App\RsaTokenDaoInterface;

class FakeRsaTokenDao implements RsaTokenDaoInterface
{
    public function getRandom(string $account): string
    {
        return "000000";
    }

}
