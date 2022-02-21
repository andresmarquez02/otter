<?php

namespace App\Http\Livewire\Admin;

use App\ImagePortada;
use App\UserProfile;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImgPortada extends Component
{
    use WithFileUploads;
    public $img;

    public function render()
    {
        return view('livewire.admin.img-portada',["images" => ImagePortada::all()]);
    }

    public function save_img(){
        if(!empty($this->img)){
            if (ImagePortada::count() < 6) {
                DB::transaction(function () {
                    $img = $this->img->store('img_portada');
                    $this->validate(["img" => "required|image|mimes:png,jpg"]);
                    ImagePortada::create(["img" => $img]);
                    $this->reset();
                    $this->dispatchBrowserEvent("exito",["exito" => "Imagen guardada exitosamente"]);
                });
            }
            else{
                $this->dispatchBrowserEvent("error",["error" => "Ya excedio el limite de fotos para portadas"]);
            }
        }
    }

    public function update_img($img_id){
        $this->validate(["img" => "required|image|mimes:png,jpg"]);
        if(!empty($this->img)){
            DB::transaction(function () use ($img_id) {
                $img = $this->img->store('img_portada');
                $img_delete = ImagePortada::find($img_id);
                ImagePortada::whereId($img_id)->update(["img" => $img]);
                $path = public_path()."/".$img_delete->img;
                if(file_exists($path)){
                    unlink($img_delete->img);
                }
                $this->reset();
                $this->dispatchBrowserEvent("exito",["exito" => "Imagen actualizada exitosamente"]);
            });
        }
    }

    public function destroyImg($img_id){
        DB::transaction(function () use ($img_id){
            $img = ImagePortada::whereId($img_id)->first();
            if(UserProfile::where("img_portada_id",$img_id)->count() == 0){
                ImagePortada::whereId($img_id)->delete();
                $path = public_path()."/".$img->img;
                if(file_exists($path)){
                    unlink($img->img);
                }
                $this->dispatchBrowserEvent("exito",["exito" => "Imagen eliminada exitosamente"]);
            }
            else{
                $this->dispatchBrowserEvent("error",["error" => "Esta imagen esta siendo usada por un usuario"]);
            }
        });
    }
}
