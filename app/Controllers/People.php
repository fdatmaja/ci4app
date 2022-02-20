<?php

namespace App\Controllers;

use App\Models\PeopleModel;
use Config\Services;

class People extends BaseController
{
    protected $peopleModel;
    public function __construct()
    {
        $this->peopleModel = new PeopleModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page_people') ? $this->request->getVar('page_people') : 1;

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $people = $this->peopleModel->search($keyword);
        } else {
            $people = $this->peopleModel;
        }

        $data = [
            'title' => 'People List',
            'people_active' => 'active',
            'people' => $people->paginate(10, 'people'),
            'pager' => $this->peopleModel->pager,
            'currentPage' => $currentPage
        ];

        return view('people/index', $data);
    }

    public function api()
    {
        $client = Services::curlrequest();

        $response = $client->request('GET', 'https://api.rajaongkir.com/starter/province', [
            'headers' => [
                'key' => 'a20d8602d25e7f5386647f9e9c660f44'
            ],
        ]);
        $data = json_decode($response->getBody(), true);
        d($data);
        foreach ($data['rajaongkir']['results'] as $value) {
            d($value['province']);
        }
    }
}
