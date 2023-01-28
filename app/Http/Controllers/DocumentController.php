<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadDocumentRequest;
use App\Services\DocumentService;
use Illuminate\Support\Stringable;

/**
 *
 */
class DocumentController extends Controller
{
    /**
     * @var DocumentService
     */
    private DocumentService $documentService;

    /**
     * @param DocumentService $documentService
     */
    public function __construct(DocumentService $documentService)
    {
        $this->documentService = $documentService;
    }

    /**
     * @param UploadDocumentRequest $request
     * @return Stringable
     */
    public function upload(UploadDocumentRequest $request): Stringable
    {
        return $this->documentService->upload($request->validated("document"));
    }
}
