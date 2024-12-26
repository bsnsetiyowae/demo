---
title: 付款
method: POST
label: /api/v1/payout/{merchant_code}
toc: false
---

<x-row>
<x-col class="md:max-w-lg">

## 处理付款

此 API 用于提交付款请求。它需要一些参数来提交付款并检查交易状态。需要使用 `secret key` 和 `merchant key` 加密请求。

### 请求正文

<x-properties>
  <x-property name="key" type="string" required>
  
  使用 API 密钥和 API 秘钥加密生成的 [参数](#parameters) 生成的密钥。
  </x-property>
</x-properties>

</x-col>
<x-col sticky>

```bash title="cURL"
curl --request POST \
  --url {api_url}/api/v1/payout/{merchant_code} \
  --header 'Content-Type: application/json' \
  --data '{
  "key": "<string>"
    }'
```

<x-sandbox method="POST" contentType="application/json" url="/api/v1/payout/{merchant_code}" payload='{"key": "{key}"}' />

</x-col>
</x-row>

---

<x-row>
<x-col class="md:max-w-lg">

### 参数

<x-properties>
  <x-property name="merchant_code" type="string" required>
  由服务提供商提供。
  </x-property>
  <x-property name="transaction_code" type="string" required>
  由操作员生成。每个交易必须唯一。
  </x-property>
  <x-property name="transaction_timestamp" type="integer" required>
  由操作员生成。

  此参数描述交易请求时间范围。有关时间戳的更详细信息，请访问 [epochconverter](https://www.epochconverter.com/)。

  请注意，我们只处理这些限制的时间戳。

  `min`: 当前时间之前的 1 小时

  `max`: 当前时间之后的 5 分钟
  </x-property>
  <x-property name="payout_code" type="string" required>
  例如 `P001`。请联系管理员获取您的支付代码。
  </x-property>
  <x-property name="transaction_amount" type="double" required>
    交易金额。
  </x-property>
  <x-property name="user_id" type="string" required>
    可以由您系统上的用户密钥字段填充。例如：USR98323923。
  </x-property>
  <x-property name="currency_code" type="string" required>
  请参阅 [货币列表](/docs/currency)。
  </x-property>
  <x-property name="address" type="string" required>
  **加密付款时必填**
  这是用户的加密钱包地址。
  </x-property>
  <x-property name="bank_account_number" type="string" required>
  **必填** (INR, CNY, VND, THB, KRW, BDT, JPY, BRL 付款) BRL 使用 11 位身份证号码
  </x-property>
  <x-property name="ifsc_code" type="string" required>
  **仅对 INR 付款必填**
  </x-property>
  <x-property name="bank_code" type="string" required>
  **必填** (INR, CNY, VND, THB, BDT, IDR, MYR, KRW, JPY, BRL 和 PHP 付款)

  可用的 **INR 银行代码** 显示在 {brand} 后台提现菜单中的银行代码部分。

  可用的 [银行代码](/docs/banks)。
  </x-property>
  <x-property name="bank_name" type="string" required>
  **必填** (INR, CNY, VND, THB, BDT, IDR, MYR, KRW, JPY, BRL 和 PHP 付款)

  可用的 **INR 银行代码** 显示在 {brand} 后台提现菜单中的银行代码部分。

  可用的 [银行代码](/docs/banks)。
  </x-property>
  <x-property name="branch_code" type="string">
  **仅对 JPY 必填**。分行代码。
  </x-property>
  <x-property name="account_name" type="string" required>
  银行账户 / 钱包名称。
  </x-property>
  <x-property name="callback_url" type="string">
  URL 回调。我们将使用此 URL 将交易的更新状态发送到您这边。您可以选择在我们的 BO 上设置它，也可以通过此参数设置。如果您同时设置两者，那么我们也会向这两个 URL 发送回调。
  </x-property>
  <x-property name="phone_number" type="string">
  必填项（适用于BDT，11位数字，不带国家代码，例如：01812345678）
  </x-property>
</x-properties>

</x-col>
<x-col sticky>

```json title="参数对象"
{
  "merchant_code": "ABC123",
  "transaction_code": "TRX123456789",
  "transaction_timestamp": 1649700000,
  "payout_code": "P001",
  "transaction_amount": 100.50,
  "user_id": "user123",
  "currency_code": "USD",
  "address": "0x123456789abcdef",
  "bank_account_number": "1234567890",
  "ifsc_code": "12323",
  "bank_code": "XYZ",
  "bank_name": "Example Bank",
  "branch_code": null,
  "account_name": "John Doe",
  "callback_url": "https://example.com/callback"
}
```

这些参数必须在通过 [key](#request-body) 正文发送之前进行 [加密](/api/authentication)。

</x-col>
</x-row>

---

<x-row>
<x-col class="lg:max-w-md">

### 返回值

返回一个交易状态对象。如果发生错误，此调用将返回一个 [错误](/api/errors)。

</x-col>
<x-col sticky>

<x-code-group>

```json title="111"
{
    "success": true,
    "message": "Invalid Transaction Code ( not unique )!, error code 111"
}
```

```json title="200"
{
    "success": true,
    "message": "request withdraw successful"
}
```
</x-code-group>

</x-col>
</x-row>