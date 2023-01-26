<?php

namespace App\Helpers;

class CheckDisplayType
{
    /**
     * @param  string|null  $displayType
     * @param $model
     * @return mixed
     */
    public function handle(string $displayType = null, $model = null): mixed
    {
        if ($displayType == 'list') {
            return $model->get();
        }

        return $model->paginate(request()->per_page ?? 10);
    }
}
