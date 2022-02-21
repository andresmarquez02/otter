<?php

namespace App\Http\Livewire\Admin;


use App\Role;
use App\UserProfile;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Roles extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $role, $role_id;
    public $search = '';

    public function render()
    {
        return view('livewire.admin.roles',["roles" => $this->roles()]);
    }

    public function roles(){
        if(empty($this->search)){
            return Role::orderBy("created_at","DESC")->paginate();
        }
        else{
            return Role::where("role","like","%$this->search%")->orderBy("created_at","DESC")->paginate();
        }
    }

    public function save_role(){
        $this->validate(["role" => "required|max:200|unique:roles,role"]);
        DB::transaction(function () {
            Role::create(["role" => $this->role]);
        });
        $this->reset("role");
        $this->dispatchBrowserEvent("exito",["exito" => "Rol creado exitosamente"]);
    }

    public function edit_role($role,$role_id){
        $this->role = $role;
        $this->role_id = $role_id;
    }

    public function update_role(){
        $this->validate([
            "role" => [
                "required",
                "max:200",
                Rule::unique('roles')->ignore($this->role_id,"id")
            ]
        ]);
        DB::transaction(function () {
            Role::whereId($this->role_id)->update(["role" => $this->role]);
        });
        $this->dispatchBrowserEvent("exito",["exito" => "Rol actualizado con exito"]);
    }

    public function delete_role($role_id){
        if(UserProfile::whereRoleId($role_id)->count() == 0){
            DB::transaction(function () use($role_id){
                Role::whereId($role_id)->delete();
            });
            $this->dispatchBrowserEvent("exito",["exito" => "Rol eliminado exitosamente"]);
        }
        else{
            $this->dispatchBrowserEvent("error",["error" => "No se puede eliminar este rol porque ya hay usuarios registrados con el"]);
        }
    }

    public function searching(){
        $this->validate(["search" => "required|max:200"]);
        $this->roles();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
