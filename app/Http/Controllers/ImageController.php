<?php

namespace App\Http\Controllers;

use Illuminate\Database\Capsule\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;


class ImageController extends Controller
{
    //

    public function store(Request $peti){

        //Creo una variable que alamacene la informacion de la imagen cargada, que esta dentro de la peticion->file
        //esta informacion es la que se almacena un tiempo en cache como lo hace la superglobal $_FILES

        $imagen = $peti->file('file');
        
        //Instancio el manager de intervention, que es la nueva forma en la que trabaja
        $manager = new ImageManager(new Driver);

        //Creo un nombre unico en el helper de laravel STR
        $nombre_imagen = Str::uuid().'.'.$imagen->extension();

        //creo la imagen que se va a guardar con intervention image por medio del manager
        $imagenServidor = $manager->read($imagen);

        //nuevo fit(), ahora es scale() en intervention 3.0 para la modificacion del tamaño de la imagen
        $imagenServidor->scale(1000,1000);

        //creacion de ruta hacia donde se va a guardar la imagen, public_paths apunta a una carpeta dentro de public, si no existe la crea
        $imagenPath = public_path('uploads').'/'.$nombre_imagen;

        //alamcenamos la imagen en la ruta creada
        $imagenServidor->save($imagenPath);

        return response()->json($nombre_imagen);
    }
}
