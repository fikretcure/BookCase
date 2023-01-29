<?php

namespace App\Repositories;

use App\Models\Author;
use App\Traits\DisplayType;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AuthorRepository
{
    use DisplayType;

    /**
     * @var Builder
     */
    private Builder $model;

    public function __construct()
    {
        $this->model = Author::query();
    }

    /**
     * @param array $attributes
     * @return Model|Builder
     */
    public function create(array $attributes): Model|Builder
    {
        return $this->model->create(
            attributes: $attributes + ["reg_code" => rand()]
        );
    }

    /**
     * @param int $id
     * @return Model|Collection|Builder|array
     */
    public function show(int $id): Model|Collection|Builder|array
    {
        return $this->model->with('book')->findOrFail($id);
    }

    /**
     * @param array|null $filtered
     * @return Collection|array|LengthAwarePaginator
     */
    public function get(array $filtered = null): Collection|array|LengthAwarePaginator
    {
        $authors = $this->model->withCount('book')->with('book');

        if (isset($filtered['full_name'])) {
            $authors = $authors->where(DB::raw('concat(name, " ", surname)'), 'LIKE', "%{$filtered['full_name']}%");
        }

        return $this->setDisplay(($filtered['displayType'] ?? null), $authors);
    }

    /**
     * @param array $attributes
     * @param int $id
     * @return Model|Collection|Builder|array|null
     */
    public function update(array $attributes, int $id): Model|Collection|Builder|array|null
    {
        $author = $this->model->findOrFail($id);
        $author->update($attributes);

        return $author->refresh();
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->model->find($id)->delete();
    }
}
