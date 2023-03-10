<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    /**
     * @return Attribute
     */
    protected function url(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? env("APP_URL") . "/storage/avatar/" . $value : null,
        );
    }
}
