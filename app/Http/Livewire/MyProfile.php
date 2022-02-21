<?php

namespace App\Http\Livewire;

use App\Image;
use App\ImagePortada;
use App\Network;
use App\User;
use App\UserNetwork;
use App\UserProfile;
use Doctrine\Inflector\Rules\English\Rules;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class MyProfile extends Component
{
    use WithFileUploads;

    public
    $name,
    $email,
    $profession,
    $description,
    $url_portfolio,
    $img_portada,
    $img_profile,
    $img_profile_new,
    $user_networks,
    $url_network = [];

    public function mount(){
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->profession = auth()->user()->profile->profession;
        $this->url_portfolio = auth()->user()->profile->url_portfolio;
        $this->description = auth()->user()->profile->description;
        $this->img_portada = auth()->user()->img_portada()->img;
        $this->img_profile = auth()->user()->img_profile()->img_url;
        $this->user_networks = UserNetwork::whereUserId(auth()->user()->id)->get();
    }

    public function render()
    {
        return view('livewire.my-profile',["networks" => Network::all(), "portadas" => ImagePortada::all()]);
    }

    public function change_portada($img,$id_img){
        DB::transaction(function () use($img,$id_img){
            UserProfile::where("user_id",auth()->user()->id)->update(["img_portada_id" => $id_img]);
            $this->img_portada = $img;
        });
        $this->dispatchBrowserEvent("exito",["exito" => "Portada actualizado con exito"]);
    }

    public function update_network(){
        $this->validate([
            "url_network" => "required"
        ]);
        DB::transaction(function () {
            UserNetwork::where("user_id",auth()->user()->id)->delete();
            foreach ($this->url_network as $key => $url_network) {
                if (!empty($url_network[$key]["network_url"]) && !empty($url_network[$key]["network_id"])) {
                    UserNetwork::create([
                        "user_id" => auth()->user()->id,
                        "network_id" => $url_network[$key]["network_id"],
                        "url" => $url_network[$key]["network_url"],
                    ]);
                }
            }
        });
        $this->dispatchBrowserEvent("exito",["exito" => "Redes actualizadas con exito"]);
    }

    public function change_profile(){
        $this->validate([
            "img_profile_new" => "image|required|mimes:png,jpg|max:2040"
        ]);
        DB::transaction(function () {
            $img_url = $this->img_profile_new->store('images_user');
            $id_image = Image::where("id",auth()->user()->img_profile()->id)->update(
                ["img_url" => $img_url]
            );
            if(empty(auth()->user()->img_profile()->id)){
                UserProfile::where("user_id",auth()->user()->id)->update(["img_profile_id" => $id_image]);
            }
            $this->reset("img_profile_new");
            if($this->img_profile != "default.jpg" || $this->img_profile != "default.png"){
                $path = public_path()."/".$this->img_profile;
                if(file_exists($path)){
                    unlink($path);
                }
            }
            $this->img_profile = $img_url;
        });
        $this->dispatchBrowserEvent("exito",["exito" => "Perfil actualizado con exito"]);
    }
    public function update_info($id = 0){
        $id = auth()->user()->id;
        $this->validate([
            "name" => "required|min:3|max:255",
            "email" => "required|email|min:3|max:255|unique:users,email,except,id",
            "email" => Rule::unique('users', 'email')->ignore(auth()->user()->id),
            "profession" => "required|min:3|max:255",
            "url_portfolio" => "nullable|max:4000",
            "description" => "required|max:4000",
        ]);
        DB::transaction(function () {
            User::where("id",auth()->user()->id)->update([
                "name" => $this->name,
                "email" => $this->email,
            ]);
            UserProfile::where("user_id",auth()->user()->id)->update([
                "profession" => $this->profession,
                "url_portfolio" => $this->url_portfolio,
                "description" => $this->description,
            ]);
        });
        $this->dispatchBrowserEvent("exito",["exito" => "Perfil actualizado con exito"]);
    }
}
