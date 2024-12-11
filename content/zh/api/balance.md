---
title: 获取余额
method: GET
label: /api/v1/balance/{merchant_code}
toc: false
---

<x-row>
<x-col class="lg:max-w-md">

## 检查余额

此 API 用于检查商户余额。它需要一个 `key` 参数，其中包含 `merchant_code`。

### 查询参数

<x-properties>
  <x-property name="key" type="string" required>
  
  通过 [参数](#parameters) 使用 API 密钥和 API 密钥加密生成的 Key。
  </x-property>
</x-properties>

</x-col>
<x-col sticky>

```bash title="cURL"
curl --request GET \
--url {api_url}/api/v1/balance/{merchant_code} \
--header 'Content-Type: application/json' \
--data '{
    "key": "<string>",
}'
```

</x-col>
</x-row>

---

<x-row>
<x-col class="lg:max-w-md">

### 参数

<x-properties>
  <x-property name="merchant_code" type="string" required>
      商户代码。
  </x-property>
</x-properties>

</x-col>
<x-col sticky>

```json title="参数对象"
{
    "merchant_code": "ABC123"
}
```
这些参数必须在通过 [key](#query-parameters) 查询发送之前进行 [加密](/api/authentication)。

</x-col>
</x-row>

---

<x-row>
<x-col class="lg:max-w-md">

### 返回

返回一个交易状态对象。如果发生错误，此调用返回 [错误](/api/errors)。

</x-col>
<x-col sticky>

```json title="响应"
{
    "currency_name": "Korean Won",
    "currency_code": "KRW",
    "balance": "2033968.739",
    "frozen_balance": "1997683.660",
    "available_balance": "36285.079"
}
```

</x-col>
</x-row>