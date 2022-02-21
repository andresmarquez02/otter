<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function authors(){
        return view("authors");
    }
    public function myProfile(){
        return view("my_profile");
    }
    public function viewProfile($id){
        return view("view_profile",["id" => $id]);
    }
}
