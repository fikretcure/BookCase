<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookCreateRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Models\Book;
use App\Repositories\BookRepository;
use App\Services\DocumentService;
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
     * @var DocumentService
     */
    private DocumentService $documentService;

    /**
     * @param BookRepository $bookRepository
     * @param DocumentService $documentService
     */
    public function __construct(BookRepository $bookRepository, DocumentService $documentService)
    {
        $this->bookRepository = $bookRepository;
        $this->documentService = $documentService;
    }

    /**
     * @return JsonResponse
     */
    public function get(): JsonResponse
    {
        return $this->success($this->bookRepository->get())->send();
    }

    /**
     * @param BookCreateRequest $request
     * @return JsonResponse
     */
    public function create(BookCreateRequest $request): JsonResponse
    {
        $created_data = $this->bookRepository->create($request->validated());

        $this->documentService->documentsGenerate($created_data->id, $request->validated("avatars"), Book::class);

        return $this->success($created_data)->send();
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
        $this->documentService->documentsGenerate($id, $request->validated("avatars"), Book::class);
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
