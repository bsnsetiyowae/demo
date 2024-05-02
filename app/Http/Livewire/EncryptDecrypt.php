<?php

namespace App\Http\Livewire;

use Livewire\Component;

class EncryptDecrypt extends Component
{

    public $v2 = "";
    public $v3 = "";

    protected $listeners = ['encrypt'];

    function encrypt_decrypt($api_key, $secret_key, $action, $version, $string)
    {
        if (!$api_key || !$secret_key || !$action || !$string || !$version) {
            return null;
        }

        $encrypt_method = "AES-256-CBC";

        $key = substr(hash("sha256", $api_key), 0, 32);
        $iv = substr(hash("sha256", $secret_key), 0, 16);

        if ($action === "encrypt") {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = ($version === 'v2' ? urlencode(base64_encode($output)) : base64_encode($output));
        } elseif ($action === "decrypt") {
            $string = ($version === 'v2' ? urldecode($string) : $string);
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }

        return $output;
    }

    function combine($data)
    {
        return implode('&', array_map(function ($item) {
            return $item['key'] . '=' . $item['value'];
        }, $data));
    }


    public function encrypt($data)
    {
        $request = (object)[
            "action" => "encrypt",
            "version" => "v3",
            "merchant_id" => "1",
            "apikey" => "3213212ewfewqfwqf",
            "secretkey" => "jdo383f1d2021ehd1dj2di32",
            "string" => "dsds",
        ];

        $string = $this->combine(json_decode($data, true));

        dd($string);

        $this->v3 = $this->encrypt_decrypt($request->apikey, $request->secretkey, $request->action, 'v3', $string);
        $this->v2 = $this->encrypt_decrypt($request->apikey, $request->secretkey, $request->action, 'v2', $string);
    }
    public function render()
    {
        return view('livewire.encrypt-decrypt');
    }
}
