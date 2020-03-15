<?php

namespace Test;


use App\AuthenticationService;
use App\ProfileDaoInterface;
use App\RsaTokenDaoInterface;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

class AuthenticationServiceTest extends TestCase
{
    use MockeryPHPUnitIntegration;
    /** @test */
    public function is_valid_test()
    {
        /** @var ProfileDaoInterface|MockInterface $profileDao */
        $profileDao = Mockery::mock(ProfileDaoInterface::class);
        $profileDao->shouldReceive("getPassword")
            ->with("joey")
            ->andReturn("91");

        /** @var RsaTokenDaoInterface|MockInterface $rsaTokenDao */
        $rsaTokenDao = Mockery::mock(RsaTokenDaoInterface::class);
        $rsaTokenDao->shouldReceive("getRandom")
            ->with("joey")
            ->andReturn("000000");

        $target = new AuthenticationService($profileDao, $rsaTokenDao);
        $actual = $target->isValid("joey", "91000000");
        $this->assertTrue($actual);
    }

}
