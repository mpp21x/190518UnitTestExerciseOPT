<?php

namespace Test;


use App\AuthenticationService;
use PHPUnit\Framework\TestCase;

class AuthenticationServiceTest extends TestCase
{
    /** @test */
    public function is_valid_test()
    {
        $target = new AuthenticationService();
        $actual = $target->isValid('joey', '91000000');
        //always failed
        $this->assertTrue($actual);
    }

}
