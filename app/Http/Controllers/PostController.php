<?php

namespace App\Http\Controllers;

use App\Historical as AppHistorical;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        return view('create-post');
    }

    public function photo(Request $request)
    {
        if ($request->hasFile("file")) {
            $file = $request->file("file");
            $name = time() . $file->getClientOriginalName();
            $file->move("post_img", $name);
            return response()->json(['location' => asset("post_img/$name")], 200);
        }
        else{
            return response()->json([], 500);
        }
    }

    public function myPosts()
    {
        return view('myposts');
    }

    public function edit($id)
    {
        return view('edit-post', ['id' => $id]);
    }

    public function view($id)
    {
        return view('view_post', ["id" => $id]);
    }

    public function historical()
    {
        return view('historical');
    }

    public function notifications()
    {
        return view('notifications');
    }
}
