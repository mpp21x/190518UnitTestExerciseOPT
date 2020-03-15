<?php


namespace App;


class RsaTokenDao implements RsaTokenDaoInterface
{
    public function getRandom(string $account):string
    {
        return sprintf('%06d', mt_rand(0, 999999));
    }
}
