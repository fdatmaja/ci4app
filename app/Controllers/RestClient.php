<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Config\Services;

class RestClient extends BaseController
{
    public function index()
    {
        $client = Services::curlrequest();
        $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImZhdXppZGFybWFAZ21haWwuY29tIiwiaWF0IjoxNjQ1MTgzNzM5LCJleHAiOjE2NDUxODczMzl9.01rU0S3dmdAmDbaP4GAgTL9yXNUqPM89yNRg-29n2VE";
        $headers = [
            'Authorization' => 'Bearer ' . $token
        ];

        //read
        // $url = "http://localhost/ci4restapi/public/pegawai";
        // $response = $client->request(
        //     'GET',
        //     $url,
        //     ['headers' => $headers, 'http_errors' => false]
        // );

        //create
        // $url = "http://localhost/ci4restapi/public/pegawai";
        // $data = [
        //     'nama' => 'Darma',
        //     'email' => 'darma@gmail.com'
        // ];
        // $response = $client->request(
        //     'POST',
        //     $url,
        //     [
        //         'headers' => $headers,
        //         'http_errors' => false,
        //         'form_params' => $data
        //     ]
        // );

        //update
        // $url = "http://localhost/ci4restapi/public/pegawai/12";
        // $data = [
        //     'nama' => 'Darma2',
        //     'email' => 'darma2@gmail.com'
        // ];
        // $response = $client->request(
        //     'PUT',
        //     $url,
        //     [
        //         'headers' => $headers,
        //         'http_errors' => false,
        //         'form_params' => $data
        //     ]
        // );

        //delete
        // $url = "http://localhost/ci4restapi/public/pegawai/12";
        // $response = $client->request(
        //     'DELETE',
        //     $url,
        //     [
        //         'headers' => $headers,
        //         'http_errors' => false
        //     ]
        // );

        helper('restclient');
        $url = "http://localhost/ci4restapi/public/pegawai";
        $data = [];
        $response = akses_restapi('GET', $url, $data);
        $dataArray = json_decode($response, true);
        d($dataArray['data']);
    }
}
