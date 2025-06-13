@extends('app')



@section('titulo')
@endsection

@section('contenido')
    {{-- Muestra del post --}}
    <div class="container grid grid-cols-1 md:grid-cols-2 w-10/12 p-5 m-auto my-12 gap-8">
        {{-- Imagen comentarios y likes --}}
        <div class="">
            <img class=" max-h-96 w-full object-cover" src="{{ asset('uploads/' . $post->imagen) }}" alt="">
            {{-- Titulo , descripcion y formulario de comentario --}}
            <div class=" text-titulos mt-4 ">
                <p class=" font-bold">{{ $post->titulo }}</p>
                <p>{{ $post->descripcion }}</p>

            </div>
            {{-- @auth y @endauth condicionan la muestra de un segmento de codigo a usuarios autenticados. --}}

            @auth

                <div class="flex gap-4 my-4">
                    {{-- Seccion de dar likes --}}
                    {{-- Componente de livewire que se va a encargar de los likes --}}
                    <livewire:Like-post :post="$post" :user="$user" />
                </div>

                @if (auth()->user()->id == $user->id)
                    <form action="{{ route('posts.destroy', $post) }}" method="POST">
                        @method('DELETE')
                        @csrf

                        <input class=" hover:cursor-pointer bg-titulos text-black px-2 py-1 font-bold rounded" type="submit" value="Eliminar Post">
                    </form>
                @endif

            @endauth

        </div>


        <div>

            <livewire:comentarios-post :post="$post" :user="$user" />

        </div>


        {{--  Muestra de todos los comentarios del post --}}

            <livewire:mostrar-comentarios :post="$post" />
        
    </div>

    @auth
    @if ($post->user_id == auth()->user()->id)
    <div class="modal hidden">
        {{-- metodo de livewire para llamar a componenetes -otro metodo- --}}
        <@livewire('likers', ['post' => $post])

    </div>
        
    @endif
    @endauth
    
@endsection
