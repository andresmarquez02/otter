<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function roles(){
        return view("admin.roles");
    }

    public function tags(){
        return view("admin.tags");
    }

    public function categories(){
        return view("admin.categories");
    }

    public function imgPortada(){
        return view("admin.img_portada");
    }

    public function imgDefault(){
        return view("admin.img_default");
    }

    public function usersBlocks(){
        return view("admin.users_blocks");
    }

    public function statistical(){
        return view("admin.statistical");
    }
}
