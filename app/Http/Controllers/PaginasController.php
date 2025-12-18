<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaginasController extends Controller
{
    //

    public function index()
    {

        $user = auth()->user();

        if (auth()->user()) {
            //obtengo los seguidos por el ususario autenticado, por las dudas, todavaia no se si es necesario
            $usuarios = User::find(auth()->user()->id)->seguidos()->get();
           
            //relacion con usuarios no seguidos
            $usuarios_no_seguidos = User::find(auth()->user()->id)->no_seguidos()->get();
           
            // Obtener los IDs de los usuarios a los que sigue el usuario autenticado
            $seguidos_id = $user->seguidos()->pluck('users.id')->toArray();
            // Obtener los IDs de los usuarios que no sigue el usuario autenticado
            $no_seguidos_id = $user->no_seguidos()->pluck('users.id')->toArray();
            
            // Obtener los posts de estos usuarios, ordenados por fecha de creación descendente
            $posts = Post::whereIn('user_id', $seguidos_id)
            ->has('user')//ME ASEGURO QUE EL USUARIO EXISTA
            ->latest()
            ->with('user.seguidores')
            ->get(); // Pagina los resultados (ej. 10 posts por página)
            
            // Obtener los posts de estos usuarios no seguidos, ordenados por fecha de creación descendente
            $posts_no_seguidos = Post::whereIn('user_id', $no_seguidos_id)
            ->has('user')//ME ASEGURO QUE EL USUARIO EXISTA
            ->latest()
            ->with('user.seguidores')
            ->get(); // Pagina los resultados (ej. 10 posts por página)
            
            
        } else {
            //sino esta logueado obtengo todos
            $posts = Post::inRandomOrder()->get();
            $posts_no_seguidos = [];
            $usuarios = User::all();
            $usuarios_no_seguidos = [];
            
        }
        



        return view('templates.inicio', [
            'usuarios' => $usuarios,
            'usuarios_no_seguidos' => $usuarios_no_seguidos,
            'posts' => $posts,
            'posts_no_seguidos' => $posts_no_seguidos,
        ]);
    }

    public function buscar()
    {

        $users = User::all();
        //en caso de querer usar los usuarios desde el controlador del endpoint, en este caso los recupero con el componente de livewire

        return view('templates.buscar');
    }
}
