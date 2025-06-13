<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ConfiguracionController extends Controller
{
    //

    public static function index(User $user){

        if($user->id !== auth()->user()->id){

            return back();
        }


        return view('config.perfil',[
            'user' => $user,
        ]);
    }

    public static function store(Request $peti , User $user){

        //convercion de usernames a endpoints, obviando caracteres especiales
        $peti->request->add([
            'username' => Str::slug($peti->username),
        ]);
        
         //validacion de Laravel
          $peti->validate([
            'username' => [
                'required', 
                // "unique:users,username,{auth()->user()->username}", //De este modo ignoramos el campo repetido con la base de datos que sea unique
                Rule::unique('users', 'username')->ignore(auth()->user()),
                'min:3', 
                'max:20', 
                'not_in:twitter,editar-perfil'
            ],
            'email' => [
                'required',
                Rule::unique('users', 'email')->ignore(auth()->user()),
                'email'
            ]
        ]);

        $user->username = $peti->username;

        //si la actualizacion sube imagenes voy a crear la imagen desde aca nomas
        if($peti->imagen){

        $imagen = $peti->imagen;
        
        //Instancio el manager de intervention, que es la nueva forma en la que trabaja
        $manager = new ImageManager(new Driver);

        //Creo un nombre unico en el helper de laravel STR
        $nombre_imagen = Str::uuid().'.'.$imagen->extension();

        //creo la imagen que se va a guardar con intervention image por medio del manager
        $imagenServidor = $manager->read($imagen);

        //nuevo fit(), ahora es scale() en intervention 3.0 para la modificacion del tamaño de la imagen
        $imagenServidor->scale(1000,1000);

        //creacion de ruta hacia donde se va a guardar la imagen, public_paths apunta a una carpeta dentro de public, si no existe la crea
        $imagenPath = public_path('perfiles').'/'.$nombre_imagen;

        //alamcenamos la imagen en la ruta creada
        $imagenServidor->save($imagenPath);

        $user->imagen = $nombre_imagen;
        }

        //verificacion y actualizacion de password

        if($peti->password){

            $peti->validate([
                'password' => 'required|min:8',
                'password_verify' => 'required',
            ]);

            if(Hash::check($peti->password_verify, $user->password)){
               $user->password = $peti->password;
            }else{
                return back()->with('mensaje', 'Error : El password de verificacion es incorrecto, asegurese de introducir su passwod anterior');
            }
        }


        $user->save();


       return redirect('/'.$user->username);


    }
}
