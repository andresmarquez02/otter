<?php

namespace App\Http\Livewire;

use App\Post;
use App\Tag;
use App\Historical;
use App\Notification;
use App\UserPostView;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ViewPost extends Component
{
    public $id_post, $post;

    public function mount(){
        $this->post = Post::find($this->id_post);

        if(empty($this->post)) return redirect()->to("/home");

        if(Cache::has('post')){
            if(Cache::get("post") != $this->id_post){
                Cache::add('post', $this->id_post, 4000);
                Historical::create([
                    "user_id_view" => auth()->user() ? auth()->user()->id : 0,
                    "post_id" => $this->id_post,
                ]);
                $this->post->increment("views",1);
                $this->post->save();
                UserPostView::where("user_id", $this->post->user_id)->increment("views",1);
            }
        }
        else{
            Cache::add('post', $this->id_post, 4000);
            Historical::create([
                "user_id_view" => auth()->user() ? auth()->user()->id : 0,
                "post_id" => $this->id_post,
            ]);
            $this->post->increment("views",1);
            $this->post->save();
            UserPostView::where("user_id", $this->post->user_id)->increment("views",1);
        }
    }

    public function render()
    {
        $populars = Post::orderBy("views","ASC")->limit(3)->get();
        $popular_users = UserPostView::orderBy("views","ASC")->orderBy("posts","ASC")->limit(3)->get();
        return view('livewire.view-post',
            [
                "tags" => Tag::all(),
                "populars" => $populars,
                "popular_users" => $popular_users
            ]
        );
    }

    public function destroyPost($id_post){
        DB::transaction(function () use ($id_post){
            $post = Post::where("id",$id_post)->first();
            Post::where("id",$id_post)->where("user_id",$post->user_id)->delete();
            UserPostView::where("user_id",$post->user_id)->decrement("posts",1);
        });
        $this->dispatchBrowserEvent("exito",["exito" => "Post eliminado exitosamente"]);
        return redirect()->to("/home");
    }

    public function blockPost($id_post){
        DB::transaction(function () use ($id_post){
            $post = Post::where("id",$id_post)->first();
            Post::where("id",$id_post)->where("user_id",$post->user_id)->delete();
            UserPostView::where("user_id",$post->user_id)->decrement("posts",1);
            Notification::create([
                "title_post" => $post->title,
                "user_id" => $post->user_id,
            ]);
            $this->emit('notification_reload');
            $this->emit('notification_reload_page');
        });
        $this->dispatchBrowserEvent("exito",["exito" => "Post bloqueado"]);
        return redirect()->to("/home");
    }
}
