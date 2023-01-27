<?php

namespace App\Repositories;

use App\Helpers\CheckDisplayType;
use App\Models\Author;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
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
     * @param  int  $id
     * @return Model|Collection|Builder|array
     */
    public function show(int $id): Model|Collection|Builder|array
    {
        return $this->model->with('book')->find($id);
    }

    /**
     * @param  array|null  $filtered
     * @return Collection|array|LengthAwarePaginator
     */
    public function get(array $filtered = null): Collection|array|LengthAwarePaginator
    {
        $authors = $this->model->withCount('book')->with('book');

        if (isset($filtered['full_name'])) {
            $authors = $authors->where(DB::raw('concat(name, " ", surname)'), 'LIKE', "%{$filtered['full_name']}%");
        }

        return (new CheckDisplayType())->handle(($filtered['displayType'] ?? null), $authors);
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
}
