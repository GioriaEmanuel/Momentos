<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    //Este controlador se encarga de cerrar la sesion

    public function store(){
        
        auth()->logout();

        return redirect()->route('login');
    }
}
