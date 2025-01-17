---
title: 付款
method: GET
label: /{merchant_code}/v2/dopayment
toc: false
---

<x-row>
<x-col class="md:max-w-lg">


## 发起付款请求

此 API 用于创建付款请求。此 API 需要一个 `key` 参数，该参数包含由参数组成的字符串，使用 & 字符分隔，然后使用 encrypt_decrypt 算法加密。

### 查询参数

<x-properties>
  <x-property name="key" type="string" required>
  
  由 [参数](#parameters) 与 API 密钥和 API 密钥加密生成的 Key。
  </x-property>
</x-properties>

</x-col>
<x-col sticky>

```bash title="cURL"
curl --request GET \
  --url {api_url}/{merchant_code}/v2/dopayment?key={string}
```

<x-sandbox method="GET" contentType="application/json" url="/{merchant_code}/v2/dopayment?key={key}" />

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
    由运营商生成。每个交易必须唯一。
  </x-property>
  <x-property name="transaction_timestamp" type="integer" required>
    由运营商生成。
  
  此参数描述交易请求的时间范围。有关时间戳的详细信息，请访问 https://www.epochconverter.com/。

  请注意，我们只处理以下范围内的时间戳。

  `min`: 当前时间前1小时

  `max`: 当前时间后5分钟
  </x-property>
  <x-property name="transaction_amount" type="double" required>
    交易金额。
  </x-property>
  <x-property name="payment_code" type="string" required>
    请联系管理员获取您的支付代码。例如 `P001`。 
  </x-property>
  <x-property name="user_id" type="string" required>
    可以由您系统上的用户密钥字段填写。例如：USR98323923
  </x-property>
  <x-property name="currency_code" type="string" required>
    请参考 [货币列表](/docs/currency)。
  </x-property>
  <x-property name="bank_code" type="double">
    仅在 [VND](/docs/bank/vnd)、[THB](/docs/bank/thb)、[IDR](/docs/bank/idr)、[MYR](/docs/bank/myr) 和 [PHP](/docs/bank/php) 在线银行支付时需要。
  </x-property>
  <x-property name="callback_url" type="string">
    URL 回调。我们将使用此 URL 将交易的更新状态发送到您这边。您可以选择在我们的 BO 上设置它，也可以通过此参数设置。如果您同时设置两者，那么我们也会向这两个 URL 发送回调。
  </x-property>
  <x-property name="return_url" type="string">
    在完成交易后重定向回商户页面的动态返回URL。
  </x-property>
  <x-property name="random_bank_code" type="string">
  仅适用于 VND（电子钱包使用 BankQR 值，银行转账使用 OBT 值）。

  如果填写此参数，我们的系统将搜索可用的银行渠道并随机显示给您的用户。在这种情况下，您无需填写 bank_code 参数。
  </x-property>
</x-properties>

</x-col>
<x-col sticky>

```text title="參數範例"
merchant_code=ABC123&merchant_api_key=xyz456&transaction_code=TRX123456789&transaction_timestamp=1649699762&transaction_amount=100.50&payment_code=P001&user_id=user123&currency_code=USD&bank_code=null&callback_url=https://example.com/callback&return_url=https://example.com/return&random_bank_code=null
```
这些参数必须在通过 [key](#query-parameters) 查询发送之前进行 [加密](/api/authentication)。

</x-col>
</x-row>

---

<x-row>
<x-col>

### 返回

返回 **重定向到我们的支付页面**。如果发生错误，此调用返回 [错误](/api/errors)。
</x-col>
</x-row>
