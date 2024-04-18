---
title: Pre-Requirements
description: Before integrating {brand} Payment Gateway into your system, ensure that you have met the following pre-requirements provided by both the provider and the operator.
---

## Pre-Requirements Provide by Provider

1. Server info & API URL.
2. Credential API : `api_key`, `secret_key`, `merchant_code`.
3. Credential BO : username, password.

## Pre-Requirements Provide by Operator

1. API Callback URL (mandatory). Used to forward transaction status.
2. Callback `success url page` (optional).
3. Callback `failed url page` (optional).

## Security

1. Token and transaction key (Need to create token and key for each transaction). More about [generate token encrypt / decrypt function](/api/authentication).
2. IP White list for Back Office login.
