<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $error, $password, $email;

    public function attempt(){
        // Validate the user's input
        $credentials = [
            'email'=>$this->email,
            'password'=>$this->password,
        ];

        if (Auth::attempt($credentials)) {
            return redirect('/home');
        }else{
            $this->error = 'Las credenciales no coinciden con nuestros registros';
        }

    }
    public function render()
    {
        return view('livewire.login');
    }
}
