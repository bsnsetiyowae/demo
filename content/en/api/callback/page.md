---
title: Callback Page
---

It's possible to set up a successful callback page via Back Office. When the transaction receives a success status, the page will be redirected to the success URL page. Similarly, when the transaction receives a failed status, the page will be redirected to the failed URL page.

Sample callback success URL format set on the Back Office:

```bash title="Example callback URL"
https://www.example.com/success
```

If the transaction succeeds, the user will be redirected to: `https://www.example.com/success`.