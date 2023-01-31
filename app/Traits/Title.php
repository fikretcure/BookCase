<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait Title
{
    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn($value) => str()->title($value),
        );
    }
}
