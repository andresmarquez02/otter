<?php

namespace App\Http\Livewire;

use App\Category;
use App\Notification;
use Livewire\Component;

class Nav extends Component
{
    public $notifications;
    public $listeners = ["notification_reload"];

    public function render()
    {
        if(auth()->user()){
            $this->notifications = Notification::whereUserId(auth()->user()->id)->where("view",0)->get();
        }
        return view('livewire.nav',["categories" => Category::all()]);
    }

    public function notification_reload(){
        $this->notifications = Notification::whereUserId(auth()->user()->id)->where("view",0)->get();
    }
}
