<?php

namespace App\Http\Livewire;

use App\Post;
use App\Tag;
use App\User;
use App\UserNetwork;
use App\UserPostView;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ViewProfile extends Component
{
    public $id_user, $user,$posts, $view_details = true, $user_networks;

    public function mount(){
        $this->user = User::find($this->id_user);
        $this->posts = Post::whereUserId($this->id_user)->get();
        $this->user_networks = UserNetwork::whereUserId($this->id_user)->get();
    }

    public function render()
    {
        $populars = Post::orderBy("views","DESC")->limit(3)->get();
        $popular_users = UserPostView::orderBy("views","ASC")->orderBy("posts","ASC")->limit(3)->get();
        return view('livewire.view-profile',[
            "tags" => Tag::all(),
            "populars" => $populars,
            "popular_users" => $popular_users
        ]);
    }

    public function view(){
        $this->view_details = !$this->view_details;
    }

    public function blockUser($id_user){
        DB::transaction(function () use ($id_user){
            User::whereId($id_user)->update(["status" => 0]);
            Post::whereUserId($id_user)->delete();
            UserPostView::where("user_id",$id_user)->update(["posts" => 0, "views" => 0]);
        });
        $this->dispatchBrowserEvent("exito",["exito" => "Usuario bloqueado"]);
        return redirect()->to("authors");
    }
}
