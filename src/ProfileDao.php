<?php


namespace App;


class ProfileDao
{

    public function getPassword(string $account): string
    {
        return Context::getPassword($account);
    }
}
