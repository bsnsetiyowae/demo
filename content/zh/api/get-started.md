---
title: 开始使用 {brand} API
description: 发送您的第一个 API 请求。
toc: true
---

## 在开始之前

首先，请确保您满足顺利进行的初始要求。

## 发送您的第一个 API 请求

要向 {brand} API 发出请求，运营商必须使用我们的算法创建包含令牌和参数的 URL。您可以参考 **API 功能** 部分获取 URL 和参数，以及 [认证与安全](/api/authentication) 了解算法。

例如，如果我们想发起付款请求，我们可以使用 [支付端点](/api/payment) 发送请求。然后，我们查看需要哪些参数。

<x-steps>

### 将所有参数组合成一个字符串，并用 `&` 字符分隔

例如，在我们的服务中发出请求。

```php title="组合参数"
$str = "merchant_code=xxx&'
    .'merchant_api_key=xxx&'
    .'transaction_code=xxx&'
    .'transaction_timestamp=xxx&'
    .'payment_code=xxx&'
    .'transaction_amount=xxx&'
    .'user_id=xxx&'
    .'currency_code=xxx"
```

### 使用 encrypt_decrypt 加密

请参考预先要求中的安全性，发送的属性通常只使用**一个密钥**和加密的参数。有关更多信息，请阅读 [认证与安全](/api/authentication)。

加密示例：

```php title="加密"
$key = encrypt_decrypt('encrypt', $str, '{your_api_key}', '{your_secret_key}')
```

### 完成

所以，请求将如下所示：

`https://{base_url}/{merchant_code}/v2/dopayment?key=3eX%2Bf%2BMoVECXxSkKqV7aBRYIbyWg3DxdPdgZyG%2B377a7dR1OBBDNnU%2B%2Fvtn7hUyjP7WWdZ7gCsPF0J%2BJOiSxb1BFueIyRX3rxbSMa%2B%2FAyFvhz4L%2F2wJmSJKcNQn4whIL1sc1cfj7E1smQFAiYjfLXdY1Ev6Pnoit8Vouex3%2BupnZjJS8t44XRx5wugB5GuybZWPtlPhiN%2FP7P4uJW3RlFlo%2BtYrnHQ6GwqwRkoLrdv3qZXUzaatT8EWdztr973KWFDof2rVD%2B56SMAVrRHQZcYICU8RcjpyvJUaCtXpOKKg%3D`

</x-steps>

在请求 URL 创建后，响应将取决于每个端点。请参见 [返回部分](/api/payment#return) 查看将收到什么响应。