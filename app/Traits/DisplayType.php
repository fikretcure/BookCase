<?php

namespace App\Traits;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

trait DisplayType
{
    /**
     * @param  string|null  $displayType
     * @param  Builder|null  $model
     * @return array|LengthAwarePaginator|Collection
     */
    public function setDisplay(string $displayType = null, Builder $model = null): array|LengthAwarePaginator|Collection
    {
        return $displayType == 'list' ? $model->get() : $model->paginate(request()->per_page ?? 10);
    }
}
