---
title: Get Balance
method: GET
label: /api/v1/balance/{merchant_code}
toc: false
---

<x-row>
<x-col class="lg:max-w-md">

## Check balance amount

This API is used to check the merchant balance amount. It requires 1 parameter `key`, which is included by
`merchant_code`.

### Query Parameters

<x-properties>
  <x-property name="key" type="string" required>

  Key generated from [parameters](#parameters) with API key and API secret encryption.
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

### Parameters

<x-properties>
  <x-property name="merchant_code" type="string" required>
      The merchant code.
  </x-property>
</x-properties>

</x-col>
<x-col sticky>

```json title="Parameters Object"
{
    "merchant_code": "ABC123"
}
```
These parameters must be [encrypted](/api/authentication) before being sent through the [key](#query-parameters) query.

</x-col>
</x-row>

---

<x-row>
<x-col class="lg:max-w-md">

### Return

Returns a transaction status object. This call returns an [error](/api/errors) if an error occurs.

</x-col>
<x-col sticky>

```json title="Response"
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
