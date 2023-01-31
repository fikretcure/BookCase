<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class FileTypeImage implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        $mimes = collect(["png", "jpg", "jpeg", "bmp"]);

        if (!$mimes->contains(str()->afterLast($value, "."))) {
            $fail('Bu :attribute tipini yükleyemezsiniz !');
        }
    }
}
