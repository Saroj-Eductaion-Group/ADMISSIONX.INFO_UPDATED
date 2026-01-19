<?php

namespace App\Http\Controllers\easebuzz;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class EasebuzzController extends Controller
{
    private $merchantKey;
    private $salt;
    private $env;
    private $baseUrl;

    public function __construct()
    {
        $this->merchantKey = env('EASEBUZZ_MERCHANT_KEY');
        $this->salt = env('EASEBUZZ_SALT');
        $this->env = env('EASEBUZZ_ENV', 'prod');
        $this->baseUrl = env('EASEBUZZ_BASE_URL');
    }

    public function generateHash($params)
    {
        $hashString = $this->merchantKey . '|' . 
                     $params['txnid'] . '|' . 
                     $params['amount'] . '|' . 
                     $params['productinfo'] . '|' . 
                     $params['firstname'] . '|' . 
                     $params['email'] . '|' . 
                     '||||||||||' . 
                     $this->salt;
        
        return hash('sha512', $hashString);
    }

    public function verifyHash($params)
    {
        $hashString = $this->salt . '|' . 
                     $params['status'] . '|' . 
                     '||||||||||' . 
                     $params['email'] . '|' . 
                     $params['firstname'] . '|' . 
                     $params['productinfo'] . '|' . 
                     $params['amount'] . '|' . 
                     $params['txnid'] . '|' . 
                     $this->merchantKey;
        
        $calculatedHash = hash('sha512', $hashString);
        return $calculatedHash === $params['hash'];
    }

    public function getPaymentUrl()
    {
        return $this->baseUrl . 'payment/initiateLink';
    }

    public function initiatePayment($params)
    {
        $hash = $this->generateHash($params);
        $params['hash'] = $hash;
        $params['key'] = $this->merchantKey;
        
        // For test environment, you can redirect directly
        // For production, use cURL to initiate payment
        if ($this->env === 'test') {
            return [
                'status' => 'success',
                'payment_url' => $this->getPaymentUrl(),
                'params' => $params
            ];
        }
        
        // Production payment initiation via API
        return $this->callPaymentAPI($params);
    }

    private function callPaymentAPI($params)
    {
        try {
            $client = new Client();
            $response = $client->post($this->getPaymentUrl(), [
                'form_params' => $params,
                'timeout' => 30
            ]);
            
            return [
                'status' => 'success',
                'response' => $response->getBody()->getContents()
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }

    public function handleResponse(Request $request)
    {
        $responseData = $request->all();
        
        if ($this->verifyHash($responseData)) {
            if ($responseData['status'] === 'success') {
                return [
                    'status' => 'success',
                    'txnid' => $responseData['txnid'],
                    'amount' => $responseData['amount'],
                    'easepayid' => $responseData['easepayid'] ?? null
                ];
            } else {
                return [
                    'status' => 'failed',
                    'error' => $responseData['error_Message'] ?? 'Payment failed'
                ];
            }
        } else {
            return [
                'status' => 'error',
                'message' => 'Hash verification failed'
            ];
        }
    }
}