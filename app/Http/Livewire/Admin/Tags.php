<?php

namespace App\Http\Livewire\Admin;

use App\PostTag;
use App\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Tags extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $tag, $tag_id;
    public $search = '';

    public function render()
    {
        return view('livewire.admin.tags',["tags" => $this->tags()]);
    }

    public function tags(){
        if(empty($this->search)){
            return Tag::orderBy("created_at","DESC")->paginate();
        }
        else{
            return Tag::where("tag","like","%$this->search%")->orderBy("created_at","DESC")->paginate();
        }
    }

    public function save_tag(){
        $this->validate(["tag" => "required|max:200|unique:tags,tag"]);
        DB::transaction(function () {
            Tag::create(["tag" => $this->tag]);
        });
        $this->reset("tag");
        $this->dispatchBrowserEvent("exito",["exito" => "Etiqueta creada exitosamente"]);
    }

    public function edit_tag($tag,$tag_id){
        $this->tag = $tag;
        $this->tag_id = $tag_id;
    }

    public function update_tag(){
        $this->validate([
            "tag" => [
                "required",
                "max:200",
                Rule::unique('tags')->ignore($this->tag_id,"id")
            ]
        ]);
        DB::transaction(function () {
            Tag::whereId($this->tag_id)->update(["tag" => $this->tag]);
        });
        $this->dispatchBrowserEvent("exito",["exito" => "Etiqueta actualizada con exito"]);
    }

    public function delete_tag($tag_id){
        if (PostTag::whereTagId($tag_id)->count() == 0) {
            DB::transaction(function () use($tag_id){
                Tag::whereId($tag_id)->delete();
            });
            $this->dispatchBrowserEvent("exito",["exito" => "Etiqueta eliminada exitosamente"]);
        } else {
            $this->dispatchBrowserEvent("error",["error" => "No se puede eliminar la etiqueta porque ya hay posts registrados con ella"]);
        }

    }

    public function searching(){
        $this->validate(["search" => "required|max:200"]);
        $this->tags();
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }
}
