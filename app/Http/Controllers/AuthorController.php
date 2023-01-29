<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorCreateRequest;
use App\Http\Requests\AuthorUpdateRequest;
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
     * @var DocumentService
     */
    private DocumentService $documentService;

    /**
     * @param AuthorRepository $authorRepository
     * @param AuthorService $authorService
     * @param DocumentService $documentService
     */
    public function __construct(AuthorRepository $authorRepository, AuthorService $authorService, DocumentService $documentService)
    {
        $this->authorRepository = $authorRepository;
        $this->authorService = $authorService;
        $this->documentService = $documentService;
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
        if ($request->filled("avatar")) {
            $this->documentService->hasDocument($request->validated("avatar"));
            $this->documentService->fileMove("docs/" . $request->validated("avatar"), "avatar/" . $request->validated("avatar"));
        }

        return $this->authorRepository->create($request->validated());
    }

    /**
     * @param int $id
     * @return Model|Collection|Builder|array
     */
    public function show(int $id): Model|Collection|Builder|array
    {
        return $this->authorRepository->show($id);
    }

    /**
     * @param AuthorUpdateRequest $request
     * @param int $id
     * @return Model|Collection|Builder|array|null
     */
    public function updated(AuthorUpdateRequest $request, int $id): Model|Collection|Builder|array|null
    {
        return $this->authorRepository->update($request->validated(), $id);
    }
}
