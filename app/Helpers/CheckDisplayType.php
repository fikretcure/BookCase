<?php

namespace App\Helpers;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 *
 */
class CheckDisplayType
{
    /**
     * @param string|null $displayType
     * @param Builder|null $model
     * @return array|LengthAwarePaginator|Collection
     */
    public function handle(string $displayType = null, Builder $model = null): array|LengthAwarePaginator|Collection
    {
        return $displayType == 'list' ? $model->get() : $model->paginate(request()->per_page ?? 10);
    }
}
