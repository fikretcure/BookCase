<?php

namespace App\Traits;

trait Filtered
{
    public function regCode($model)
    {
        return request()->has("reg_code") ? $model->where("reg_code", request()->query("reg_code")) : $model;
    }
}
