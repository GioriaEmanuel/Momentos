<?php

namespace App\Livewire;

use Livewire\Component;

class Likers extends Component
{

    public $likers = [];
    public $likes;
    protected $listeners = ['upgradeLikers' => 'upgrade'];
    public $post; // Asegúrate de tener la instancia del Post disponible
    
    public function mount($post){
        $this->post = $post;
        $this->loadLikers();
    }
    
    public function upgrade(){
        $this->loadLikers();
    }
    
    private function loadLikers(){
        $this->likers = [];
        $this->likes = $this->post->likes; // Recarga los likes desde la relación del post
        foreach($this->likes as $like){
            $this->likers [] = $like->user;
        }
    }
    
    public function render()
    {
        return view('livewire.likers');
    }
}
