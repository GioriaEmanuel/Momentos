<?php

namespace App\Livewire;

use Livewire\Component;

class MostrarComentarios extends Component
{

    public $post;


    protected $listeners = ['upgradeComentarios'];

    public function mount($post){

        $this->post = $post;
    }

    
    public function render()
    {
        return view('livewire.mostrar-comentarios');
    }
}
