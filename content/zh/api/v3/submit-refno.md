---
title: 提交 BDT 的 Refno API
description: 仅适用于 BDT 的 RefNO 提交。
method: POST
label: /api/{merchant_code}/v3/submit-refno
toc: false
---

<x-row>
<x-col class="md:max-w-lg">

## 提交 RefNo
操作员需要提交 RefNo 以完成支付请求。

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
  --url {api_url}/api/{merchant_code}/v3/submit-refno \
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
  <x-property name="transaction_code" type="string" required>
    由操作员生成。每个交易必须唯一。
  </x-property>
  <x-property name="ref_no" type="string" required>
    无 Ref
  </x-property>
</x-properties>

</x-col>
<x-col sticky>


```json title="参数对象"
{
  "transaction_code": "success",
  "ref_no": "938294783732"
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

```json title="响应"
{
  "status": "success",
  "message": "Success Submit RefNo!"
}

```

</x-col>
</x-row>