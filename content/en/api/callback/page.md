---
title: Callback Page
---

It's possible to set up a successful callback page via Back Office. When the transaction gets a success status. the page
will be redirected to the success URL page. When the translation gets failed status, the page will be redirected to the
failed URL page.

Sample callback success url format set on the Back Office like so:

```bash title="Example callback URL"
https://www.example.com/success
```

if the transaction succeeds, will be redirected to: `https://www.example.com/success`.
