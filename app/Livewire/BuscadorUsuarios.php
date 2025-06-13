<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class BuscadorUsuarios extends Component
{
    
    public $users;
    public $nombre;


    public function mount(){

        $this->users = User::all();
    }

    public function updatedNombre()
    {
        
        if (empty($this->nombre)) {
            $this->users = User::all(); // si no hay nombre ingresado me traigo todos los usuarios
        } else {
            $this->users = User::where('name', 'like', '%' . $this->nombre . '%')->get();
        }
    }

    
    public function render()
    {
        return view('livewire.buscador-usuarios');
    }
}
