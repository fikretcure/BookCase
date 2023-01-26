<?php

namespace App\Repositories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AuthorRepository
{
    /**
     * @var \Illuminate\Database\Eloquent\Builder
     */
    private $model;

    /**
     * @var string[]
     */
    private $selectData = [
        'id', 'name', 'surname',
    ];

    public function __construct()
    {
        $this->model = Author::query();
    }

    /**
     * @param  array  $attributes
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->create(
            attributes: $attributes,
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function list()
    {
        return $this->model->get($this->selectData);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function get()
    {
        return $this->model->withCount('book')->with('book')->get();
    }

    /**
     * @param  string  $full_name
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function autoComplete(string $full_name)
    {
        return $this->model->where(DB::raw('concat(name, " ", surname)'), 'LIKE', "%{$full_name}%")->get($this->selectData);
    }
}
