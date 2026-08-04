<?php

namespace App\Services\Asaas;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;

class PaymentCreditCardService
{
    public function create($order, $requestValidated)
    {
        try {
            $client = new Client();


            $base_url = config('asaas.url');
            $token = config('asaas.token');

            $host = $base_url.'/v3/lean/payments';

            $headers = [
                'accept' => 'application/json',
                'access_token' => $token,
                'content-type' => 'application/json',
            ];

            $body = [
                "billingType" => "CREDIT_CARD",
                "dueDate" => now()->addDays(3)->toDateString(),
                "value" => $order['service']['price'],
                "description" => $order['service']['name'],
                "externalReference" => $order['reference'],
                "creditCard" => [
                    "holderName" => $requestValidated['holder_name'],
                    "number" => $requestValidated['holder_number'],
                    "expiryMonth" => $requestValidated['expiry_month'],
                    "expiryYear" => $requestValidated['expiry_year'],
                    "ccv" => $requestValidated['ccv']
                ],
                "creditCardHolderInfo" => [
                    "name" => $requestValidated['name'],
                    "email" => $requestValidated['email'],
                    "cpfCnpj" => $requestValidated['taxpayer_registration'],
                    "postalCode" => $requestValidated['zip_code'],
                    "addressNumber" => $requestValidated['number'],
                    "addressComplement" => $requestValidated['complement'] ?? null,
                    "phone" => $requestValidated['phone'],
                    "mobilePhone" => $requestValidated['whatsapp'] ?? null,
                ],
                'remoteIp' => request()->ip(),
                'customer' => $order['user']['asaas_id']
            ];

            $request = new Request('POST', $host, $headers, json_encode($body));
            $response = $client->send($request);

            return json_decode($response->getBody()->getContents(), true);

        } catch (ClientException $e) {
            $response = $e->getResponse();
            return json_decode((string)($response->getBody()->getContents()), true);
        }
    }

}
