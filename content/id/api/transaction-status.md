---
title: Status Transaksi
method: POST
label: /api/v1/{merchant_code}/transactions/status
toc: false
---

<x-row>
<x-col class="lg:max-w-md">

## Periksa status transaksi

API ini digunakan untuk memeriksa status transaksi. Ini memerlukan 1 parameter `key`, yang disertakan oleh `merchant_api_key` dan `transaction_code`.

### Data Form

<x-properties>
  <x-property name="key" type="string" required>
  
  Kunci dihasilkan dari [parameter](#parameters) dengan enkripsi `api_key` dan `secret_key`.
  </x-property>
</x-properties>

</x-col>
<x-col sticky>

```bash title="cURL"
curl --request POST \
--url https://staging.s88pay.net/api/v1/{merchant_code}/transactions/status \
--header 'Content-Type: application/x-www-form-urlencoded' \
--data key=string
```

</x-col>
</x-row>

---

<x-row>
<x-col class="lg:max-w-md">

### Parameter

<x-properties>
    <x-property name="merchant_api_key" type="string" required>
        Disediakan oleh Pemberi Layanan.
    </x-property>
    <x-property name="transaction_code" type="number" required>
        Dihasilkan oleh operator. Harus unik untuk setiap transaksi.
    </x-property>
</x-properties>

</x-col>
<x-col sticky>

```json title="Objek Parameter"
{
  "merchant_api_key": "xyz456",
  "transaction_code": "TRX123456789",
}
```
Parameter-parameter ini harus [dienkripsi](/api/authentication) sebelum dikirim melalui form data [key](#query-parameters).

</x-col>
</x-row>

---

<x-row>
<x-col class="lg:max-w-md">

### Hasil

Mengembalikan objek status transaksi. Panggilan ini mengembalikan [error](/api/errors) jika terjadi error.

</x-col>
<x-col sticky>

```json title="Respons"
{
  "data": [
    {
      "amount": 500,
      "currency_code": "INR",
      "currency_name": "Rupee India",
      "datetime": "2023-11-07T05:31:56Z",
      "method_name": "UPI 3",
      "note": "null",
      "status": "menunggu",
      "transaction_code": "TEST-DP-1678780607",
      "transaction_fee": 15,
      "transaction_no": "DP1678780607892",
      "transaction_ref": "null",
      "transaction_ref2": "null",
      "type": "deposit"
    }
  ],
  "message": "Permintaan daftar transaksi berhasil",
  "success": true
}
```

</x-col>
</x-row>
