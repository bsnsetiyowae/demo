---
title: Persyaratan
description: Sebelum mengintegrasikan Payment Gateway {brand} ke dalam sistem Anda, pastikan bahwa Anda telah memenuhi persyaratan yang disediakan baik oleh penyedia maupun operator.
---

## Persyaratan yang Disediakan oleh Penyedia

1. Informasi Server & URL API.
2. Kredensial API: `api_key`, `secret_key`, `merchant_code`.
3. Kredensial BO: username, password.

## Persyaratan yang Disediakan oleh Operator

1. URL Panggilan API (wajib). Digunakan untuk meneruskan status transaksi.
2. Halaman `success url page` panggilan balik (opsional).
3. Halaman `failed url page` panggilan balik (opsional).

## Keamanan

1. Token dan kunci transaksi (Perlu membuat token dan kunci untuk setiap transaksi). Lebih lanjut tentang [fungsi enkripsi dekripsi](/api/authentication) pembuatan token.
2. Daftar Putih IP untuk login Back Office.
