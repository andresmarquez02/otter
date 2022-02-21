<?php

namespace App\Http\Livewire;

use App\Notification;
use Livewire\Component;

class Notifications extends Component
{
    public $notifications;
    public $listeners = ["notification_reload_page"];

    public function render()
    {
        $this->notifications = Notification::whereUserId(auth()->user()->id)->where("view",0)->get();
        Notification::whereUserId(auth()->user()->id)->where("view",0)->increment("view",1);
        $this->emit("notification_reload");
        return view('livewire.notifications');
    }

    public function notification_reload_page(){
        $this->notifications = Notification::whereUserId(auth()->user()->id)->where("view",0)->get();
        Notification::whereUserId(auth()->user()->id)->where("view",0)->increment("view",1);
    }
}
