<?php


namespace App;


interface RsaTokenDaoInterface
{
    public function getRandom(string $account): string;
}
