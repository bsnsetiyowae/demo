---
title: Cek Saldo
---

## Cek jumlah saldo

API ini digunakan untuk memeriksa jumlah saldo pedagang. Diperlukan 1 parameter pos `key`, yang disertakan oleh `merchant_code`.

### Parameter Kueri

<x-properties>
  <x-property name="key" type="string" required>

  Kunci yang dihasilkan dari [parameter](#parameters) dengan enkripsi `api_key` dan `secret_key`.
  </x-property>
</x-properties>

```bash title="cURL"
curl --request GET \
--url https://staging.s88pay.net/api/v1/balance/{merchant_code}?key={string}
```

---

### Parameters

<x-properties>
  <x-property name="merchant_code" type="string" required>
      Kode pedagang.
  </x-property>
</x-properties>

```json title="Objek Parameter"
{
    "merchant_code": "ABC123",
}
```

Parameter ini harus [dienkripsi](/api/authentication) sebelum dikirim melalui kueri [key](#query-parameters).

---

### Return

Mengembalikan objek status transaksi. Panggilan ini mengembalikan [error](/api/errors) jika terjadi error.

```json title="Respon"
{
    "balance": 100000,
    "currency_code": "INR",
    "currency_name": "Rupee India"
}
```