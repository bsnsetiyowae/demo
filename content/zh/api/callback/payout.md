---
title: 付款回调 (运营商)
---

<x-row>
<x-col class="md:max-w-lg">

在运营商发送付款请求后，提供商将处理该请求。一旦提供商获得交易状态（成功或失败），提供商将调用此API以转发交易状态。

提供商将参数以键格式发送，然后运营商需要使用[加密/解密](/api/authentication)进行解密，您需要使用 `api_key` 和 `api_secret` 进行解密。

除了键参数，我们还发送 `transaction_code` 参数和 `transaction_no` 参数，这些参数未加密。

</x-col>
<x-col sticky>

```bash title="cURL"
curl --request POST \
--url {api_url}/api/v1/transaction/resend-callback/SKU20210909025705 \
--header 'Content-Type: application/json' \
--data '{
    "key": "<string>",
    "transaction_code": "<string>",
    "transaction_no": "<string>"
}'
```

</x-col>
</x-row>

---

<x-row>
<x-col class="md:max-w-lg">

## 响应对象

<x-properties>
  <x-property name="transaction_no" type="string">
    提供商记录的交易编号。
  </x-property>
  <x-property name="transaction_code" type="string">
    运营商在付款请求中发送的交易代码。
  </x-property>
  <x-property name="transaction_status" type="integer">
    付款交易的状态。
  </x-property>
  <x-property name="transaction_amount" type="double">
    交易金额。
  </x-property>
  <x-property name="transaction_fee" type="double">
    交易费用。
  </x-property>
  <x-property name="currency_code" type="string">
    货币代码，请参阅货币列表。
  </x-property>
  <x-property name="transaction_ref" type="double">
    付款请求的交易参考。
  </x-property>
</x-properties>

</x-col>
<x-col sticky>

解密参数后，您将看到响应对象如下：

```json
{
    "transaction_no": "WD-987XXXXX",
    "transaction_code": "WD8765XXXX",
    "transaction_status": "completed",
    "transaction_amount": "3000.00",
    "transaction_fee": "10.00",
    "currency_code": "BDT",
    "transaction_ref": ""
}
```

</x-col>
</x-row>