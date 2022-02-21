<?php

namespace App\Http\Livewire\Admin;

use App\Category;
use App\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $category, $category_id;
    public $search = '';

    public function render()
    {
        return view('livewire.admin.categories',["categories" => $this->categories()]);
    }

    public function categories(){
        if(empty($this->search)){
            return Category::orderBy("created_at","DESC")->paginate();
        }
        else{
            return Category::where("category","like","%$this->search%")->orderBy("created_at","DESC")->paginate();
        }
    }

    public function save_category(){
        $this->validate(["category" => "required|max:200|unique:categories,category"]);
        DB::transaction(function () {
            Category::create(["category" => $this->category]);
        });
        $this->reset("category");
        $this->dispatchBrowserEvent("exito",["exito" => "Categoria creada exitosamente"]);
    }

    public function edit_category($category,$category_id){
        $this->category = $category;
        $this->category_id = $category_id;
    }

    public function update_category(){
        $this->validate([
            "category" => [
                "required",
                "max:200",
                Rule::unique('categories')->ignore($this->category_id,"id")
            ]
        ]);
        DB::transaction(function () {
            Category::whereId($this->category_id)->update(["category" => $this->category]);
        });
        $this->dispatchBrowserEvent("exito",["exito" => "Categoria actualizada con exito"]);
    }

    public function delete_category($category_id){
        if(Post::whereCategoryId($category_id)->count() == 0){
            DB::transaction(function () use($category_id){
                Category::whereId($category_id)->delete();
            });
            $this->dispatchBrowserEvent("exito",["exito" => "Categoria eliminada exitosamente"]);
        }
        else{
            $this->dispatchBrowserEvent("error",["error" => "La categoria no puede ser eliminada porque ya hay posts registrados con ella"]);
        }
    }

    public function searching(){
        $this->validate(["search" => "required|max:200"]);
        $this->categories();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
