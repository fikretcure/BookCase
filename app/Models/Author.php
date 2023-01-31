<?php

namespace App\Models;

use App\Traits\Title;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 */
class Author extends Model
{
    use HasFactory, SoftDeletes, Title;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "name",
        "surname",
        "reg_code"
    ];

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
     * @var string
     */
    public static string $reg_code = "Y";

    /**
     * @return MorphOne
     */
    public function document(): MorphOne
    {
        return $this->morphOne(Document::class, 'model');
    }
}
