<?php

namespace App\Livewire;

use App\Models\Likes;
use App\Models\Notificaciones;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class LikePost extends Component
{
    //esta verga no tiene constructos, por ende las variables que definamos van a tomar el valor que le pasemos 
    //en la etiqueta al momento de invocarlas <livewire:likes :post="$post"/>

    public $post;
    public $user;
    public $likes;
    //$isLiked es nuestro booleano encargado de registrar si el usuario dio like o no y darle color al icono en pantalla
    public $isLiked;

    //Livewire utiliza como un construc la funcion mount (montar), esta se ejecuta automaticamente cuando instanciamos
    //el componente en la vista, por medio de esta podemos asignar valores de inicio a los atributos la primera vez que llamamos al componente

    public function mount($post , $user){

        $this->isLiked = $post->liked();
        $this->likes = $post->likes->count();
        $this->user = $user;
        
        
    }

    public function like(){

        if($this->post->liked()){

            $this->post->likes()->where('post_id', $this->post->id)->delete();
            $this->isLiked = false;
            $this->likes -= 1;

            Notificaciones::create([
                
                'user_de' => auth()->user()->id,
                'user_id' => $this->user->id,
                'notificacion' => 'Ha quitado el me gusta',
                'posts_id' => $this->post->id,
                'leido' => false,
            ]);
            
        }else{
            Likes::create([
            
                'user_id' => auth()->user()->id,
                'post_id' => $this->post->id,
            ]);
            $this->isLiked = true;
            $this->likes += 1;


            Notificaciones::create([
                
                'user_de' => auth()->user()->id,
                'user_id' => $this->user->id,
                'notificacion' => 'Tienes un nuevo me gusta',
                'posts_id' => $this->post->id,
                'leido' => false,
            ]);


            
        }
    }

    public function render()
    {
        //aca se renderiza la vista deo post y automaticamente se pasan a esa vista todas la variables o atributos
        //pertenecientes y definidos en la clase
        return view('livewire.like-post');
    }
}
