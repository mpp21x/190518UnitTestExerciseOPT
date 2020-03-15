<?php


namespace App;


use function sprintf;

class AuthenticationService
{


    /** @var ProfileDao */
    private $profileDao;
    /** @var RsaTokenDao */
    private $rsaToken;
    /** @var LoggerInterface */
    private $logger;

    public function __construct(ProfileDaoInterface $profileDao, RsaTokenDaoInterface $rsaToken, LoggerInterface $logger)
    {
        $this->profileDao = $profileDao ?: new ProfileDao();
        $this->rsaToken = $rsaToken ?: new RsaTokenDao();
        $this->logger = $logger;
    }

    public function isValid($account, $password)
    {
        // 根據 account 取得自訂密碼
        $passwordFromDao = $this->profileDao->getPassword($account);
        // 根據 account 取得 RSA token 目前的亂數
        $randomCode = $this->rsaToken->getRandom($account);
        // 驗證傳入的 password 是否等於自訂密碼 + RSA token亂數
        $validPassword = $passwordFromDao . $randomCode;
        $isValid = $password === $validPassword;
        if ($isValid) {
            return true;
        } else {
            $this->logger->save(sprintf('account: %s try to login failed', $account));

            return false;
        }
    }


}
