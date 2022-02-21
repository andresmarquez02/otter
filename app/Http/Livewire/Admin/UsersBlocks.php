<?php

namespace App\Http\Livewire\Admin;

use App\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersBlocks extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    public $search;

    public function render()
    {
        return view('livewire.admin.users-blocks',["users" => $this->users()]);
    }
    public function users(){
        if(!empty($this->search)){
            return User::where("status",0)->where("email","like","%$this->search%")
            ->orwhere("status",0)->where("name","like","%$this->search%")->paginate(1);
        }
        return User::where("status",0)->paginate(1);
    }
    public function searching(){
        $this->validate(["search" => "required|max:200"]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function ablock($user_id){
        User::whereId($user_id)->update(["status" => 1]);
    }
}
