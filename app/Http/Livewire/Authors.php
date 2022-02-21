<?php

namespace App\Http\Livewire;

use App\Post;
use App\Tag;
use App\User;
use App\UserPostView;
use Livewire\Component;

class Authors extends Component
{

    public function render()
    {
        $populars = Post::orderBy("views","DESC")->limit(3)->get();
        $popular_users = UserPostView::orderBy("views","ASC")->orderBy("posts","ASC")->limit(3)->get();
        return view('livewire.authors',
        [
            "tags" => Tag::all(),
            "populars" => $populars,
            "popular_users" => $popular_users,
            "authors" => $this->getAuthors()
        ]);
    }

    public function getAuthors(){
        return User::leftjoin("user_profiles","user_profiles.user_id","=","users.id")
        ->leftjoin("user_post_views","user_post_views.user_id","=","users.id")
        ->leftjoin("images","images.id","user_profiles.img_profile_id")
        ->where("users.status",1)
        ->get();
    }

    public function blockUser($id_user){
        User::whereId($id_user)->update(["status" => 0]);
        $this->dispatchBrowserEvent("exito",["exito" => "Usuario bloqueado"]);
    }
}
