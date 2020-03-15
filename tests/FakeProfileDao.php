<?php


namespace Test;


use App\ProfileDaoInterface;

class FakeProfileDao implements ProfileDaoInterface
{
    public function getPassword(string $account): string
    {
        return "91";
    }

}
