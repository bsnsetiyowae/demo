---
title: 支付请求
description: 发起INR、BDT、VND、JPY、BRL的支付请求。
method: POST
label: /api/{merchant_code}/v3/dopayment
toc: false
---

<x-row>
<x-col class="md:max-w-lg">

## 发起支付请求

该API用于创建支付请求。此API需要一个 `key` 参数，该参数包含由 `&` 字符分隔的参数组合，然后使用 encrypt_decrypt 算法加密。

### 请求正文

<x-properties>
  <x-property name="key" type="string" required>
  
  由[参数](#parameters)和API密钥及API密钥加密生成的键。
  </x-property>
</x-properties>

</x-col>
<x-col sticky>

```bash title="cURL"
curl --request POST \
  --url https://staging.s88pay.net/api/{merchant_code}/v3/dopayment \
  --header 'Content-Type: application/json' \
  --data '{
      "key": "<string>"
    }'
```

</x-col>
</x-row>

---

<x-row>
<x-col class="md:max-w-lg">

### 参数

<x-properties>
  <x-property name="merchant_code" type="string" required>
    由提供商提供。
  </x-property>
  <x-property name="merchant_api_key" type="string" required>
    由提供商提供。
  </x-property>
  <x-property name="transaction_code" type="string" required>
    由操作员生成。每笔交易必须唯一。
  </x-property>
  <x-property name="transaction_timestamp" type="integer" required>
  由操作员生成。
  
  该参数描述交易请求的时间范围。有关时间戳的更多详细信息，请访问 https://www.epochconverter.com/。

  请注意，我们仅处理以下时间范围内的时间戳。

  `min`: 当前时间前1小时

  `max`: 当前时间后5分钟
  </x-property>
  <x-property name="transaction_amount" type="double" required>
    交易金额。
  </x-property>
  <x-property name="payment_code" type="string" required>
    例如 `P001`。请联系管理员获取您的支付代码。
  </x-property>
  <x-property name="user_id" type="string" required>
    用户标识符。
  </x-property>
  <x-property name="currency_code" type="string" required>
    请参阅[货币列表](/docs/currency)。
  </x-property>
  <x-property name="bank_code" type="double" required>
    仅在[BDT](/docs/bank/bdt)、[VND](/docs/bank/vnd)、[THB](/docs/bank/thb)、[IDR](/docs/bank/idr)、[MYR](/docs/bank/myr) 和 [PHP](/docs/bank/php) 在线银行支付方法更改事件中需要。
  </x-property>
  <x-property name="deposit_name" type="string" required>
    存款名称（KRW必填）。
  </x-property>
</x-properties>

</x-col>
<x-col sticky>

```json title="参数对象"
{
  "merchant_code": "",
  "merchant_api_key": "",
  "transaction_code": "",
  "transaction_timestamp": 0, 
  "transaction_amount": 0,
  "payment_code": "",
  "user_id": "",
  "currency_code": "",
  "bank_code": "", 
  "deposit_name": "" 
}
```

这些参数必须在通过[键](#request-body)发送之前[加密](/api/authentication)。

</x-col>
</x-row>

---

<x-row>
<x-col class="lg:max-w-md">

### 返回

返回交易状态对象。如果发生错误，此调用将返回一个[错误](/api/errors)。

</x-col>
<x-col sticky>

<x-code-group>

```json title="响应 INR"
{
 "status": "success",
 "message": "Submit Transaction Success!",
 "transaction_no": "DP16873387xxxxx",
 "transaction_code": "TEST-DP-16873xxxxx",
 "amount": "510.00",
 "upi_id": "example@upi",
 "qr":"https://s88pay.net/imageencoded=true&url=aHR0cHM6Ly9hcGkucGF5cHJvc3R1ZG
  vLmNvbS9hc3NldC91cGkvY2FjaGVkLzgzMmE1NmZlLTBkYzktNDc0Ni05NDhkLWFlYmY
  3E5NDlkMw==",
 "expired_at":"2023-06-22 15:06:04",
 "expired_timezone":"GMT+05:30",
}
```
```json title="响应 BDT"
{
  "status": "success",
  "message": "Submit Transaction Success!",
  "transaction_no": "DP16873387xxxxx",
  "transaction_code": "TEST-DP-16873xxxxx",
  "amount": "510.00",
  "wallet_number": "01861843585",
  "wallet_number_type": "Agent",
  "wallet_name": "rocket",
  "wallet_code": "1001",
  "expired_at": "2023-06-22 15:06:04",
  "expired_timezone": "GMT+05:30"
}
```

```json title="响应 VND"
{
  "status": "success",
  "message": "Submit Transaction Success!",
  "transaction_no": "DP16873387xxxxx",
  "transaction_code": "TEST-DP-16873xxxxx",
  "amount": "510.00",
  "wallet_number": "0797748156",
  "wallet_name": "Pham Chi Cuong",
  "wallet_code": "momo",
  "match_code": "685532",
  "expired_at": "2023-06-22 15:06:04",
  "expired_timezone": "GMT+05:30"
}
```

```json title="响应 JPY"
{
  "status": "success",
  "message": "Submit Transaction Success!",
  "transaction_no": "DP1697771160414",
  "transaction_code": "TEST-DP-1697771160",
  "amount": "11111.00",
  "wallet_number": "カ）クレラル",
  "wallet_number_type": null,
  "wallet_name": "7276005",
  "wallet_code": "",
  "expired_at": "2023-10-20 12:21:00",
  "expired_timezone": "GMT+05:30"
}
```
</x-code-group>

</x-col>
</x-row>