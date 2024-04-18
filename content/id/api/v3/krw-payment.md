---
title: Pembayaran
description: Buat permintaan pembayaran hanya untuk KRW.
method: POST
label: /api/{kode_pedagang}/v3/krw-payment
toc: false
---

<x-row>
<x-col class="md:max-w-lg">

## Buat Pembayaran

API ini digunakan untuk membuat permintaan pembayaran. API ini memerlukan 1 parameter `key`, yang berisi kombinasi parameter yang dipisahkan oleh karakter `&` dan kemudian dienkripsi menggunakan algoritma encrypt_decrypt.

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
  --url https://staging.s88pay.net/api/{kode_pedagang}/v3/krw-payment \
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
  <x-property name="merchant_code" type="string" required>
    Diberikan oleh Pemberi Layanan.
  </x-property>
  <x-property name="merchant_api_key" type="string" required>
    Diberikan oleh Pemberi Layanan.
  </x-property>
  <x-property name="transaction_code" type="string" required>
    Dibuat oleh operator. Harus unik untuk setiap transaksi.
  </x-property>
  <x-property name="transaction_timestamp" type="integer" required>
  Dibuat oleh operator. 
  
  Parameter ini menjelaskan rentang waktu permintaan transaksi
  TimeRanges. Untuk informasi lebih detail mengenai timestamp, silakan kunjungi https://www.epochconverter.com/.

  Harap dicatat bahwa kami hanya memproses timestamp pada batas ini.

  `min`: 1 jam sebelum sekarang

  `max`: 5 menit setelah sekarang
  </x-property>
  <x-property name="transaction_amount" type="double" required>
    Jumlah transaksi.
  </x-property>
  <x-property name="payment_code" type="string" required>
    Contoh `P001`. Silakan hubungi administrator untuk mendapatkan kode pembayaran Anda.
  </x-property>
  <x-property name="user_id" type="string" required>
  </x-property>
  <x-property name="currency_code" type="string" required>
    Silakan lihat [daftar mata uang](/docs/currency).
  </x-property>
  <x-property name="bank_code" type="double" required>
    Diperlukan hanya pada  [BDT](/docs/bank/bdt), [VND](/docs/bank/vnd), [THB](/docs/bank/thb), [IDR](/docs/bank/idr), [MYR](/docs/bank/myr), dan [PHP](/docs/bank/php) metode pembayaran online bank.
  </x-property>
  <x-property name="deposit_name" type="string" required>
    Nama deposit (wajib untuk KRW).
  </x-property>
</x-properties>

</x-col>
<x-col sticky>

```json title="Objek Parameter"
{
  "merchant_code": "kode_merchant_dari_provider",
  "merchant_api_key": "api_key_merchant_dari_provider",
  "transaction_code": "kode_unik_untuk_transaksi_ini",
  "transaction_timestamp": 1649767200, 
  "transaction_amount": 99.99,
  "payment_code": "P001",
  "user_id": "id_pengguna",
  "currency_code": "USD",
  "bank_code": "001", 
  "deposit_name": "nama_deposit" 
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
  "step": 1,
  "message": "Submit Transaction Success! Please submit Depositor Name, Bank Code and Account Number.",
  "transaction_code": "TEST-DP-1697797081",
  "amount": 10000,
  "bank_lists": [
    "<any>"
  ]
}
```

</x-col>
</x-row>