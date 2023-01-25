<?php

namespace Database\Seeders;

use App\Repositories\AuthorRepository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        (new AuthorRepository())->create([
            "name" => "fikret",
            "surname" => "cure",
            "reg_code" => "123"
        ]);

        (new AuthorRepository())->create([
            "name" => "semiha",
            "surname" => "cure",
            "reg_code" => "124"
        ]);
    }
}
