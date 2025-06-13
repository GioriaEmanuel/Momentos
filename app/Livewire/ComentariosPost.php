<?php

namespace App\Livewire;

use App\Models\Comentarios;
use Illuminate\Console\Scheduling\Event;
use Livewire\Component;

class ComentariosPost extends Component
{
    public $post;
    public $user;
    public $comentario;

    protected $listeners = ['actualizarComentario' => 'actualizarComentario'];
    
    
    protected $rules = [
        'comentario' => 'required',
    ];

  


  

   public function AlmacenarComentario(){
  
        Comentarios::create([
            'comentario' => $this->comentario ,
            'user_id' => auth()->user()->id,
            'post_id' => $this->post->id,
        ]);

        
        $this->dispatch('upgradeComentarios');
        $this->reset('comentario');
        return back()->with('mensaje', 'Comentario agregado');

   }

  


    public function render()
    {
        return view('livewire.comentarios-post');
    }
}
