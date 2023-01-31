<?php

namespace Database\Seeders;

use App\Repositories\AuthorRepository;
use Illuminate\Database\Seeder;

class AuthorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        (new AuthorRepository())->create([
            'name' => 'Fikret',
            'surname' => 'Cüre',
        ]);


        (new AuthorRepository())->create([
            'name' => 'Semiha',
            'surname' => 'Cüre',
        ]);
    }
}
