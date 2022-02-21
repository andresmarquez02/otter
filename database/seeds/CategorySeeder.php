<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();
        $variable = [
            "Tecnology",
            "Css",
            "Designer",
            "Sass",
            "Fashion",
            "Death",
            "Music",
            "National",
            "Robberys",
            "Tecnology",
            "Cine",
        ];
        foreach ($variable as $item) {
            Category::create([
                'category' => $item
            ]);
        }
    }
}
