---
title: Submit Depositor
method: POST
label: /api/{kode_pedagang}/v3/krw-submit-information
toc: false
---

<x-row>
<x-col class="md:max-w-lg">

## Submit Depositor

operator perlu mengirimkan informasi akun depositor untuk menyelesaikan permintaan pembayaran.

### Request Body

<x-properties>
  <x-property name="key" type="string" required>
  
  Kunci yang dihasilkan dari [parameter](#parameters) dengan enkripsi `api_key` dan `secret_key`.
  </x-property>
</x-properties>


</x-col>
<x-col sticky>

```bash title="cURL"
curl --request POST \
  --url https://staging.s88pay.net/api/{kode_pedagang}/v3/krw-submit-information \
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
    Dibuat oleh operator. Harus unik untuk setiap transaksi.
  </x-property>
  <x-property name="bank_code" type="string" required></x-property>
  <x-property name="account_number" type="string" required>
    Nomor Rekening Bank.
  </x-property>
</x-properties>

</x-col>
<x-col sticky>

```json title="Objek Parameter"
{
  "transaction_code": "TEST-DP-1697797081",
  "bank_code": "Nama Bank Tujuan",
  "account_number": "Nomor Rekening Bank Tujuan"
}
```

Parameter-parameter ini harus [dienkripsi](/api/authentication) sebelum dikirim melalui [key](#request-body) body.

</x-col>
</x-row>

---

<x-row>
<x-col class="lg:max-w-md">

### Return

Mengembalikan objek status transaksi. Panggilan ini mengembalikan [error](/api/errors) jika terjadi error.

</x-col>
<x-col sticky>

```json title="Respons"
{
  "status": "success",
  "step": 2,
  "message": "Berhasil Mengirimkan Informasi Depositor.",
  "transaction_no": "DP1697797081482",
  "transaction_code": "TEST-DP-1697797081",
  "amount": "10000.00",
  "bank_name": "Nama Bank Tujuan",
  "account_name": "Nama Rekening Bank Tujuan",
  "account_number": "Nomor Rekening Bank Tujuan"
}
```

</x-col>
</x-row>