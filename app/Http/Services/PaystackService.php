<?php

namespace App\Http\Services;

use App\Repositories\PaystackRepository;

Class PaystackService
{
    protected $paystackRepository;

    public function __construct(PaystackRepository $paystackRepository)
    {
        $this->paystackRepository = $paystackRepository;
    }

    public function initializePayment(array $data)
    {
        return $this->paystackRepository->initializepayment($data);
    }

    public function verifyPayment(string $reference)
    {
        return $this->paystackRepository->verifyPayment($reference);
    }
}
