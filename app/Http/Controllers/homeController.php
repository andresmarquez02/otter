<?php

namespace App\Http\Controllers;

use App\Category;
use App\Image;
use App\ImagePortada;
use App\Network;
use App\Role;
use App\Tag;
use App\User;
use App\UserPostView;
use App\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class homeController extends Controller
{
    public function index(){
        return view('index');
    }
    public function search(){
        return view('search')->with("search",request()->get("query"));
    }
    public function search_category($id){
        return view('search_category')->with("search_category",$id);
    }
    public function login()
    {
        return view('Login');
    }
    public function register()
    {
        return view('Register');
    }
    public function logout(){
        Auth::logout();
        session()->flush();
        Cache   ::flush();
        return redirect("/");
    }
    public function seeders(){
        Category::truncate();
        $variable = [
            "Tutoriales",
            "Programación",
            "Diseño",
        ];
        foreach ($variable as $item) {
            Category::create([
                'category' => $item
            ]);
        }
        ImagePortada::create(["img" => "img_portada/portada1.jpg"]);
        ImagePortada::create(["img" => "img_portada/portada2.jpg"]);
        ImagePortada::create(["img" => "img_portada/portada3.jpg"]);
        ImagePortada::create(["img" => "img_portada/portada4.jpg"]);
        $networks = [
            "Facebook",
            "Instagram",
            "Linkedin",
            "Twitter",
        ];
        foreach ($networks as $value) {
            Network::create(["network" => $value]);
        }
        Role::create(["role" => "Admin"]);
        Role::create(["role" => "Natural"]);
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
        $user = User::create([
            "name" => "Andres Marquez",
            "email" => "andres03marquez@gmail.com",
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
