<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 *
 */
trait Title
{
    /**
     * @return Attribute
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn($value) => str()->title($value),
        );
    }

    /**
     * @return Attribute
     */
    protected function subject(): Attribute
    {
        return Attribute::make(
            set: fn($value) => str()->title($value),
        );
    }

    /**
     * @return Attribute
     */
    protected function surname(): Attribute
    {
        return Attribute::make(
            set: fn($value) => str()->title($value),
        );
    }
}
