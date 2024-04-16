---
title: Kirim UTR Untuk INR Saja
method: POST
label: /api/{merchant_code}/v3/krw-payment
toc: false
---

<x-row>
<x-col class="md:max-w-lg">

## Kirim UTR
Operator perlu mengirimkan UTR untuk menyelesaikan permintaan pembayaran.

### Badan Permintaan

<x-properties>
  <x-property name="key" type="string" required>
  
  Kunci yang dihasilkan dari [parameter](#parameters) dengan enkripsi `api_key` dan `secret_key`.
  </x-property>
</x-properties>

</x-col>
<x-col sticky>

```bash title="cURL"
curl --request POST \
  --url https://staging.s88pay.net/api/{merchant_code}/v3/submit-utr \
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

### Parameter

<x-properties>
  <x-property name="transaction_code" type="string" required>
    Dihasilkan oleh operator. Harus unik untuk setiap transaksi.
  </x-property>
  <x-property name="utr" type="string" required>
    Nomor unik 12 digit.
  </x-property>
</x-properties>

</x-col>
<x-col sticky>

```json title="Objek Parameter"
{
  "transaction_code": "success",
  "utr": "938294783732"
}
```

Parameter-parameter ini harus [dienkripsi](/api/authentication) sebelum dikirim melalui badan [kunci](#request-body) permintaan.

</x-col>
</x-row>

---

<x-row>
<x-col class="lg:max-w-md">

### Respons

Mengembalikan objek status transaksi. Panggilan ini mengembalikan [error](/api/errors) jika terjadi error.

</x-col>
<x-col sticky>

```json title="Respon"
{
  "status": "success",
  "message": "Berhasil Mengirim Utr!"
}
```

</x-col>
</x-row>