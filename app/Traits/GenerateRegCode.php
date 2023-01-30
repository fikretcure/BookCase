<?php

namespace App\Traits;

/**
 *
 */
trait GenerateRegCode
{
    /**
     * @param $model
     * @return string
     */
    public function generateRegCode($model): string
    {
        $max_id = $model::query()->withTrashed()->max("id") + 1;

        $last_code = str_repeat("0", (4 - strlen($max_id)));
        return $model::$reg_code . $last_code . $max_id;
    }
}
