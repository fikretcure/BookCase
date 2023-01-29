<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorCreateRequest;
use App\Http\Requests\AuthorUpdateRequest;
use App\Repositories\AuthorRepository;
use App\Services\AuthorService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
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
     * @return JsonResponse
     */
    public function get(): JsonResponse
    {
        return $this->success($this->authorRepository->get(request()->query()))->send();
    }

    /**
     * @param AuthorCreateRequest $request
     * @return Model|Builder
     * @throws Throwable
     */
    public function create(AuthorCreateRequest $request): Model|Builder
    {
        $this->authorService->checkAvatar($request->validated("avatar"));

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
     * @throws Throwable
     */
    public function update(AuthorUpdateRequest $request, int $id): Model|Collection|Builder|array|null
    {
        $this->authorService->checkAvatar($request->validated("avatar"));

        return $this->authorRepository->update($request->validated(), $id);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->authorRepository->delete($id);
    }

}
