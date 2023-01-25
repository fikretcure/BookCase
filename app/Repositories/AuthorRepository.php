<?php

namespace App\Repositories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Model;

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

    public function all(): Model
    {
        return $this->model->all();
    }
}
