<?php

namespace App\Services;

use App\Repositories\DocumentRepository;
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
     * @var DocumentRepository
     */
    private DocumentRepository $documentRepository;

    /**
     */
    public function __construct()
    {
        $this->documentRepository = new DocumentRepository();
    }

    /**
     * @param $document
     * @return Stringable
     */
    public function upload($document): Stringable
    {
        $extension = $document->getClientOriginalExtension();
        $path = $document->storeAs('docs', now()->toDateString() . "-" . str()->uuid() . '.' . $extension, 'public');
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

    /**
     * @param $model_id
     * @param $url
     * @param $model_type
     * @return void
     */
    public function documentsGenerate($model_id, $url, $model_type): void
    {
        collect($url)->each(function ($item) use ($model_id, $model_type) {
            if ($item["url"]) {
                $this->documentRepository->create([
                    "url" => $item["url"],
                    "model_id" => $model_id,
                    "model_type" => $model_type
                ]);
                $this->fileMove("docs/" . $item["url"], "avatar/" . $item["url"]);
            }
        });
    }

}
