<?php

namespace App\Http\Livewire;

use App\Notification;
use App\Post;
use App\Tag;
use App\UserPostView;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Posts extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $user_id, $search,$search_category;

    public function postsGet(){
        if(!empty($this->user_id)){
            return Post::where('status',0)->where("user_id",$this->user_id)->paginate(10);
        }
        else if(!empty($this->search)){
            return Post::where('status',0)->where("title","like","%{$this->search}%")
            ->orwhere("body","like","%{$this->search}%")->paginate(10);
        }
        else if(!empty($this->search_category)){
            return Post::where('status',0)->where('category_id',$this->search_category)->paginate(10);
        }
        else{
            return Post::where('status',0)->paginate(10);
        }
    }

    public function render()
    {
        $populars = Post::orderBy("views","DESC")->limit(3)->get();
        $popular_users = UserPostView::orderBy("views","ASC")->orderBy("posts","ASC")->limit(3)->get();
        return view('livewire.posts',
            [
                "tags" => Tag::all(),
                "populars" => $populars,
                "popular_users" => $popular_users,
                "posts_all" =>  $this->postsGet()
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
        $this->postsGet();
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
        $this->postsGet();
    }
}
