<?php

namespace App\Repositories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AuthorRepository
{
    /**
     * @var Builder
     */
    private Builder $model;

    /**
     * @var array|string[]
     */
    private array $selectData = [
        'id', 'name', 'surname',
    ];

    public function __construct()
    {
        $this->model = Author::query();
    }

    /**
     * @param  array  $attributes
     * @return Model|Builder
     */
    public function create(array $attributes): Model|Builder
    {
        return $this->model->create(
            attributes: $attributes
        );
    }

    /**
     * @param  array  $attributes
     * @param  int  $id
     * @return Model|Collection|Builder|array|null
     */
    public function update(array $attributes, int $id): Model|Collection|Builder|array|null
    {
        $author = $this->model->find($id);
        $author->update($attributes);

        return $author->refresh();
    }

    /**
     * @param  int  $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->model->find($id)->delete();
    }

    /**
     * @param  int  $id
     * @return Model|Collection|Builder|array
     */
    public function show(int $id): Model|Collection|Builder|array
    {
        return $this->model->with('book')->find($id);
    }

    /**
     * @return Collection|array
     */
    public function list(): Collection|array
    {
        return $this->model->get($this->selectData);
    }

    /**
     * @return Collection|array
     */
    public function get(): Collection|array
    {
        return $this->model->withCount('book')->with('book')->get();
    }

    /**
     * @param  string|null  $full_name
     * @return Collection|array
     */
    public function autoComplete(string $full_name = null): Collection|array
    {
        return $this->model->where(DB::raw('concat(name, " ", surname)'), 'LIKE', "%$full_name%")->get($this->selectData);
    }
}
