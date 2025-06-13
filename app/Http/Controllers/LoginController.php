<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    //

    public  function index() //index por defecto siempre es la pag principal que muestra la vista
    {
        
        return view('auth/login');
    }
    public  function store(Request $peti) //store es la pag que se encarga del post y el manejo de la info enviada
    {

        //Validamos la info enviada en el post
        $peti->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //Validamos las credenciales con la base de datos

        //el modelo auth se va a encargar por medio del attempt de buscar y comparar las credenciales pasadas
        //con las de la base de datos
        if(!auth()->attempt([
            'email'=>$peti->email,
            'password' =>$peti->password
        ],
        $peti->remember)){

            //si las credenciales no coinciden, retorno al usuario a la pagina anterior con back, junto con el mensaje que sera
            //mostrado por la vista, si no lo retorno esta funcion solo lee datos, no tiene vista, por ende quedaria en la nada
            //este mensaje se alamacen en una especie de superglobal llamada session();
            return back()->with('mensaje','Credenciales Incorrectas');
        }

        //si las credenciales son correctas lo redirijo hacia su muro
        
        return redirect('/'.auth()->user()->username);
   
    }

    
}
