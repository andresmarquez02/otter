<?php

namespace App\Http\Livewire;

use App\Image;
use App\User;
use Illuminate\Support\Facades\DB;
use App\UserPostView;
use App\UserProfile;
use Livewire\Component;

class Register extends Component
{
    public $name, $email, $password,$password_confirmation,$term;

    public function render()
    {
        return view('livewire.register');
    }

    public function register(){
        $this->validate([
            "name" => "required|min:1|string|max:255",
            "email" => "required|email|string|min:1|max:255|unique:users,email",
            "password" => "required|min:1|confirmed|max:255",
            "term" => "required|numeric|min:1|max:1"
        ]);
        DB::beginTransaction();
        try {
            $user = User::create([
                "name" => $this->name,
                "email" => $this->email,
                "password" => bcrypt($this->password),
            ]);
            UserPostView::create([
                "user_id" => $user->id
            ]);
            $img = Image::create(["img_url" => "images_user/default.jpg"]);
            UserProfile::create([
                "img_profile_id" => $img->id,
                "user_id" => $user->id,
                "role_id" => 2
            ]);
            DB::commit();
            return redirect()->to("login")->with("exito","Loguate y accede");
        } catch (\Throwable $th) {
            DB::rollback();
            $this->dispatchBrowserEvent("error",["error" => "A ocurrido un error inesperado."]);
        }

    }
}
