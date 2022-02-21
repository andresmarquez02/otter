<?php

namespace App\Http\Livewire;

use App\Historical as AppHistorical;
use Livewire\Component;

class Historical extends Component
{
    public function render()
    {
        $historical = AppHistorical::where("user_id_view",auth()->user()->id)->groupBy("post_id")->select("post_id")->get();
        return view('livewire.historical',["historical" => $historical]);
    }
}
