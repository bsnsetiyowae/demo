---
title: MMK 提交存款账户
method: POST
label: /api/{merchant_code}/v3/submit-depositor
toc: false
---

<x-row>
<x-col class="md:max-w-lg">

## 提交存款账户

操作员需要提交存款人账户以完成支付请求。

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
  --url {api_url}/api/{merchant_code}/v3/submit-depositor \
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
    由操作员生成。每笔交易必须唯一。
  </x-property>
  <x-property name="depositor_name" type="string" required>
  </x-property>
</x-properties>

</x-col>
<x-col sticky>

```json title="参数对象"
{
  "transaction_code": "TEST001",
  "depositor_name": "",
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
  "message": "[DP] Success Submitted Depositor Name!.",
}
```

</x-col>
</x-row>