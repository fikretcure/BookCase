<?php

namespace App\Repositories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AuthorRepository
{
    /**
     * @var Model|Author
     */
    private Model $model;

    /**
     * @var string[]
     */
    private $selectData = [
        'id', 'name', 'surname',
    ];

    /**
     * @param  Author  $author
     */
    public function __construct(Author $author)
    {
        $this->model = $author;
    }

    /**
     * @param  array  $attributes
     * @return Author
     */
    public function create(array $attributes): Author
    {
        return $this->model->create(
            attributes: $attributes,
        );
    }

    /**
     * @return object
     */
    public function list(): object
    {
        return $this->model->get($this->selectData);
    }

    /**
     * @return object
     */
    public function get(): object
    {
        return $this->model->withCount('book')->with('book')->get();
    }

    /**
     * @param  string|null  $full_name
     * @return object
     */
    public function autoComplete(string $full_name = null): object
    {
        return $this->model->where(DB::raw('concat(name, " ", surname)'), 'LIKE', "%{$full_name}%")->get($this->selectData);
    }
}
