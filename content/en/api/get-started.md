---
title: Get started with the {brand} API
description: Send your first API request.
toc: true
---

## Before you get started

First, make sure you fulfill the initial requirements for a smooth process.

## Send your first API request

To make a request to the {brand} API, the operator must create a URL containing tokens and parameters using our own algorithm. You can refer to the **API Functions** section for the URL and parameters, and the [Authentication & Security](/api/authentication) for the algorithm.

For example, if we want to make a payment request, we use [Payment Endpoint](/api/payment) to send the request. Then, we look at what parameters are required.

<x-steps>

### Combine all parameters into one string, separated by `&` character

For example, to make request in our services.

```php
$str = "merchant_code=xxx&'
    .'merchant_api_key=xxx&'
    .'transaction_code=xxx&'
    .'transaction_timestamp=xxx&'
    .'payment_code=xxx&'
    .'transaction_amount=xxx&'
    .'user_id=xxx&'
    .'currency_code=xxx"
```

### Encrypt using encrypt_decrypt

Refer to security on pre-requirements, the attribute to send is usually just using **one key** with encrypted parameters. for more info please read more [Authentication & Security](/api/authentication)

Encryption sample:

```php
$key = encrypt_decrypt('encrypt', $str, '{your_api_key}', '{your_secret_key})
```

### Done

So, the request will look like: 

`https://{base_url}/{merchant_code}/v2/dopayment?key=3eX%2Bf%2BMoVECXxSkKqV7aBRYIbyWg3DxdPdgZyG%2B377a7dR1OBBDNnU%2B%2Fvtn7hUyjP7WWdZ7gCsPF0J%2BJOiSxb1BFueIyRX3rxbSMa%2B%2FAyFvhz4L%2F2wJmSJKcNQn4whIL1sc1cfj7E1smQFAiYjfLXdY1Ev6Pnoit8Vouex3%2BupnZjJS8t44XRx5wugB5GuybZWPtlPhiN%2FP7P4uJW3RlFlo%2BtYrnHQ6GwqwRkoLrdv3qZXUzaatT8EWdztr973KWFDof2rVD%2B56SMAVrRHQZcYICU8RcjpyvJUaCtXpOKKg%3D`

</x-steps>

After the request url is made, the response will depend on each enpoint. see the [return section](/api/payment#return) to see what response will be received.
