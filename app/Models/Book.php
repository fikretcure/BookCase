<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 */
class Book extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "name",
        "subject",
        "page_count",
        "author_id",
        "reg_code"
    ];


    /**
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * @var string
     */
    public static string $reg_code = "K";

    /**
     * @return MorphMany
     */
    public function document(): MorphMany
    {
        return $this->morphMany(Document::class, 'model');
    }
}
