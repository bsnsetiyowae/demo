---
title: Errors List
---

## Deposit error lists

These are the error responses at dopayment endpoint:

| Error Code | Description                                               |
| ---------- | --------------------------------------------------------- |
| `109`      | Incomplete parameter                                      |
| `110`      | Invalid Bank ID                                           |
| `111`      | Invalid Transaction Code ( not unique )                   |
| `112`      | Invalid Timestamp                                         |
| `113`      | Invalid Transaction. The transaction is already processed |
| `114`      | Active bank account is not found                          |
| `115`      | Invalid Key / Merchant code                               |
| `116`      | Bank is under maintenance                                 |
| `117`      | Server Error for this payout method !                     |
| `118`      | Format Key Paramater Invalid                              |
| `119`      | Insufficient Balance                                      |



## Payout error lists

These are the error responses at payout endpoint:

| Error Code | Description                                                                               |
| ---------- | ----------------------------------------------------------------------------------------- |
| `115`      | Invalid Key / Merchant code!, error code 115                                              |
| `109`      | Incomplete parameter!, error code 109                                                     |
| `111`      | Invalid Transaction Code ( not unique )!, error code 111                                  |
| `110`      | Payout Method Not Available, error code 110,                                              |
| `116`      | Payout method is under maintenance!, error code 116                                       |
| `117`      | Server error for this payout method!, error code 117                                      |
| `118`      | Format Key parameter invalid!, error code 118                                             |
| `114`      | Currency of payment method is not supported for your merchant!, error code 114            |
| `112`      | Invalid Timestamp!, error code 112                                                        |
| `113`      | Currency rate is not supported for your merchant currency at this moment!, error code 113 |
| `119`      | Insufficient Balance!, error code 119                                                     |
| `120`      | Invalid IFSC Code! Please try again, error code 120                                       |
| `121`      | Withdraw Bank not found!, error code 121                                                  |
| `122`      | Amount cannot has decimal number, please try again! error code 122                        |
| `123`      | Request Withdrawal Failed! Please Try Again, error code 123                               |
| `124`      | Your IP address has been blocked, error code 124                                          |
| `131`      | There are problem to connect payout account, please try again!, error code 131            |
