---
title: Errors List
---

## Deposit error lists

These are the error responses at dopayment endpoint:

| Error Code | Description                                               |
| ---------- | --------------------------------------------------------- |
| `109`      | [DP] Incomplete parameter                                      |
| `110`      | [DP] Invalid Bank ID                                           |
| `111`      | [DP] Invalid Transaction Code ( not unique )                   |
| `112`      | [DP] Invalid Timestamp                                         |
| `113`      | [DP] Invalid Transaction. The transaction is already processed |
| `114`      | [DP] Active bank account is not found                          |
| `115`      | [DP] Invalid Key / Merchant code                               |
| `116`      | [DP] Bank is under maintenance                                 |
| `117`      | [DP] Server Error for this payout method !                     |
| `118`      | [DP] Format Key Paramater Invalid                              |
| `119`      | [DP] Insufficient Balance                                      |



## Payout error lists

These are the error responses at payout endpoint:

| Error Code | Description                                                                               |
| ---------- | ----------------------------------------------------------------------------------------- |
| `115`      | [WD] Invalid Key / Merchant code!, error code 115                                              |
| `109`      | [WD] Incomplete parameter!, error code 109                                                     |
| `111`      | [WD] Invalid Transaction Code ( not unique )!, error code 111                                  |
| `110`      | [WD] Payout Method Not Available, error code 110,                                              |
| `116`      | [WD] Payout method is under maintenance!, error code 116                                       |
| `117`      | [WD] Server error for this payout method!, error code 117                                      |
| `118`      | [WD] Format Key parameter invalid!, error code 118                                             |
| `114`      | [WD] Currency of payment method is not supported for your merchant!, error code 114            |
| `112`      | [WD] Invalid Timestamp!, error code 112                                                        |
| `113`      | [WD] Currency rate is not supported for your merchant currency at this moment!, error code 113 |
| `119`      | [WD] Insufficient Balance!, error code 119                                                     |
| `120`      | [WD] Invalid IFSC Code! Please try again, error code 120                                       |
| `121`      | [WD] Withdraw Bank not found!, error code 121                                                  |
| `122`      | [WD] Amount cannot has decimal number, please try again! error code 122                        |
| `123`      | [WD] Request Withdrawal Failed! Please Try Again, error code 123                               |
| `124`      | [WD] Your IP address has been blocked, error code 124                                          |
| `131`      | [WD] There are problem to connect payout account, please try again!, error code 131            |
