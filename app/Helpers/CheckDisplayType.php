<?php

namespace App\Helpers;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class CheckDisplayType
{
    /**
     * @var Builder
     */
    private Builder $model;

    /**
     * @param  string|null  $displayType
     * @param $model
     * @return array|LengthAwarePaginator|Collection
     */
    public function handle(string $displayType = null, $model = null): array|LengthAwarePaginator|Collection
    {
        $this->model = $model;
        if ($displayType == 'list') {
            return $this->model->get();
        }

        return $this->model->paginate(request()->per_page ?? 10);
    }
}
