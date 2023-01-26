<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    protected $appends = ["full_name"];

    public function getFullNameAttribute()
    {
        return $this->attributes['name'] . " " . $this->attributes['surname'];
    }

    public function book()
    {
        return $this->hasMany(Book::class);
    }
}
