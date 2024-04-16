---
title: Pembayaran
method: GET
label: /{merchant_code}/v2/dopayment
toc: false
---

<x-row>
<x-col class="md:max-w-lg">

## Buat Pembayaran

API ini digunakan untuk membuat permintaan pembayaran. API ini memerlukan 1 parameter `key`, yang berisi kombinasi parameter yang dipisahkan oleh karakter & kemudian dienkripsi menggunakan algoritma encrypt_decrypt.

### Parameter Kueri

<x-properties>
  <x-property name="key" type="string" required>
  
  Kunci yang dihasilkan dari [parameter](#parameters) dengan enkripsi kunci API dan kunci rahasia API.
  </x-property>
</x-properties>

</x-col>
<x-col sticky>

```bash title="cURL"
curl --request GET \
  --url https://staging.s88pay.net/{merchant_code}/v2/dopayment?key={string}
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
  <x-property name="merchant_api_key" type="string" required>
    Disediakan oleh Penyedia.
  </x-property>
  <x-property name="transaction_code" type="string" required>
    Dihasilkan oleh operator. Harus unik untuk setiap transaksi.
  </x-property>
  <x-property name="transaction_timestamp" type="integer" required>
    Dibuat oleh operator. 

    Parameter ini menggambarkan Waktu Permintaan Transaksi. Informasi lebih detail mengenai timestamps, kunjungi https://www.epochconverter.com/.

    Harap dicatat bahwa kami hanya memproses timestamp pada batas-batas berikut.

    `min`: 1 jam sebelum sekarang

    `max`: 5 menit setelah sekarang
  </x-property>
  <x-property name="transaction_amount" type="double" required>
    Jumlah transaksi.
  </x-property>
  <x-property name="payment_code" type="string" required>
    Silakan hubungi administrator untuk mendapatkan kode pembayaran Anda. Contoh `P001`. 
  </x-property>
  <x-property name="user_id" type="string" required>
  </x-property>
  <x-property name="currency_code" type="string" required>
    Silakan lihat [daftar mata uang](/docs/currency).
  </x-property>
  <x-property name="bank_code" type="double">
    Hanya diperlukan pada [VND](/docs/bank/vnd), [THB](/docs/bank/thb), [IDR](/docs/bank/idr), [MYR](/docs/bank/myr), dan [PHP](/docs/bank/php) metode pembayaran bank online.
  </x-property>
  <x-property name="callback_url" type="string">
    URL callback selain URL yang diatur dari Backoffice.
  </x-property>
  <x-property name="return_url" type="string">
    URL kembali dinamis untuk mengalihkan kembali ke halaman pedagang setelah menyelesaikan transaksi.
  </x-property>
  <x-property name="random_bank_code" type="string">
    Hanya untuk VND (Gunakan nilai BankQR untuk E-Wallet dan OBT untuk transfer bank).
  </x-property>
</x-properties>

</x-col>
<x-col sticky>

```json title="Objek Parameter"
{
  "merchant_code": "ABC123",
  "merchant_api_key": "xyz456",
  "transaction_code": "TRX123456789",
  "transaction_timestamp": 1649699762,
  "transaction_amount": 100.50,
  "payment_code": "P001",
  "user_id": "user123",
  "currency_code": "USD",
  "bank_code": null,
  "callback_url": "https://example.com/callback",
  "return_url": "https://example.com/return",
  "random_bank_code": null
}
```
Parameter-parameter ini harus [dienkripsi](/api/authentication) sebelum dikirim melalui [key](#query-parameters) query.

</x-col>
</x-row>

---

<x-row>
<x-col>

### Respons

Mengembalikan pengalihan ke halaman pembayaran kami. Panggilan ini mengembalikan [error](/api/errors) jika terjadi error.
</x-col>
</x-row>
