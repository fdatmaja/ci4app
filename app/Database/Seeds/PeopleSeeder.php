<?php

namespace App\Database\Seeds;

use App\Models\PeopleModel;
use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
use CodeIgniter\Test\Fabricator;

class PeopleSeeder extends Seeder
{
    public function run()
    {
        $fabricator = new Fabricator(PeopleModel::class);
        $fabricator->setOverrides(['created_at' => Time::now(), 'updated_at' => Time::now()]);
        $data = $fabricator->make(70);

        // $data = [
        //     [
        //         'name' => static::faker()->name,
        //         'address' => 'jl. tebet',
        //         'created_at' => Time::now(),
        //         'updated_at' => Time::now()
        //     ],
        //     [
        //         'name' => 'fauzi2',
        //         'address' => 'jl. tebet',
        //         'created_at' => Time::now(),
        //         'updated_at' => Time::now()
        //     ],
        //     [
        //         'name' => 'fauzi3',
        //         'address' => 'jl. tebet',
        //         'created_at' => Time::now(),
        //         'updated_at' => Time::now()
        //     ],
        //     $fabricator->make()
        // ];

        // Simple Queries
        //$this->db->query("INSERT INTO people (name, address, created_at, updated_at) VALUES(:name:, :address:, :created_at:, :updated_at:)", $data);

        // Using Query Builder
        $this->db->table('people')->insertBatch($data);
    }
}
