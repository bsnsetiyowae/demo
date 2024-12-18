---
title: Payout Callback (Operator)
toc: false
---

<x-row>
<x-col class="md:max-w-lg">

After the operator sends payout requests, the provider will process it. Once the provider gets the transaction status
(success or failed), the provider will call this API to forward the transaction status.

Provider will send the parameter on key format, then operator need to decrypt it using
[encrypt/decrypt](/api/authentication), you need to decrypt with `api_key` and `api_secret`.

Besides the key, we also send the transaction code in the `transaction_code` parameter and the transaction
number
in the `transaction_no` parameter that is not encrypted.

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

## Parameters

<x-properties>
  <x-property name="transaction_no" type="string">
    The transaction code recorded by the provider.
  </x-property>
  <x-property name="transaction_code" type="string">
    The transaction code sent by the operator on payout request.
  </x-property>
  <x-property name="transaction_status" type="integer">
    The status of the payout transaction.
  </x-property>
  <x-property name="transaction_amount" type="double">
    The amount of of the transaction.
  </x-property>
  <x-property name="transaction_fee" type="double">
    The amount of fee transaction.
  </x-property>
  <x-property name="currency_code" type="string">
    Currency Code, please refer to currency list.
  </x-property>
  <x-property name="transaction_ref" type="double">
    Transaction reference of payout request.
  </x-property>
</x-properties>
</x-col>
<x-col sticky>

After **decrypting** the parameters, you will find that the response object are:

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