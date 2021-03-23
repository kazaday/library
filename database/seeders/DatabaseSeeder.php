<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        for ($z = 0; $z < 20; $z++) {
            \App\Models\Author::create([
                'first_name' => 'Имя_' . $z,
                'last_name' => 'Фамилия_' . $z,
                'second_name' => 'Отчество_' . $z,

            ]);
            \App\Models\Book::create([
                'name'=>'Книга_'.$z,
                'description'=>'Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться._'.$z,
                'poster'=>'noposter.png',
            ])->authors()->attach($z);
        }


    }
}
