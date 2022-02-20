<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class FilterMember implements FilterInterface
{

    public function before(RequestInterface $request, $arguments = null)
    {
        helper(['cookie', 'restclient']);
        $access_token = get_cookie('fz_access_token');
        if (is_null($access_token)) {
            return redirect()->to(base_url('login'));
        } else {
            if (!session()->has('email')) {
                $url = "http://localhost/ci4restapi/public/otentikasi/decrypt";
                $data = [
                    'access_token' => $access_token
                ];

                $response = akses_restapi('POST', $url, $data);
                $data = json_decode($response, true);
                session()->set($data['data']);
                //d(session()->get());
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
