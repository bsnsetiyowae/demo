<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Sandbox extends Component
{
    public $method = 'GET';
    public $baseUrl = '';
    public $contentType = 'application/json';
    public $url = '';
    public $response = '';
    public $payload = '';
    public $status = '';
    public $merchantCode = '';
    public $key = '';
    
    public function mount()
    {
        $this->baseUrl = config('site.api_url');
    }

    public function sendRequest()
    {
        $url = $this->replacePlaceholders($this->url, [
            'merchant_code' => $this->merchantCode,
            'key' =>  $this->key,
        ]);

        $payload = $this->replacePlaceholders($this->payload, [
            'key' => urlencode( $this->key),
        ]);

        parse_str(parse_url($url, PHP_URL_QUERY), $query);

        try {
            $payload = $this->parsePayload($payload);
            $fullUrl = $this->baseUrl . $url;

            
            if (isset($query['key'])) {
                $this->status = "using this url";
                $this->response = $fullUrl;
                return;
            }

            // dd([
            //     'method' => $this->method,
            //     'contentType' => $this->contentType,
            //     'url' => $fullUrl,
            //     'payload' => $payload,
            // ]);

            switch ($this->method) {
                case 'GET':
                    $response = Http::withHeaders([
                        'Content-Type' => $this->contentType,
                    ])->get($fullUrl, $payload);
                    break;

                case 'POST':
                    $request = Http::withHeaders([
                        'Content-Type' => $this->contentType,
                    ]);
                
                    if ($this->contentType === 'application/json') {
                        $request = $request->asJson();
                    } else {
                        $request = $request->asForm();
                    }
                
                    $response = $request->post($fullUrl, $payload);
                    break;

                case 'PUT':
                    $response = Http::withHeaders([
                        'Content-Type' => $this->contentType,
                    ])->asForm()->put($fullUrl, $payload);
                    break;

                case 'DELETE':
                    $response = Http::withHeaders([
                        'Content-Type' => $this->contentType,
                    ])->delete($fullUrl);
                    break;

                default:
                    throw new \Exception('Invalid Method');
            }

            $this->status = $response->status();
            $this->response = json_encode($response->json(), JSON_PRETTY_PRINT);
        } catch (\Exception $e) {
            $this->status = 500;
            $this->response = "Error: " . $e->getMessage();
        }
    }

    private function parsePayload($payload)
    {
        if ($this->contentType === 'application/json') {
            return json_decode($payload, true) ?? [];
        }

        if ($this->contentType === 'application/x-www-form-urlencoded') {
            parse_str($payload, $formData);
            return $formData;
        }

        return [];
    }

    private function replacePlaceholders($url, $placeholders)
    {
        foreach ($placeholders as $key => $value) {
            $url = str_replace("{" . $key . "}", $value, $url);
        }
        return $url;
    }
}
