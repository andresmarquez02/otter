<?php

namespace App\Http\Livewire\Admin;

use App\Post;
use App\User;
use Livewire\Component;

class Statisticals extends Component
{
    public $users, $posts, $post, $post_month,$author_views,$author_posts;

    public function mount(){
        $this->users = User::all();
        $this->posts = Post::leftjoin("users","users.id","posts.user_id")->select("posts.*","users.status")
        ->orderBy("views","DESC")->get();
        $this->post = $this->posts->where("status",1)->first();
        $this->post_month = Post::whereMonth('created_at', '2')->orderBy("views","DESC")->first();
        $this->author_views = $this->user()->orderBy("views","DESC")->first();
        $this->author_posts = $this->user()->orderBy("posts","DESC")->first();
    }

    public function user(){
        return User::leftjoin("user_profiles","user_profiles.user_id","=","users.id")
        ->leftjoin("user_post_views","user_post_views.user_id","=","users.id")
        ->leftjoin("images","images.id","user_profiles.img_profile_id")
        ->where("users.status",1);
    }

    public function render()
    {
        return view('livewire.admin.statisticals');
    }
}
