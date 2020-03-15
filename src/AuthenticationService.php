<?php


namespace App;


class AuthenticationService
{


    private $profileDao;
    private $rsaTokenDao;

    public function __construct(ProfileDaoInterface $profileDao,RsaTokenDaoInterface $rsaTokenDao)
    {
        $this->profileDao = $profileDao;
        $this->rsaTokenDao = $rsaTokenDao;
    }

    public function isValid($account, $password)
    {
        // 根據 account 取得自訂密碼
        $passwordFromDao = $this->profileDao->getPassword($account);
        // 根據 account 取得 RSA token 目前的亂數
        $randomCode = $this->rsaTokenDao->getRandom($account);
        // 驗證傳入的 password 是否等於自訂密碼 + RSA token亂數
        $validPassword = $passwordFromDao . $randomCode;
        $isValid = $password === $validPassword;
        if ($isValid) {
            return true;
        } else {
            return false;
        }
    }


}
