<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public  function index() 
    {
        return view('auth/registro');
    }
    public  function store(Request $peti) //$peti es un objeto con contiene tanto la info de $_POST como otra informacion util de la peticion al endpoint
    {

        //rescribir el valor de un campo para validar antes de enviar a la BBDD
        //este se realiza para no repetir usernames, ya que pueden ser iguales pero con acentos o espacios diferentes,
        //y al convertirlos a url se llamarian igual, por eso lo convertimos a url previo a su validacion

        $peti->request->add([
            'username' => Str::slug($peti->username),
        ]);
        

        //validacion de Laravel
        $peti->validate([
            'name' => 'required',
            'username' => 'required|unique:users|min:3|max:30',
            'email' => 'required|unique:users|max:50|email',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);
        
        //Creacion del registro en la base de datos por medio del Model de User y Eloquent el ORM de Laravel

        $user = User::create([
            'name' => $peti->name,
            'username' => $peti->username,
            'email' => $peti->email,
            'password' => $peti->password
        ]);

        //autenticacion de usuarios// --Como insertar la info en $_SESSION pero con los helpers de laravel --

        auth()->attempt([
            'email' => $peti->email,
            'password' =>$peti->password
        ]);

        //Redireccion del usuario una vez creado el usuario

        return redirect()->route('posts.muro' , $user );

    }
}
