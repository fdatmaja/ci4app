<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        //helper('cookie');
        //set_cookie('fz_access_token', 'okeh', '', '', base_url());
        //delete_cookie('fz_access_token', '', base_url());
        $data = [
            'title' => 'Home | Fauzi',
            'home_active' => 'active',
            'tes' => ['satu', 'dua', 'tiga']
        ];
        return view('pages/home', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About Me',
            'about_active' => 'active'
        ];
        return view('pages/about', $data);
    }

    public function contact()
    {
        $data = [
            'title' => 'Contact',
            'contact_active' => 'active',
        ];
        return view('pages/contact', $data);
    }
}
