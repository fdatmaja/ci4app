<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class FilterLogin implements FilterInterface
{

    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->has('email')) {
            return redirect()->to(base_url('/'));
        }
    }


    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
