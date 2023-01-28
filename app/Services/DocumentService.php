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
     * @param $document
     * @return Stringable
     */
    public function upload($document): Stringable
    {
        $extension = $document->getClientOriginalExtension();
        $path = $document->storeAs('docs', rand() . '.' . $extension, 'public');
        return Str::of($path)->afterLast('docs/');
    }

    /**
     * @param $path
     * @return bool
     * @throws Throwable
     */
    public function hasDocument($path): bool
    {
        return throw_unless(Storage::disk('public')->exists("docs/" . $path), Exception::class, 'Dostum dosya yok !!');
    }

    /**
     * @param $main_dic
     * @param $to_dic
     * @return void
     */
    public function fileMove($main_dic, $to_dic): void
    {
        Storage::disk('public')->move($main_dic, $to_dic);
    }
}
