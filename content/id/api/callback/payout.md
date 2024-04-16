---
title: Callback Pembayaran (Operator)
toc: false
---

<x-row>
<x-col class="md:max-w-lg">

Setelah operator mengirim permintaan pembayaran, penyedia akan memprosesnya. Setelah penyedia mendapatkan status transaksi (berhasil atau gagal), penyedia akan memanggil API ini untuk meneruskan status transaksi.

Penyedia akan mengirimkan parameter dalam format kunci, kemudian operator perlu mendekripsinya menggunakan [encrypt/decrypt](/api/authentication), Anda perlu mendekripsi dengan `api_key` dan `api_secret`.

Selain kunci, kami juga mengirimkan kode transaksi dalam parameter `transaction_code` dan nomor transaksi dalam parameter `transaction_no` yang tidak terenkripsi.

</x-col>
<x-col sticky>

```bash title="cURL"
curl --request POST \
--url https://s88pay.net/api/v1/transaction/resend-callback/SKU20210909025705 \
--header 'Content-Type: application/json' \
--data '{
    "key": "<string>",
    "transaction_code": "<string>",
    "transaction_no": "<string>"
}'
```

</x-col>
</x-row>

---

<x-row>
<x-col class="md:max-w-lg">

## Objek Respons

<x-properties>
  <x-property name="transaction_no" type="string">
    Kode transaksi yang dicatat oleh penyedia.
  </x-property>
  <x-property name="transaction_code" type="string">
    Kode transaksi yang dikirim oleh operator pada permintaan pembayaran.
  </x-property>
  <x-property name="transaction_status" type="integer">
    Status transaksi pembayaran.
  </x-property>
  <x-property name="transaction_amount" type="double">
    Jumlah transaksi.
  </x-property>
  <x-property name="transaction_fee" type="double">
    Biaya transaksi.
  </x-property>
  <x-property name="currency_code" type="string">
    Kode mata uang, lihat daftar mata uang.
  </x-property>
  <x-property name="transaction_ref" type="double">
    Referensi transaksi permintaan pembayaran.
  </x-property>
</x-properties>
</x-col>
<x-col sticky>

Setelah **mendekripsi** parameter, Anda akan menemukan bahwa objek respons adalah:

```json
{
    "transaction_no": "WD-987XXXXX",
    "transaction_code": "WD8765XXXX",
    "transaction_status": "completed",
    "transaction_amount": "3000.00",
    "transaction_fee": "10.00",
    "currency_code": "BDT",
    "transaction_ref": ""
}
```
</x-col>
</x-row>
