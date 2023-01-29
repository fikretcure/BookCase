<?php

namespace App\Services;

use Throwable;
/**
 *
 */
class AuthorService
{

    /**
     * @var DocumentService
     */
    private DocumentService $documentService;

    public function __construct(DocumentService $documentService)
    {

        $this->documentService = $documentService;
    }

    /**
     * @throws Throwable
     */
    public function checkAvatar($avatar): void
    {
        if ($avatar) {
            $this->documentService->hasDocument($avatar);
            $this->documentService->fileMove("docs/" . $avatar, "avatar/" . $avatar);
        }
    }
}
