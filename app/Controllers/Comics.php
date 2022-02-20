<?php

namespace App\Controllers;

use App\Models\ComicModel;

class Comics extends BaseController
{
    protected $comicModel;
    public function __construct()
    {
        $this->comicModel = new ComicModel();
    }

    public function index()
    {
        $comic = $this->comicModel->getComic();
        $data = [
            'title' => 'Comics',
            'comic_active' => 'active',
            'comics' => $comic
        ];

        //cara konek db tanpa model
        // $db = \Config\Database::connect();
        // $komik = $db->query("select * from comics");
        // foreach ($komik->getResultArray() as $key => $row) {
        //     d($row);
        // }



        return view('comics/index', $data);
    }

    public function details($slug)
    {
        $comic = $this->comicModel->getComic($slug);
        if (empty($comic)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Comic title ' . $slug . ' not found');
        }
        $data = [
            'title' => 'Comics',
            'comic_active' => 'active',
            'comic' => $comic
        ];
        return view('comics/details', $data);
    }

    public function create()
    {
        //session();
        $data = [
            'title' => 'Form New Comic',
            'comic_active' => 'active',
            'validation' => \Config\Services::validation()
        ];
        return view('comics/create', $data);
    }

    public function save()
    {
        //validasi input
        if (!$this->validate([
            'title' => [
                'rules' => 'required|is_unique[comics.title]',
                'errors' => [
                    'required' => '{field} cannot be blank',
                    'is_unique' => '{field} must unique'
                ]
            ],
            'writer' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} cannot be blank'
                ]
            ],
            'publisher' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} cannot be blank'
                ]
            ],
            'cover' => [
                'rules' => 'max_size[cover,2048]|is_image[cover]|mime_in[cover,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'max size 2mb',
                    'is_image' => 'must be image (jpg, jpeg, png)',
                    'mime_in' => 'must be image (jpg, jpeg, png)'
                ]
            ],
        ])) {
            //$validation = \Config\Services::validation();
            //return redirect()->to(base_url('comics/create'))->withInput()->with('validation', $validation);
            return redirect()->to(base_url('comics/create'))->withInput();
        }

        $fileCover = $this->request->getFile('cover');
        if ($fileCover->getError() == 4) {
            $nameCover = 'default.png';
        } else {
            $nameCover = $fileCover->getRandomName();
            $fileCover->move('img', $nameCover);
        }

        $slug = url_title($this->request->getPost('title'), '-', true);
        $this->comicModel->save([
            'title' => $this->request->getPost('title'),
            'slug' => $slug,
            'writer' => $this->request->getPost('writer'),
            'publisher' => $this->request->getPost('publisher'),
            'cover' => $nameCover,
        ]);

        session()->setFlashdata('message', 'Add new comic success');

        return redirect()->to(base_url('comics'));
    }

    public function delete($id)
    {
        $comic = $this->comicModel->find($id);
        if ($comic['cover'] != 'default.png') {
            unlink('img/' . $comic['cover']);
        }

        $this->comicModel->delete($id);

        session()->setFlashdata('message', 'Delete comic success');
        return redirect()->to(base_url('comics'));
    }

    public function edit($slug)
    {
        //session();
        $comic = $this->comicModel->getComic($slug);
        $data = [
            'title' => 'Form Edit Comic',
            'comic_active' => 'active',
            'validation' => \Config\Services::validation(),
            'comic' => $comic
        ];
        return view('comics/edit', $data);
    }

    public function update($id)
    {
        //check title
        $oldComics = $this->comicModel->getComic($this->request->getPost('slug'));
        if ($oldComics['title'] == $this->request->getPost('title')) {
            $titleRules = 'required';
        } else {
            $titleRules = 'required|is_unique[comics.title]';
        }

        if (!$this->validate([
            'title' => [
                'rules' => $titleRules,
                'errors' => [
                    'required' => '{field} cannot be blank',
                    'is_unique' => '{field} must unique'
                ]
            ],
            'writer' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} cannot be blank'
                ]
            ],
            'publisher' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} cannot be blank'
                ]
            ],
            'cover' => [
                'rules' => 'max_size[cover,2048]|is_image[cover]|mime_in[cover,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'max size 2mb',
                    'is_image' => 'must be image (jpg, jpeg, png)',
                    'mime_in' => 'must be image (jpg, jpeg, png)'
                ]
            ]
        ])) {
            //$validation = \Config\Services::validation();
            return redirect()->to(base_url('comics/edit/' . $this->request->getPost('slug')))->withInput();
        }

        $fileCover = $this->request->getFile('cover');
        $oldCover = $this->request->getPost('oldCover');
        if ($fileCover->getError() == 4) {
            $nameCover = $this->request->getPost('oldCover');
        } else {
            $nameCover = $fileCover->getRandomName();
            $fileCover->move('img', $nameCover);

            if ($oldCover != 'default.png') {
                unlink('img/' . $oldCover);
            }
        }

        $slug = url_title($this->request->getPost('title'), '-', true);
        $this->comicModel->save([
            'id' => $id,
            'title' => $this->request->getPost('title'),
            'slug' => $slug,
            'writer' => $this->request->getPost('writer'),
            'publisher' => $this->request->getPost('publisher'),
            'cover' => $nameCover,
        ]);

        session()->setFlashdata('message', 'Edit comic success');

        return redirect()->to(base_url('comics'));
    }
}
