<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorCreateRequest;
use App\Repositories\AuthorRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

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

    /**
     * @param AuthorCreateRequest $request
     * @return Model|Builder
     */
    public function create(AuthorCreateRequest $request): Model|Builder
    {
        return $this->authorRepository->create($request->validated());
    }
}
