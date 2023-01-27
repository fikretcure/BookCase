<?php

namespace App\Http\Controllers;

use App\Repositories\AuthorRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class AuthorController extends Controller
{
    /**
     * @var AuthorRepository
     */
    private AuthorRepository $authorRepository;

    /**
     * @param AuthorRepository $authorRepository
     */
    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    /**
     * @return array|LengthAwarePaginator|Collection
     */
    public function get(): array|LengthAwarePaginator|Collection
    {
        return $this->authorRepository->get(request()->query());
    }
}
