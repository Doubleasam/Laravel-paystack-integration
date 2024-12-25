<?php

namespace App\Http\Repositories;

use Illuminate\Support\Facades\Http;

class PaystackRepository
{
    protected $paystackBaseUrl;
    protected $paystackSecretKey;


    public function __construct()
    {
        $this->paystackBaseUrl = config ('paystack.base_url');
        $this->paystackSecretKey = config ('paystack.secret_key');
    }

    public function initializePayment(array $data)
    {
        $response = Http::withtoken($this->paystackSecretkey)
        ->post("{$this->paystackBaseUrl}/transaction/initialize", [
            'email'=>$data['email'],
            'amount'=>$data['amount'] *100,
        ]);
        return $response ->json();
    }

    public function verifyPayment(string $reference)
    {
        $response = Http::withToken($this->paystackSecretkey)
        ->post("{this->paystackBaseUrl}/transaction/verify/{$reference}");
            
        return $response->json();
    }


}