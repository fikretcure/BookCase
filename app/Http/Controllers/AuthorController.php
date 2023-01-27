<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorCreateRequest;
use App\Repositories\AuthorRepository;
use App\Services\AuthorService;
use App\Services\DocumentService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Throwable;

/**
 *
 */
class AuthorController extends Controller
{

    /**
     * @var AuthorRepository
     */
    private AuthorRepository $authorRepository;
    /**
     * @var AuthorService
     */
    private AuthorService $authorService;

    /**
     * @param AuthorRepository $authorRepository
     * @param AuthorService $authorService
     */
    public function __construct(AuthorRepository $authorRepository, AuthorService $authorService)
    {
        $this->authorRepository = $authorRepository;
        $this->authorService = $authorService;
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
     * @throws Throwable
     */
    public function create(AuthorCreateRequest $request): Model|Builder
    {
        (new DocumentService())->hasDocument($request->validated("avatar"));
        $author = $this->authorRepository->create($request->validated());
        $this->authorService->generateAvatarFromId($author->id, 123);
        return $author;
    }
}
