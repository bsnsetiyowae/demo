---
title: Callback Deposit (Operator)
toc: false
---

<x-row>
<x-col class="md:max-w-lg">

Setelah operator mengirim permintaan pembayaran ke dopayment / deposit, penyedia akan memprosesnya. Begitu penyedia menerima status transaksi (berhasil atau gagal), penyedia akan memanggil API ini untuk meneruskan status transaksi.

Untuk kunci, Anda perlu mendekripsi dengan `api_key` dan `api_secret`. Selain kunci, kami juga mengirim kode transaksi dalam parameter `transaction_code` dan nomor transaksi dalam parameter `transaction_no`, yang tidak terenkripsi.

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

## Respons

  <x-properties>
    <x-property name="transaction_code" type="string">
        Kode transaksi yang dikirim oleh operator di dopayment.
    </x-property>
    <x-property name="transaction_status" type="integer">
        Status transaksi deposit.
    </x-property>
    <x-property name="transaction_amount" type="double">
        Jumlah transaksi.
    </x-property>
    <x-property name="transaction_fee" type="double">
        Jumlah biaya transaksi.
    </x-property>
    <x-property name="currency_code" type="string">
        Kode Mata Uang, silakan lihat daftar mata uang.
    </x-property>
    <x-property name="transaction_no" type="string">
        Kode transaksi di basis data penyedia.
    </x-property>
    <x-property name="transaction_actual_amount" type="double">
        Jumlah sebenarnya yang dibayarkan oleh anggota.
    </x-property>
  </x-properties>
</x-col>
<x-col sticky>

Setelah **mendekripsi** parameter, Anda akan menemukan bahwa objek respons adalah:

```json title="Objek Respons"
 {
    "transaction_code": "DP-16873xxxxx",
    "transaction_status": "success",
    "transaction_amount": "510.00",
    "transaction_fee": "5.10",
    "currency_code": "BDT",
    "transaction_no": "DP16873387xxxxx",
    "transaction_actual_amount": "504.9"
}
```

</x-col>
</x-row>
