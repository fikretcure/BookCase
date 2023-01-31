<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use App\Models\Book;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BookRepository extends Repository implements RepositoryInterface
{

    /**
     * @var Builder
     */
    private Builder $model;

    public function __construct()
    {
        $this->model = Book::query()->withCount('author', "document")->with('author', 'document');
    }

    /**
     * @param array $attributes
     * @return Model|Collection|Builder|array
     */
    public function create(array $attributes): Model|Collection|Builder|array
    {
        $data = $this->model->create(
            attributes: ["reg_code" => $this->generateRegCode(Book::class)] + $attributes
        );

        return $this->show($data["id"]);
    }

    /**
     * @param int $id
     * @return Model|Collection|Builder|array
     */
    public function show(int $id): Model|Collection|Builder|array
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param array|null $filtered
     * @return Collection|array|LengthAwarePaginator
     */
    public function get(array $filtered = null): Collection|array|LengthAwarePaginator
    {
        $data = $this->model;

        $data = $this->regCode($data);

        return $this->setDisplay($data);
    }

    /**
     * @param array $attributes
     * @param int $id
     * @return Model|Collection|Builder|array|null
     */
    public function update(array $attributes, int $id): Model|Collection|Builder|array|null
    {
        $data = $this->model->findOrFail($id);
        $data->update($attributes);

        return $this->show($id);
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
