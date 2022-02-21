<?php

use App\Image;
use App\User;
use App\UserPostView;
use App\UserProfile;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            "name" => "Andres Marquez",
            "email" => "andres03ruht@gmail.com",
            "password" => bcrypt("123"),
        ]);
        UserPostView::create([
            "user_id" => $user->id
        ]);
        $img = Image::create(["img_url" => "images_user/default.jpg"]);
        UserProfile::create([
            "img_profile_id" => $img->id,
            "user_id" => $user->id,
            "role_id" => 2
        ]);
    }
}
