<?php

namespace App\Helpers;

enum RouteName: string
{
    case author = "Yazar";
    case get = "Listeleme";
    case delete = "Silme";
    case update = "Güncelleme";
    case show = "Getirme";


    public static function makeActionName($names)
    {
        return str()->of($names)->explode('-')->map(function ($name, $key) {
            return (collect(self::cases())->map(function ($item, $key) use ($name) {
                if ($item->name == $name) {
                    return $item->value;
                }
                return false;
            })->filter())->first();
        })->implode(' ');
    }

}
