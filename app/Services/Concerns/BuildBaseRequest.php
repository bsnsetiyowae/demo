<?php

namespace App\Services\Concerns;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

trait BuildBaseRequest
{
    public function buildRequestWithToken(): PendingRequest
    {
        return $this->withBaseUrl()->timeout(15)->withToken($this->apiToken);
    }

    public function buildRequestWithDigestAuth(): PendingRequest
    {
        return $this->withBaseUrl()->timeout(15)->withDigestAuth($this->username, $this->password);
    }

    public function withBaseUrl(): PendingRequest
    {
        return Http::baseUrl($this->baseUrl);
    }
}