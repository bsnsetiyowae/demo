---
title: Memulai dengan API {brand}
description: Kirim permintaan API pertama Anda.
toc: true
---

## Sebelum Anda Memulai

Pertama, pastikan Anda memenuhi persyaratan awal untuk proses yang lancar.

## Kirim permintaan API pertama Anda

Untuk membuat permintaan ke API {brand}, operator harus membuat URL yang berisi token dan parameter menggunakan algoritma kami sendiri. Anda dapat merujuk ke bagian **Fungsi API** untuk URL dan parameter, dan [Otentikasi & Keamanan](/api/authentication) untuk algoritma.

Misalnya, jika kita ingin membuat permintaan pembayaran, kita menggunakan [Titik Akhir Pembayaran](/api/payment) untuk mengirim permintaan tersebut. Kemudian, kita lihat parameter apa yang diperlukan.

<x-steps>

### Gabungkan semua parameter menjadi satu string, dipisahkan oleh karakter `&`

Misalnya, untuk membuat permintaan di layanan kami.

```php
$str = "merchant_code=xxx&'
    .'merchant_api_key=xxx&'
    .'transaction_code=xxx&'
    .'transaction_timestamp=xxx&'
    .'payment_code=xxx&'
    .'transaction_amount=xxx&'
    .'user_id=xxx&'
    .'currency_code=xxx"
```

### Enkripsi menggunakan encrypt_decrypt

Acuannya adalah keamanan pada prasyarat, atribut yang akan dikirim biasanya hanya menggunakan **satu kunci** dengan parameter yang dienkripsi. Untuk informasi lebih lanjut, baca lebih lanjut di [Otentikasi & Keamanan](/api/authentication).

Contoh enkripsi:

```php
$key = encrypt_decrypt('encrypt', $str, '{your_api_key}', '{your_secret_key}')
```

### Selesai

Jadi, permintaan akan terlihat seperti ini: 

`https://{base_url}/{merchant_code}/v2/dopayment?key=3eX%2Bf%2BMoVECXxSkKqV7aBRYIbyWg3DxdPdgZyG%2B377a7dR1OBBDNnU%2B%2Fvtn7hUyjP7WWdZ7gCsPF0J%2BJOiSxb1BFueIyRX3rxbSMa%2B%2FAyFvhz4L%2F2wJmSJKcNQn4whIL1sc1cfj7E1smQFAiYjfLXdY1Ev6Pnoit8Vouex3%2BupnZjJS8t44XRx5wugB5GuybZWPtlPhiN%2FP7P4uJW3RlFlo%2BtYrnHQ6GwqwRkoLrdv3qZXUzaatT8EWdztr973KWFDof2rVD%2B56SMAVrRHQZcYICU8RcjpyvJUaCtXpOKKg%3D`

</x-steps>

Setelah URL permintaan dibuat, respons akan bergantung pada masing-masing titik akhir. lihat [bagian return](/api/payment#return) untuk melihat respons apa yang akan diterima.