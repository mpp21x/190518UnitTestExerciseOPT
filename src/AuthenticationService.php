<?php


namespace App;


class AuthenticationService
{


    public function isValid($account, $password)
    {
        // 根據 account 取得自訂密碼
        $profileDao = new ProfileDao();
        $passwordFromDao = $profileDao->getPassword($account);
        // 根據 account 取得 RSA token 目前的亂數
        $rsaTokenDao = new RsaTokenDao();
        $randomCode = $rsaTokenDao->getRandom($account);
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
