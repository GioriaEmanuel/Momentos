<?php

namespace App\Livewire;

use App\Events\MensajeEnviado;
use App\Models\Chat;
use Livewire\Component;

class IngresarMensaje extends Component
{

    public $emisor;
    public $receptor;

    public $mensaje;

    

    public function mount($emisor, $receptor){

        $this->emisor = $emisor;
        $this->receptor = $receptor;


    }

    public function AlmacenarMensaje(){

        $mensajeGuardado = Chat::create([
            'mensaje' => $this->mensaje,
            'user_id' => $this->emisor->id,
            'receptor_id' => $this->receptor->id,
        ]);

        $this->dispatch('nuevoMensaje');
        $this->reset('mensaje');
        broadcast(new MensajeEnviado($mensajeGuardado));

    }


    public function render()
    {
        return view('livewire.ingresar-mensaje');
    }
}
