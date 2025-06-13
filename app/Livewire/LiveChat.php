<?php

namespace App\Livewire;

use App\Models\Chat;
use Livewire\Component;

class LiveChat extends Component
{

    public $mensajes;
    public $emisor;
    public $receptor;
    public $receptorId;
    protected $listeners = ['nuevoMensaje' => 'upgrade'];

    public function mount($emisor, $receptor){

        $this->emisor = $emisor;
        $this->receptor = $receptor;
        $this->receptorId = $receptor->id;
        $this->mensajes = Chat::mensajes_entre_usuarios($emisor, $receptor);

    }

    public function upgrade(){
        $this->mensajes = Chat::mensajes_entre_usuarios($this->emisor, $this->receptor);
    }


    public function render()
    {
        return view('livewire.live-chat');
    }
}
