<?php

namespace App\Http\Controllers;

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
}
