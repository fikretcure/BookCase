<?php

namespace App\Http\Controllers;

use App\Services\DocumentService;

/**
 *
 */
class DocumentController extends Controller
{
    /**
     * @return mixed
     */
    public function upload(): mixed
    {
        return (new DocumentService())->upload();
    }
}
