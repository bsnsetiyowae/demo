<?php

namespace App\Services;

use App\Services\Concerns\BuildBaseRequest;
use App\Services\Concerns\CanSendGetRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\App;

class PaymentApi
{

    use BuildBaseRequest;
    use CanSendGetRequest;

    private $baseUrl;

    public function __construct($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    public function getAvailableSubbanks(): array
    {
        if (App::environment('production')) {
            return Cache::remember('get-available-subbanks', now()->addMinutes(60), function () {
                return $this->get($this->withBaseUrl(), "/api/sub-bank/available")->json() ?? [];
            });
        }
    
        return $this->get($this->withBaseUrl(), "/api/sub-bank/available")->json() ?? [];
    }


}