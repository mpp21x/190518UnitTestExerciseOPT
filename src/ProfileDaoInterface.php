<?php


namespace App;


interface ProfileDaoInterface
{
    public function getPassword(string $account): string;
}
