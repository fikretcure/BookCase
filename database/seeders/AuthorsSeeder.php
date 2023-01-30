<?php

namespace Database\Seeders;

use App\Repositories\AuthorRepository;
use Illuminate\Database\Seeder;

class AuthorsSeeder extends Seeder
{
    /**
     * @var AuthorRepository
     */
    private AuthorRepository $authorRepository;

    /**
     * @param  AuthorRepository  $authorRepository
     */
    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->authorRepository->create([
            'name' => 'Fikret',
            'surname' => 'Cüre',
        ]);

        $this->authorRepository->create([
            'name' => 'Semiha',
            'surname' => 'Cüre',
        ]);
    }
}
