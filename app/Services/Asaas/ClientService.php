<?php

namespace App\Services\Asaas;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;

class ClientService
{
    public function create($user)
    {
        if(isset($user['taxpayer_registration'])) {
            $user['taxpayer_registration'] = str_replace(array('.','-','/'), "", $user['taxpayer_registration']);
        }
        if(isset($user['phone'])) {
            $user['phone'] = str_replace(array('(',')','-', ' '), "", $user['phone']);
        }

        $base_url = config('asaas.url');
        $token = config('asaas.token');

        try {
            $client = new Client();

            $host = $base_url.'/v3/customers';

            $headers = [
                'accept' => 'application/json',
                'access_token' => $token,
                'content-type' => 'application/json',
            ];

            $body = [
                "name" => $user['name'],
                "email" => $user['email'],
                "mobilePhone" => $user['phone'] ?? '',
                "cpfCnpj" => $user['taxpayer_registration'],
                "notificationDisabled" => true
            ];

            $request = new Request('POST', $host, $headers, json_encode($body)); // create request
            $response = $client->send($request);

            return json_decode($response->getBody()->getContents(), true); // return response object

        } catch (ClientException $e) {
            $response = $e->getResponse();
            return json_decode((string)($response->getBody()->getContents()),true);
        }
    }

    public function update($id, $user)
    {
        if(isset($user['taxpayer_registration'])) {
            $user['taxpayer_registration'] = str_replace(array('.','-','/'), "", $user['taxpayer_registration']);
        }
        if(isset($user['phone'])) {
            $user['phone'] = str_replace(array('(',')','-', ' '), "", $user['phone']);
        }

        $base_url = config('asaas.url');
        $token = config('asaas.token');

        try {
            $client = new Client();

            $host = $base_url.'/v3/customers/'.$id;

            $headers = [
                'accept' => 'application/json',
                'access_token' => $token,
                'content-type' => 'application/json',
            ];

            $body = [
                "name" => $user['name'],
                "email" => $user['email'],
                "mobilePhone" => $user['phone'] ?? '',
                "cpfCnpj" => $user['taxpayer_registration'],
                "notificationDisabled" => true
            ];

            $request = new Request('PUT', $host, $headers, json_encode($body)); // create request
            $response = $client->send($request);

            return json_decode($response->getBody()->getContents(), true); // return response object

        } catch (ClientException $e) {
            $response = $e->getResponse();
            return json_decode((string)($response->getBody()->getContents()),true);
        }
    }
}
