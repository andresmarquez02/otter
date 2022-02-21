<?php

namespace App\Http\Livewire;

use App\Custom\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Events\SendEmail as EventEmail;

class Login extends Component
{
    public $email = "";
    public $password = "";

    public function render()
    {
        return view('livewire.login');
    }

    public function login(){
        $this->validate([
            "email" => "required|email|exists:users,email",
            "password" => "required"
        ]);
        if(Auth::attempt(['email' => $this->email, 'password' => $this->password])){
            $datos = ['id' => Auth::user()->id, 'email' => Auth::user()->email,'name' => Auth::user()->name, 'view' =>'emails/notification'];
            if(Auth::user()->status == 1){
                return redirect()->to('home');
            }
            else{
                session()->flush();
                Auth::logout();
                $this->dispatchBrowserEvent('error', ['error' => "Tu cuenta fue bloqueada por postear cosas indevidas"]);
            }
        }
        else
            $this->dispatchBrowserEvent('error', ['error' => "No se pudo validar la cuenta"]);
    }
}
