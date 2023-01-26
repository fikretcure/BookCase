<?php

namespace App\Repositories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AuthorRepository
{
    private $model;

    public function __construct()
    {
        $this->model = Author::query();
    }

    public function create(array $attributes): Model
    {
        return $this->model->create(
            attributes: $attributes,
        );
    }

    public function list()
    {
        return $this->model->select("id", "name", "surname")->get();
    }

    public function autoComplete(string $full_name)
    {
        return $this->model->where(DB::raw('concat(name, " ", surname)'), 'LIKE', "%{$full_name}%")->get();
    }
}
