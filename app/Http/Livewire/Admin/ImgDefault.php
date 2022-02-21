<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;

class ImgDefault extends Component
{
    use WithFileUploads;

    public $img;

    public function render()
    {
        return view('livewire.admin.img-default');
    }

    public function save_default(){
        $this->validate([
            "img" => "required|image|mimes:png"
        ]);
        $path = public_path()."/images_user/default.png";
        if(file_exists($path))
            unlink($path);
        $this->img->storeAs("images_user","default.png");
        $this->reset();
        $this->dispatchBrowserEvent("exito",["exito" => "Imagen por defecto actualizada con exito"]);
    }
}
