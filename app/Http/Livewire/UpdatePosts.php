<?php

namespace App\Http\Livewire;

use App\Category;
use App\Image;
use App\Post;
use App\PostTag;
use App\Tag;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdatePosts extends Component
{
    use WithFileUploads;

    public $title, $category, $body, $id_post, $description, $tags = [];

    public function mount(){
        $post = Post::where("id",$this->id_post)->where("user_id",auth()->user()->id)->first();
        $this->title = $post->title;
        $this->category = $post->category_id;
        $this->body = $post->body;
        $this->description = $post->description;
        $this->tags = PostTag::where("post_id",$this->id_post)->get()->pluck("tag_id");
    }

    public function render()
    {
        return view('livewire.update-posts',["categories" => Category::all(),"tags_all" => Tag::all()]);
    }

    public function updatePost(){
        $this->validate([
            "title" => "required|string|max:255",
            "category" => "required|exists:categories,id",
            "body" => "required",
            "description" => "required|max:400",
            "tags" => "required",
            "tags.*" => "exists:tags,id"
        ]);
        DB::beginTransaction();
        try {
            Post::where("id",$this->id_post)->update([
                'title' => $this->title,
                'category_id' => $this->category,
                'description' => $this->description,
                'body' => $this->body,
            ]);
            PostTag::where("post_id",$this->id_post)->delete();
            foreach ($this->tags as $tag) {
                PostTag::create([
                    "post_id" => $this->id_post,
                    "tag_id" => $tag
                ]);
            }
            DB::commit();
            $this->dispatchBrowserEvent("exito",["exito" => "Ad saved successfully"]);
        } catch (\Throwable $th) {
            DB::rollback();
            $this->dispatchBrowserEvent("error",["error" => "Unexpected error try again"]);
        }

    }
}
