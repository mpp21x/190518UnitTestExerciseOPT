<?php

namespace Test;


use App\AuthenticationService;
use PHPUnit\Framework\TestCase;

class AuthenticationServiceTest extends TestCase
{

    /** @test */
    public function is_valid_test()
    {
        $target = new AuthenticationService(new FakeProfileDao(), new FakeRsaTokenDao());
        $actual = $target->isValid("joey", "91000000");
        $this->assertTrue($actual);
    }

}
