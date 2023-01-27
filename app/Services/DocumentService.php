<?php

namespace App\Services;

/**
 *
 */
class DocumentService
{

    /**
     * @return mixed
     */
    public function upload(): mixed
    {
        $extension = request()->document->getClientOriginalExtension();
        return request()->document->storeAs('docs', rand() . '.' . $extension, 'public');
    }
}
