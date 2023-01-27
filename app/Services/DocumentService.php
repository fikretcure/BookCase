<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;
use Throwable;

/**
 *
 */
class DocumentService
{

    /**
     * @return Stringable
     */
    public function upload(): Stringable
    {
        $extension = request()->document->getClientOriginalExtension();
        $path = request()->document->storeAs('docs', rand() . '.' . $extension, 'public');
        return Str::of($path)->afterLast('docs/');
    }

    /**
     * @param $path
     * @return bool
     * @throws Throwable
     */
    public function hasDocument($path): bool
    {
        return throw_unless(Storage::disk('public')->exists("docs/" . $path), Exception::class, 'Foo is true');
    }
}
