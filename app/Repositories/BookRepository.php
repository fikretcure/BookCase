<?php

namespace App\Repositories;

use App\Models\Book;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BookRepository extends Repository
{

    /**
     * @var Builder
     */
    private Builder $model;

    public function __construct()
    {
        $this->model = Book::query();
    }

    /**
     * @param array $attributes
     * @return Model|Builder
     */
    public function create(array $attributes): Model|Builder
    {
        return $this->model->create(
            attributes: ["reg_code" => $this->generateRegCode(Book::class)] + $attributes
        );
    }

    /**
     * @param int $id
     * @return Model|Collection|Builder|array
     */
    public function show(int $id): Model|Collection|Builder|array
    {
        return $this->model->withCount('author')->with('author')->findOrFail($id);
    }

    /**
     * @param array|null $filtered
     * @return Collection|array|LengthAwarePaginator
     */
    public function get(array $filtered = null): Collection|array|LengthAwarePaginator
    {
        $books = $this->model->withCount('author')->with('author');


        return $this->setDisplay(($filtered['displayType'] ?? null), $books);
    }

    /**
     * @param array $attributes
     * @param int $id
     * @return Model|Collection|Builder|array|null
     */
    public function update(array $attributes, int $id): Model|Collection|Builder|array|null
    {
        $book = $this->model->findOrFail($id);
        $book->update($attributes);

        return $book->refresh();
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
