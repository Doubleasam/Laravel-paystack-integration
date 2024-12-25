<?php

namespace App\Http\Controllers;

use App\Services\PaystackService;
use Illuminate\Http\Request;
/**
 * @OA\Info(title="Paystack API", version="1.0")
 * @OA\Server(url="http://localhost/api")
 */
class PaystackController extends Controller
{
    protected $paystackService;

    public function __construct (PaystackService $paystackService)
    {
        $this->paystackService = $paystackService;
    }

     /**
     * @OA\Post(
     *     path="/paystack/initialize",
     *     tags={"Paystack"},
     *     summary="Initialize a Paystack payment",
     *     description="Initiates a payment request on Paystack",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"amount", "email"},
     *             @OA\Property(property="amount", type="number", example=5000),
     *             @OA\Property(property="email", type="string", example="user@example.com")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Payment initialized successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Authorization URL created successfully")
     *         )
     *     ),
     *     @OA\Response(response=400, description="Bad request")
     * )
     */

    public function initializePayment (Request $request)
    {
        $data = $request->validate([
            'amount' => 'required|numeric',
            'email' => 'required|email',
        ]);

        $response = $this->paystackService->initializepayment($data);
        return response()->json($response);
    }


     /**
     * @OA\Post(
     *     path="/paystack/verify",
     *     tags={"Paystack"},
     *     summary="Verify a Paystack payment",
     *     description="Verifies a payment request on Paystack",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"reference"},
     *             @OA\Property(property="reference", type="string", example="abc123xyz")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Payment verified successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Payment verification successful")
     *         )
     *     ),
     *     @OA\Response(response=400, description="Bad request")
     * )
     */

    public function verifyPayment (Request $request)
    {
        $data = $request->validate([
            'reference' => 'required|string',
        ]);

        $response = $this->paystackService->verifyPayment($data['reference']);
        return response()->json($response);
    }
}