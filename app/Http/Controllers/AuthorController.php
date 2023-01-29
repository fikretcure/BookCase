<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorCreateRequest;
use App\Http\Requests\AuthorUpdateRequest;
use App\Repositories\AuthorRepository;
use App\Services\AuthorService;
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
     * @return JsonResponse
     * @throws Throwable
     */
    public function create(AuthorCreateRequest $request): JsonResponse
    {
        $this->authorService->checkAvatar($request->validated("avatar"));

        return $this->success($this->authorRepository->create($request->validated()))->send();
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return $this->success($this->authorRepository->show($id))->send();
    }

    /**
     * @param AuthorUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(AuthorUpdateRequest $request, int $id): JsonResponse
    {
        $this->authorService->checkAvatar($request->validated("avatar"));

        return $this->success($this->authorRepository->update($request->validated(), $id))->send();
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        return $this->success($this->authorRepository->delete($id))->send();
    }

}
