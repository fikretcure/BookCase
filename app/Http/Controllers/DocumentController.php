<?php

namespace App\Http\Controllers;

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
     * @return Stringable
     */
    public function upload(): Stringable
    {
        return $this->documentService->upload();
    }
}
