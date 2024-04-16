---
title: Pencairan Dana
method: POST
label: /api/v1/payout/{merchant_code}
toc: false
---

<x-row>
<x-col class="md:max-w-lg">

## Proses pencairan dana

API ini digunakan untuk mengajukan permohonan pencairan dana. Diperlukan beberapa parameter untuk mengirimkan pencairan. Periksa status transaksi. Diperlukan permintaan terenkripsi dengan `kunci rahasia` dan `kunci pedagang`.

### Permintaan Data

<x-properties>
  <x-property name="key" type="string" required>
  
  Kunci yang dihasilkan dari [parameter](#parameters) dengan enkripsi kunci API dan kunci rahasia API.
  </x-property>
</x-properties>

</x-col>
<x-col sticky>

```bash title="cURL"
curl --request POST \
  --url https://staging.{brand}.net/api/v1/payout/{merchant_code} \
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
  Disediakan oleh Penyedia.
  </x-property>
  <x-property name="transaction_code" type="string" required>
  Dihasilkan oleh operator. Harus unik untuk setiap transaksi.
  </x-property>
  <x-property name="transaction_timestamp" type="integer" required>
  Dibuat oleh operator.

  Parameter ini menggambarkan Waktu Permintaan Transaksi. Informasi lebih detail mengenai timestamp, kunjungi [epochconverter](https://www.epochconverter.com/).

  Harap dicatat bahwa kami hanya memproses timestamp pada batas-batas berikut.

  `min`: 1 jam sebelum sekarang

  `max`: 5 menit setelah sekarang
  </x-property>
  <x-property name="payout_code" type="string" required>
  Contoh `P001`. Silakan hubungi administrator untuk mendapatkan kode pembayaran Anda.
  </x-property>
  <x-property name="transaction_amount" type="double" required>
    Jumlah transaksi.
  </x-property>
  <x-property name="user_id" type="string" required>
    ID pengguna.
  </x-property>
  <x-property name="currency_code" type="string" required>
  Silakan lihat [daftar mata uang](/docs/currency).
  </x-property>
  <x-property name="address" type="string" required>
  <Warning>diperlukan untuk pencairan kripto</Warning>
  Ini adalah alamat dompet kripto pengguna.
  </x-property>
  <x-property name="back_account_number" type="string" required>
  <Warning>diperlukan untuk (Pencairan INR, CNY, VND, THB, KRW, BDT, JPY,BRL)</Warning>
  <Warning>untuk BRL digunakan Kartu Identitas dengan 11 digit</Warning>
  </x-property>
  <x-property name="bank_code" type="string" required>
  <Warning>diperlukan untuk (Pencairan INR, CNY, VND, THB, BDT, IDR, MYR, KRW, JPY,BRL, dan PHP)</Warning>

  Kode bank INR yang tersedia ditampilkan pada bagian kode bank di Backoffice {brand} dalam Menu Tarik.

  Kode bank [CNY yang tersedia](/docs/bank/cny).

  Kode bank [THB yang tersedia](/docs/bank/thb).

  Kode bank **BRL** yang tersedia menggunakan nilai akun.
  </x-property>
  <x-property name="bank_name" type="string" required>
  <Warning>diperlukan untuk (Pencairan INR, CNY, VND, THB, BDT, IDR, MYR, KRW, JPY,BRL, dan PHP)</Warning>

  Kode bank INR yang tersedia ditampilkan pada bagian kode bank di Backoffice {brand} dalam Menu Tarik.

  Kode bank [CNY yang tersedia](/docs/bank/cny).

  Kode bank [THB yang tersedia](/docs/bank/thb).

  Kode bank **BRL** yang tersedia menggunakan nilai akun.
  </x-property>
  <x-property name="branch_code" type="string">
  <Warning>Hanya diperlukan untuk **JPY**. Kode Cabang.</Warning>
  </x-property>
  <x-property name="account_name" type="string" required>
  Nama Akun Bank / Dompet.
  </x-property>
  <x-property name="callback_url" type="string">
  url callback selain url yang diatur dari Backoffice.
  </x-property>
</x-properties>

</x-col>
<x-col sticky>

```json

 title="Object Parameter"
{
  "merchant_code": "ABC123",
  "transaction_code": "TRX123456789",
  "transaction_timestamp": 1649700000,
  "payout_code": "P001",
  "transaction_amount": 100.50,
  "user_id": "user123",
  "currency_code": "USD",
  "address": "0x123456789abcdef",
  "bank_account_number": "1234567890",
  "bank_code": "XYZ",
  "bank_name": "Example Bank",
  "branch_code": null,
  "account_name": "John Doe",
  "callback_url": "https://example.com/callback"
}
```

Parameter-parameter ini harus [dienkripsi](/api/authentication) sebelum dikirim melalui [key](#request-body) permintaan.

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
    "message": "permohonan penarikan berhasil",
    "success": true
}
```

</x-col>
</x-row>