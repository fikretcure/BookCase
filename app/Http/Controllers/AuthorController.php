<?php

namespace App\Http\Controllers;

use App\Repositories\AuthorRepository;
use Illuminate\Http\JsonResponse;

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
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(): JsonResponse
    {
        return response()->json($this->authorRepository->get());
    }
}
