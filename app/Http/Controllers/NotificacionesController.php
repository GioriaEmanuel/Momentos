<?php

namespace App\Http\Controllers;

use App\Models\Notificaciones;
use App\Models\User;
use Illuminate\Http\Request;

class NotificacionesController extends Controller
{
    //

    public function index(User $user){


        return view('notificaciones.index',[

            'user' => $user,
        ]

    );
    }
    public function show(){

    }
    public function store(){

    }
    public function delete(){

    }

}
