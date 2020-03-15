<?php

namespace Test;


use App\AuthenticationService;
use App\LoggerInterface;
use App\ProfileDaoInterface;
use App\RsaTokenDaoInterface;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use function strpos;

class AuthenticationServiceTest extends TestCase
{
    use MockeryPHPUnitIntegration;
    /** @var ProfileDaoInterface|MockInterface */
    private $stubProfile;
    /** @var RsaTokenDaoInterface|MockInterface */
    private $stubRsa;
    /** @var LoggerInterface|MockInterface */
    private $logger;
    /** @var AuthenticationService */
    private $target;

    protected function setUp()
    {
        $this->stubProfile = Mockery::mock(ProfileDaoInterface::class);
        $this->stubRsa = Mockery::mock(RsaTokenDaoInterface::class);
        $this->logger = Mockery::spy(LoggerInterface::class);
        $this->target = new AuthenticationService($this->stubProfile, $this->stubRsa, $this->logger);
    }

    /** @test */
    public function is_valid_test()
    {
        $account = "joey";
        $password = "91";
        $this->givenProfile($account, $password);

        $token = "000000";
        $this->givenToken($account, $token);

        $this->shouldBeValid($account, $password . $token);
    }

    public function test_log_account_when_invalid()
    {
        $this->givenProfile('joey', '91');
        $this->givenToken('joey', '000000');

        $this->target->isValid('joey', 'wrong password');
        $this->givenOnceSave('joey');
    }

    protected function givenProfile(string $account, string $password): void
    {
        $this->stubProfile->shouldReceive("getPassword")
            ->with($account)
            ->andReturn($password);
    }

    protected function givenToken(string $account, string $token): void
    {
        $this->stubRsa->shouldReceive("getRandom")
            ->with($account)
            ->andReturn($token);
    }

    protected function shouldBeValid(string $account, string $passwordWithToken): void
    {
        $actual = $this->target->isValid($account, $passwordWithToken);
        $this->assertTrue($actual);
    }

    /**
     * @param string $account
     */
    protected function givenOnceSave(string $account)
    {
        $this->logger->shouldHaveReceived('save')
            ->with(Mockery::on(function ($message) use ($account) {
                return strpos($message, $account) !== false;
            }))->once();
    }


}
