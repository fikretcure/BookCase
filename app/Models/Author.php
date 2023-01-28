<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 */
class Author extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * @var string[]
     */
    protected $appends = ['full_name'];

    /**
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return $this->attributes['name'] . ' ' . $this->attributes['surname'];
    }

    /**
     * @return HasMany
     */
    public function book(): HasMany
    {
        return $this->hasMany(Book::class);
    }


    /**
     * @return Attribute
     */
    protected function avatar(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? env("APP_URL") . "/storage/avatar/" . $value : null,
        );
    }
}
