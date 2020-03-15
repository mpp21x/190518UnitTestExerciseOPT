<?php


namespace App;


class RsaTokenDao
{
    public function getRandom(string $account):string
    {
        return sprintf('%06d', mt_rand(0, 999999));
    }
}
