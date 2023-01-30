<?php

namespace Database\Seeders;

use App\Repositories\BookRepository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        (new BookRepository())->create([
            "avatar" => rand(),
            "name" => "Akyazıda Aşk",
            "subject" => "Romantik",
            "page_count" => rand(),
            "author_id" => 1,
        ]);

        (new BookRepository())->create([
            "avatar" => rand(),
            "name" => "Nefret Yağıyor",
            "subject" => "İntikam",
            "page_count" => rand(),
            "author_id" => 1,
        ]);

        (new BookRepository())->create([
            "avatar" => rand(),
            "name" => "Kırmızı Pencere",
            "subject" => "Sosyoloji",
            "page_count" => rand(),
            "author_id" => 2,
        ]);

        (new BookRepository())->create([
            "avatar" => rand(),
            "name" => "Güzel Babam",
            "subject" => "Aile",
            "page_count" => rand(),
            "author_id" => 2,
        ]);
    }
}
