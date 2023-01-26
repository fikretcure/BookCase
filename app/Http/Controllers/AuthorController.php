<?php

namespace App\Http\Controllers;

use App\Repositories\AuthorRepository;

/**
 *
 */
class AuthorController extends Controller
{
    /**
     * @var AuthorRepository
     */
    private $authorRepository;

    /**
     * @param AuthorRepository $authorRepository
     */
    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function get()
    {
        return response()->json($this->authorRepository->get());
    }
}
