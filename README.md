# One Time Password
題目：請讓 `AuthenticationServiceTest.is_valid_test()` 測試通過。
規則：
* 不能修改 `Context`、`ProfileDao`、`RsaTokenDao` 以及 `AuthenticationService` 的 `isValid` 驗證流程 

## 第一題 otp_v2_manual_stub
請使用 FakeClass 完成 `AuthenticationServiceTest` 的測試
## 第二題 Otp_v3_1_stub_by_mockery
請改用 Stub (Mockery) 模擬目標物件完成
## 第三題 Otp_v3_2_refactor
重構 AuthenticationServiceTest
## 第四題 Otp_v4_1_mock_lab
`AuthenticationService` 新增一物件 `Logger`，並且在 `isValid` return `false` 之後，寫下 log。

## 第五題 Otp_v4_2_mock_assertion
`AuthenticationServiceTest`  使用 Mockery 模擬目標物件

## 第六題 Otp_v4_3_refactor
重構 `AuthenticationServiceTest`

## 第七題 Otp_v4_4_use_spy_instead_mock
改用 spy
