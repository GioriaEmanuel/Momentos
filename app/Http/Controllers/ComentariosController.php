<?php

namespace App\Http\Controllers;

use App\Models\Comentarios;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ComentariosController extends Controller
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
    public function store(Request $request , User $user , Post $post)
    {
        //Aca almacenamos los comentarios sobre los post

        //primero validamos
        $request->validate([
            'comentario' => 'required',
        ]);

        Comentarios::create([
            'comentario' => $request->comentario,
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
        ]);

        return back()->with('mensaje', 'Comentario agregado');

        //De momento se esta realizando desde el componente de livewire
    }

    /**
     * Display the specified resource.
     */
    public function show(Comentarios $comentarios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comentarios $comentarios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comentarios $comentarios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comentarios $comentarios)
    {
        //
    }
}
