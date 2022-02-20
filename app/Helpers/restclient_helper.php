<?php

use Config\Services;

function akses_restapi($method, $url, $data = null)
{
    $client = Services::curlrequest();
    $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImZhdXppZGFybWFAZ21haWwuY29tIiwiaWF0IjoxNjQ1MTgzNzM5LCJleHAiOjE2NDUxODczMzl9.01rU0S3dmdAmDbaP4GAgTL9yXNUqPM89yNRg-29n2VE";
    $headers = [
        'Authorization' => 'Bearer ' . $token
    ];

    $response = $client->request(
        $method,
        $url,
        ['headers' => $headers, 'http_errors' => false, 'form_params' => $data]
    );

    return $response->getBody();
}
