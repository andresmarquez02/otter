<?php

namespace App\Http\Livewire;

use App\Category;
use App\Post;
use App\PostTag;
use App\Tag;
use App\UserPostView;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePosts extends Component
{
    use WithFileUploads;

    public $title, $category, $body, $description, $tags = [];

    public function render()
    {
        return view('livewire.create-posts',["categories" => Category::all(),"tags_all" => Tag::all()]);
    }

    public function createPost(){
        $this->validate([
            "title" => "required|string|max:100",
            "category" => "required|exists:categories,id",
            "body" => "required",
            "description" => "required|max:400",
            "tags" => "required",
            "tags.*" => "exists:tags,id",
        ]);
        DB::beginTransaction();
        try {
            $post = Post::create([
                'title' => $this->title,
                'user_id' => auth()->user()->id,
                'category_id' => $this->category,
                'description' => $this->description,
                'body' => $this->body,
                'status' => 0
            ]);
            UserPostView::where("user_id",auth()->user()->id)->increment("posts",1);
            foreach ($this->tags as $tag) {
                PostTag::create([
                    "post_id" => $post->id,
                    "tag_id" => $tag
                ]);
            }
            DB::commit();
            $this->reset();
            $this->dispatchBrowserEvent("exito",["exito" => "Post creado exitosamente"]);
        } catch (\Throwable $th) {
            dd($th);
            DB::rollback();
            $this->dispatchBrowserEvent("error",["error" => "Ha ocurrido un error inesperado"]);
        }

    }
}
