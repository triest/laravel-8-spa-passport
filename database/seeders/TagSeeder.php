<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create(
            [
                'title' => "Кошки",
            ],
        );
        Tag::create(
            [
                'title' => "Собаки",
            ],
        );
    }
}
