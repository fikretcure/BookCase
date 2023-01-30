<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookCreateRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Repositories\BookRepository;
use Illuminate\Http\JsonResponse;

/**
 *
 */
class BookController extends Controller
{

    /**
     * @var BookRepository
     */
    private BookRepository $bookRepository;


    /**
     * @param BookRepository $bookRepository
     */
    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * @return JsonResponse
     */
    public function get(): JsonResponse
    {
        return $this->success($this->bookRepository->get(request()->query()))->send();
    }

    /**
     * @param BookCreateRequest $request
     * @return JsonResponse
     */
    public function create(BookCreateRequest $request): JsonResponse
    {
        return $this->success($this->bookRepository->create($request->validated()))->send();
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return $this->success($this->bookRepository->show($id))->send();
    }

    /**
     * @param BookUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(BookUpdateRequest $request, int $id): JsonResponse
    {

        return $this->success($this->bookRepository->update($request->validated(), $id))->send();
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        return $this->success($this->bookRepository->delete($id))->send();
    }

}
