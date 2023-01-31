<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookCreateRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Models\Book;
use App\Repositories\BookRepository;
use App\Repositories\DocumentRepository;
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
     * @var DocumentRepository
     */
    private DocumentRepository $documentRepository;

    /**
     * @param BookRepository $bookRepository
     * @param DocumentRepository $documentRepository
     */
    public function __construct(BookRepository $bookRepository, DocumentRepository $documentRepository)
    {
        $this->bookRepository = $bookRepository;
        $this->documentRepository = $documentRepository;
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

        collect($request->validated("avatars"))->each(function ($item) use ($created_data) {
            $this->documentRepository->create([
                "url" => $item["url"],
                "model_id" => $created_data->id,
                "model_type" => Book::class
            ]);
        });

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
