<?php

namespace App\Services\Asaas;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;

class PaymentPixService
{
    public function create($order)
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
                'billingType' => 'PIX',
                'customer' => $order['user']['asaas_id'],
                'value' => $order['service']['price'],
                'dueDate' => now()->addDays(3)->toDateString(),
                'description' => $order['service']['name']
            ];

            $request = new Request('POST', $host, $headers, json_encode($body));
            $response = $client->send($request);

            return json_decode($response->getBody()->getContents(), true);

        } catch (ClientException $e) {
            $response = $e->getResponse();
            return json_decode((string)($response->getBody()->getContents()), true);
        }
    }

    public function show($cobranca_id)
    {
        try {
            $client = new Client();

            $base_url = config('asaas.url');
            $token = config('asaas.token');


            $host = "https://api-sandbox.asaas.com/v3/payments/{$cobranca_id}/pixQrCode";

            $headers = [
                'accept' => 'application/json',
                'access_token' => $token,
                'content-type' => 'application/json',
            ];

            $request = new Request('GET', $host, $headers);
            $response = $client->send($request);

            return json_decode($response->getBody()->getContents(), true);

        } catch (ClientException $e) {
            $response = $e->getResponse();
            return json_decode((string)($response->getBody()->getContents()), true);
        }
    }
}
