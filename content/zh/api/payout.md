---
title: 提款
description: 提款 API。
---

## 提交提款请求

该 API 用于提交提款请求。它需要一些参数来提交提款。检查交易状态。需要使用 `secret key` 和 `merchant key` 对请求进行加密。

### 请求体

<x-properties>
  <x-property name="key" type="string" required>
  
  使用 API 密钥和 API 密钥加密从 [parameters](#parameters) 生成的密钥。
  </x-property>
</x-properties>

```bash
curl --request POST \
  --url https://staging.{brand}.net/api/v1/payout/{merchant_code} \
  --header 'Content-Type: application/json' \
  --data '{
  "key": "<string>"
    }'
```

---

### 参数

```markdown
---
title: 提款
description: 提款 API。
---

## 提交提款请求

该 API 用于提交提款请求。它需要一些参数来提交提款。检查交易状态。需要使用 `secret key` 和 `merchant key` 对请求进行加密。

### 请求体

<x-properties>
  <x-property name="key" type="string" required>
  
  使用 API 密钥和 API 密钥加密从 [parameters](#parameters) 生成的密钥。
  </x-property>
</x-properties>

```bash
curl --request POST \
  --url https://staging.{brand}.net/api/v1/payout/{merchant_code} \
  --header 'Content-Type: application/json' \
  --data '{
  "key": "<string>"
    }'
```

---

### 参数

<x-properties>
  <x-property name="merchant_code" type="string" required>
  由提供商提供。
  </x-property>
  <x-property name="transaction_code" type="string" required>
  运营商生成。每个交易必须是唯一的。
  </x-property>
  <x-property name="transaction_timestamp" type="integer" required>
  运营商生成。

  此参数描述了交易请求的时间范围。关于时间戳的更详细信息，请访问 [epochconverter](https://www.epochconverter.com/)。

  请注意，我们仅在这些限制上处理时间戳。

  `min`: 现在之前的1小时

  `max`: 现在之后的5分钟
  </x-property>
  <x-property name="payout_code" type="string" required>
  例如 `P001`。请联系管理员获取您的付款代码。
  </x-property>
  <x-property name="transaction_amount" type="double" required>
    交易金额。
  </x-property>
  <x-property name="user_id" type="string" required>
    用户标识符。
  </x-property>
  <x-property name="currency_code" type="string" required>
  请参考 [currency list](/docs/currency)。
  </x-property>
  <x-property name="address" type="string" required>
  **加密方式** 用于加密
  用户的加密钱包地址。
  </x-property>
  <x-property name="bank_account_number" type="string" required>
  **必需的**（INR，CNY，VND，THB，KRW，BDT，JPY，BRL 提款）BRL 使用 11 位身份证。
  </x-property>
  <x-property name="ifsc_code" type="string" required>
  **仅适用于** INR 提款。
  </x-property>
  <x-property name="bank_code" type="string" required>
  **必需的**（INR，CNY，VND，THB，BDT，IDR，MYR，KRW，JPY，BRL 和 PHP 提款）

  在 {brand} 后台的提款菜单中显示的可用 **INR 银行代码**。

  可用的 [CNY bank code](/docs/bank/cny)。

  可用的 [THB bank code](/docs/bank/thb)。

  可用的 [BRL bank code](/docs/bank/brl)。
  </x-property>
  <x-property name="bank_name" type="string" required>
  **必需的**（INR，CNY，VND，THB，BDT，IDR，MYR，KRW，JPY，BRL 和 PHP 提款）

  在 {brand} 后台的银行代码部分显示的可用 **INR 银行代码**。

  可用的 [CNY bank code](/docs/bank/cny)。

  可用的 [THB bank code](/docs/bank/thb)。

  可用的 **BRL** 使用账户价值。
  </x-property>
  <x-property name="branch_code" type="string">
  **仅适用于** JPY。分行代码。
  </x-property>
  <x-property name="account_name" type="string" required>
  银行账户 / 钱包名称。
  </x-property>
  <x-property name="callback_url" type="string">
  除了后台设置的 URL 回调。
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

这些参数在通过 [key](#request-body) 请求体发送之前必须进行 [加密](/api/authentication)。

</x-col>
</x-row>

---

<x-row>
<x-col class="lg:max-w-md">

### 返回

返回交易状态对象。如果发生错误，该调用将返回一个 [错误](/api/errors)。

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