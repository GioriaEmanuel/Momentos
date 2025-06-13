<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListarPosts extends Component
{
 
    //instancio la informacion que va a manejar el componente
     public $usuarios;

    public function __construct($usuarios)
    {
        //el constructor se ejecuta automaticamente cuando llamo al componenete en la vista <x-ListarPost> y absorve la variable usuario
        //de lo que le pase al llamarla <x-ListarPosts :usuarios="$usuarios"/> : ese $usuarios es el que el controlador de la vista le preporciona
        $this->usuarios = $usuarios;


    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ListarPosts');
    }
}
