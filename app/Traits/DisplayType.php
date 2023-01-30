<?php

namespace App\Traits;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

trait DisplayType
{
    /**
     * @param Builder|null $model
     * @return array|LengthAwarePaginator|Collection
     */
    public function setDisplay(Builder $model = null): array|LengthAwarePaginator|Collection
    {
        if (request()->filled("displayType") == "list" && request()->has("displayType")) {
            return $model->get();
        } else {
            return $model->paginate(request()->query('per_page') ?? 10);
        }
    }
}
