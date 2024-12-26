---
title: 交易状态
method: POST
label: /api/v1/{merchant_code}/transactions/status
toc: false
---

<x-row>
<x-col class="lg:max-w-md">

## 检查交易状态

此API用于检查交易状态。它需要1个参数 `key`，包括 `merchant_api_key` 和 `transaction_code`。

### 表单数据

<x-properties>
  <x-property name="key" type="string" required>
  
  从[参数](#parameters)生成的密钥，带有API密钥和API密钥加密。
  </x-property>
</x-properties>

</x-col>
<x-col sticky>

```bash title="cURL"
curl --request POST \
--url {api_url}/api/v1/{merchant_code}/transactions/status \
--header 'Content-Type: application/x-www-form-urlencoded' \
--data key=string
```

<x-sandbox method="POST" contentType="application/x-www-form-urlencoded" url="/api/v1/{merchant_code}/transactions/status" payload='key={key}' />

</x-col>
</x-row>

---

<x-row>
<x-col class="lg:max-w-md">

### 参数

<x-properties>
    <x-property name="merchant_api_key" type="string" required>
        提供商提供的。
    </x-property>
    <x-property name="transaction_code" type="number" required>
        由操作员生成。这是之前已经发送给支付请求api的交易代码。
    </x-property>
</x-properties>

</x-col>
<x-col sticky>

```json title="参数对象"
{
  "merchant_api_key": "xyz456",
  "transaction_code": "TRX123456789"
}
```
这些参数必须在通过[key](#query-parameters)表单数据发送之前进行[加密](/api/authentication)。

</x-col>
</x-row>

---

<x-row>
<x-col class="lg:max-w-md">

### 返回

返回一个交易状态对象。如果发生错误，此调用将返回一个[错误](/api/errors)。

</x-col>
<x-col sticky>

```json title="响应"
{
  "data": [
    {
      "amount": 500,
      "currency_code": "INR",
      "currency_name": "印度卢比",
      "datetime": "2023-11-07T05:31:56Z",
      "method_name": "UPI 3",
      "note": "null",
      "status": "pending",
      "transaction_code": "TEST-DP-1678780607",
      "transaction_fee": 15,
      "transaction_no": "DP1678780607892",
      "transaction_ref": "null",
      "transaction_ref2": "null",
      "type": "deposit"
    }
  ],
  "message": "请求交易列表成功",
  "success": true
}
```

</x-col>
</x-row>