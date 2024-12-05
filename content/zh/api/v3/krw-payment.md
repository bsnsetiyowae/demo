---
title: 支付请求
description: 仅用于KRW的支付请求。
method: POST
label: /api/{merchant_code}/v3/krw-payment
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
  --url {api_url}/api/{merchant_code}/v3/dopayment \
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
    由提供商提供
  </x-property>
  <x-property name="merchant_api_key" type="string" required>
    由提供商提供
  </x-property>
  <x-property name="transaction_code" type="string" required>
    由操作员生成。每笔交易必须唯一
  </x-property>
  <x-property name="transaction_timestamp" type="integer" required>
  由操作员生成。
  
  该参数描述交易请求的时间范围。有关时间戳的更多详细信息，请访问 https://www.epochconverter.com/。

  请注意，我们仅处理以下时间范围内的时间戳

  `min`: 当前时间前1小时

  `max`: 当前时间后5分钟
  </x-property>
  <x-property name="transaction_amount" type="double" required>
    交易金额
  </x-property>
  <x-property name="payment_code" type="string" required>
    例如 `P001`。请联系管理员获取您的支付代码
  </x-property>
  <x-property name="user_id" type="string" required>
    用户标识符。
  </x-property>
  <x-property name="currency_code" type="string" required>
    请参阅[货币列表](/docs/currency)
  </x-property>
  <x-property name="bank_code" type="double" required>
    仅在[BDT](/docs/bank/bdt)、[VND](/docs/bank/vnd)、[THB](/docs/bank/thb)、[IDR](/docs/bank/idr)、[MYR](/docs/bank/myr) 和 [PHP](/docs/bank/php) 在线银行支付中需要。
  </x-property>
  <x-property name="deposit_name" type="string" required>
    存款名称（KRW必填）
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

```json title="响应"
{
  "status": "success",
  "step": 1,
  "message": "提交交易成功！请提交存款人姓名、银行代码和账号。",
  "transaction_code": "TEST-DP-1697797081",
  "amount": 10000,
  "bank_lists": [
    "<任何>"
  ]
}
```

</x-col>
</x-row>