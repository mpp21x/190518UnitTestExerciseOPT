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
    /** @var ProfileDaoInterface|MockInterface */
    private $stubProfileDao;
    /** @var RsaTokenDaoInterface|MockInterface */
    private $stubRsaTokenDao;

    /** @test */
    public function is_valid_test()
    {
        $account = "joey";
        $this->givenProfile($account, "91");

        $this->givenToken($account, "000000");

        $target = new AuthenticationService($this->stubProfileDao, $this->stubRsaTokenDao);
        $actual = $target->isValid($account, "91000000");
        $this->assertTrue($actual);
    }

    protected function givenProfile(string $account, string $password): void
    {
        $this->stubProfileDao->shouldReceive("getPassword")
            ->with($account)
            ->andReturn($password);
    }

    protected function givenToken(string $account, string $token): void
    {
        $this->stubRsaTokenDao->shouldReceive("getRandom")
            ->with($account)
            ->andReturn($token);
    }

    protected function setUp()
    {
        $this->stubProfileDao = Mockery::mock(ProfileDaoInterface::class);
        $this->stubRsaTokenDao = Mockery::mock(RsaTokenDaoInterface::class);
    }

}
