<?php

namespace App\Http\Controllers;

use App\Repositories\AuthorRepository;

class AuthorController extends Controller
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
     * @return mixed
     */
    public function get(): mixed
    {
        return $this->authorRepository->get(request()->all());
    }
}
