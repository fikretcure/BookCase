<?php

namespace App\Rules;

use App\Services\DocumentService;
use Illuminate\Contracts\Validation\InvokableRule;
use Throwable;

class FileHasInDocs implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     * @return void
     * @throws \Throwable
     */
    public function __invoke($attribute, $value, $fail)
    {
        try {
            (new DocumentService())->hasDocument($value);

        } catch (Throwable $e) {
            $fail('Bu :attribute dosyalarda kayıtlı değildir.');
        }
    }
}
