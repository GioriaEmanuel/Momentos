<?php

namespace App\Http\Controllers;

use App\Models\Likes;
use App\Models\Notificaciones;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, User $user, Post $post)
    {
        //

        Likes::create([
            
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
        ]);
        Notificaciones::create([

            'user_id' => $user->id,
            'user_de' => auth()->user()->id,
            'notificacion' => 'Tienes un nuevo me gusta',
            'leido' => false,
            'posts_id' => $post->id,
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Likes $likes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Likes $likes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Likes $likes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $peti ,Post $post)
    {
        //
        $like = Likes::where([
            ['user_id','=', auth()->user()->id],
            ['post_id','=', $post->id],

        ])->limit(1)->get();

        //otra forma de hacerlo es crear una relacion en User que se traiga todos los likes y luego filtrar

        //obtener el usuario por el request
        //$peti->user->likes->where('post_id' , $post->id)->delete();
        //de esta forma me traigo todo los likes del usuario autenticado y filtro con el where el del post que esta pasado como parametro
        //y acto siguiente elimino con delete
        
        $peti->user()->likes()->where('post_id', $post->id)->delete();
        
 
        
        // $like[0]->delete();

        return back();
    }
}
