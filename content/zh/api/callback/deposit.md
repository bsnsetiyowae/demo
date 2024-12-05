---
title: 存款回调 (运营商)
toc: false
---

<x-row>
<x-col class="md:max-w-lg">

在运营商发送付款请求到 `dopayment` / `deposit` 后，提供商将处理请求。一旦提供商收到交易状态（成功或失败），提供商将调用此API以转发交易状态。

对于 `key` 参数，您需要使用 `api_key` 和 `api_secret` 进行解密。除了 `key` 参数，我们还会发送 `transaction_code` 参数和 `transaction_no` 参数，这些参数未加密。

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

## 响应

  <x-properties>
    <x-property name="transaction_code" type="string">
        运营商在付款请求中发送的交易代码。
    </x-property>
    <x-property name="transaction_status" type="integer">
        存款交易的状态。
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
    <x-property name="transaction_no" type="string">
        提供商数据库中的交易代码。
    </x-property>
    <x-property name="transaction_actual_amount" type="double">
        会员实际支付的金额。
    </x-property>
  </x-properties>
</x-col>
<x-col sticky>

解密参数后，您将看到响应对象如下：

```json title="响应对象"
 {
    "transaction_code": "DP-16873xxxxx",
    "transaction_status": "success",
    "transaction_amount": "510.00",
    "transaction_fee": "5.10",
    "currency_code": "BDT",
    "transaction_no": "DP16873387xxxxx",
    "transaction_actual_amount": "504.9"
}
```

</x-col>
</x-row>