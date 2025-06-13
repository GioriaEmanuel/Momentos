<?php

namespace App\Http\Controllers;

use App\Models\Notificaciones;
use App\Models\Seguir;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;

class SeguirController extends Controller
{
    //

    public function store(Request $peti, User $user){


        $user->seguidores()->attach(auth()->user()->id);

        Notificaciones::create([
            'user_id' => $user->id,
            'user_de' => auth()->user()->id,
            'notificacion' => 'Te ha empezando a seguir',
            'leido' => false,
        ]);

        return back();
    }
    public function destroy(Request $peti, User $user){


        $user->seguidores()->detach(auth()->user()->id);

        return back();
    }
    public function show_seguidores(User $user){

        $seguidores = $user->seguidores()->get();

        

        return view('templates.seguidores' ,[
            'seguidores' => $seguidores,
            'user' => $user,
        ]);
    }
    public function show_seguidos(User $user){

        $seguidos = $user->seguidos()->get();

        

        return view('templates.seguidos' ,[
            'seguidos' => $seguidos,
            'user' => $user,
        ]);
    }
}
