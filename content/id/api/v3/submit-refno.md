```markdown
---
title: Submit RefNo API
description: Submit RefNO hanya untuk BDT.
method: POST
label: /api/{kode_pedagang}/v3/krw-payment
toc: false
---

<x-row>
<x-col class="md:max-w-lg">

## Submit RefNo
Operator perlu mengirimkan RefNo untuk menyelesaikan permintaan pembayaran.

### Permintaan Body

<x-properties>
  <x-property name="key" type="string" required>
  
  Kunci yang dihasilkan dari [parameter](#parameters) dengan enkripsi kunci API dan rahasia API.
  </x-property>
</x-properties>

</x-col>
<x-col sticky>

```bash title="cURL"
curl --request POST \
  --url https://staging.s88pay.net/api/{kode_pedagang}/v3/submit-refno \
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

### Parameters

<x-properties>
  <x-property name="transaction_code" type="string" required>
    Dibuat oleh operator. Harus unik untuk setiap transaksi.
  </x-property>
  <x-property name="ref_no" type="string" required>
    No Ref
  </x-property>
</x-properties>

</x-col>
<x-col sticky>


```json title="Objek Parameter"
{
  "transaction_code": "success",
  "ref_no": "938294783732"
}
```

Parameter-parameter ini harus [dienkripsi](/api/authentication) sebelum dikirim melalui [key](#request-body) body.

</x-col>
</x-row>

---

<x-row>
<x-col class="lg:max-w-md">

### Return

Mengembalikan objek status transaksi. Panggilan ini mengembalikan [kesalahan](/api/errors) jika terjadi kesalahan.

</x-col>
<x-col sticky>

```json title="Respons"
{
  "status": "success",
  "message": "Success Submit RefNo!"
}
```


</x-col>
</x-row>