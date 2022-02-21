<?php

use App\Tag;
use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            "Alpine",
            "Angular",
            "F#",
            "CoffeScripts",
            "Css",
            "C",
            "C++",
            "C#",
            "Git",
            "Github",
            "Gitlab",
            "Javascript",
            "Java",
            "Kotlin",
            "Doker",
            "Composer",
            "Go",
            "GoLand",
            "Html",
            "PHP",
            "Laravel",
            "Vue",
            "Tailwind",
            "Bootstrap",
            "mdBootstrap",
            "Sass",
            "Less",
            "Node",
            "Express",
            "React",
            "Ruby",
            "Python",
            "Programing",
            "Designer",
            "Ux",
            "Ui"
        ];
        foreach ($tags as $value) {
            Tag::create(['tag' => $value]);
        }

    }
}
