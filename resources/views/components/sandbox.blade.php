@props([
    'method' => 'GET',
    'contentType' => 'application/json',
    'url' => '/api/v1/balance/{merchant_code}',
    'payload' => '{
        "key": "{key}"
    }',
])

<livewire:sandbox 
    :method="$method" 
    :contentType="$contentType" 
    :url="$url"
    :payload="$payload"
/>
