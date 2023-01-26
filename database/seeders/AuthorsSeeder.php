<?php

namespace Database\Seeders;

use App\Repositories\AuthorRepository;
use Illuminate\Database\Seeder;

class AuthorsSeeder extends Seeder
{
    /**
     * @var AuthorRepository
     */
    private $authorRepository;

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
    public function run()
    {
        $this->authorRepository->create([
            'name' => 'fikret',
            'surname' => 'cure',
            'reg_code' => '123',
        ]);

        $this->authorRepository->create([
            'name' => 'semiha',
            'surname' => 'cure',
            'reg_code' => '124',
        ]);
    }
}
