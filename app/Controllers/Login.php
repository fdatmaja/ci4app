<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class Login extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $data = [
            'title' => 'Login'
        ];

        $login = $this->request->getPost('login');
        if ($login) {
            $member_username = $this->request->getPost('member_username');
            $member_password = $this->request->getPost('member_password');

            if ($member_username == '' || $member_password == '') {
                $msg = "Masukkan email dan password";
            } else {
                helper(['restclient', 'cookie']);
                $url = "http://localhost/ci4restapi/public/otentikasi";
                $data = [
                    'email' => $member_username,
                    'password' => $member_password
                ];

                $response = akses_restapi('POST', $url, $data);
                $dataArray = json_decode($response, true);
                if ($dataArray['status'] == 200) {
                    $access_token = $dataArray['access_token'];
                    set_cookie('fz_access_token', $access_token);
                    return redirect()->to(base_url('/'))->withCookies();
                } else {
                    $msg = $dataArray['messages']['error'];
                }
            }

            if ($msg) {
                session()->setFlashdata('message', $msg);
                return redirect()->to(base_url('login'))->withInput();
            }
        }

        return view('login/index', $data);
    }

    public function ajax()
    {
        if ($this->request->isAJAX()) {
            $member_username = $this->request->getPost('email');
            $member_password = $this->request->getPost('password');

            if ($member_username == '' || $member_password == '') {
                $msg = "Masukkan email dan password";
            } else {
                helper(['restclient', 'cookie']);
                $url = "http://localhost/ci4restapi/public/otentikasi";
                $data = [
                    'email' => $member_username,
                    'password' => $member_password
                ];

                $response = akses_restapi('POST', $url, $data);
                $dataArray = json_decode($response, true);
                if ($dataArray['status'] == 200) {
                    $access_token = $dataArray['access_token'];
                    set_cookie('fz_access_token', $access_token);
                    $response = [
                        'status' => 200,
                        'message' => 'Otentikasi berhasil',
                        'data' => [
                            'email' => $member_username
                        ],
                        'access_token' => $access_token
                    ];
                } else {
                    $msg = $dataArray['messages']['error'];
                }
            }

            if (!empty($msg)) {
                $response = [
                    'status' => 200,
                    'message' => $msg,
                    'data' => [
                        'email' => $member_username
                    ],
                    'access_token' => null
                ];
            }

            return $this->respond($response);
        }
    }

    public function logout()
    {
        helper('cookie');
        session()->destroy();
        delete_cookie('fz_access_token');
        return redirect()->to(base_url('login'))->withCookies();
    }
}
