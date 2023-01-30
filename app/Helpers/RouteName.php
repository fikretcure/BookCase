<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Route;

/**
 *
 */
enum RouteName: string
{
    case authors = "Yazar";
    case get = "Listeleme";
    case delete = "Silme";
    case update = "Güncelleme";
    case show = "Getirme";
    case create = "Ekleme";


    /**
     * @return mixed
     */
    public static function makeActionName(): mixed
    {
        return str()->of(Route::currentRouteName())->explode('.')->map(function ($name, $key) {
            return (collect(self::cases())->map(function ($item, $key) use ($name) {
                if ($item->name == $name) {
                    return $item->value;
                }
                return false;
            })->filter())->first();
        })->implode(' ');
    }

}
