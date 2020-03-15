<?php


namespace App;


class ProfileDao implements ProfileDaoInterface
{

    public function getPassword(string $account): string
    {
        return Context::getPassword($account);
    }
}
