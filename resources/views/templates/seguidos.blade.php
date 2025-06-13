@extends('app')



@section('titulo')
 Seguidos por {{$user->username}}
@endsection

@section('contenido')
    {{-- Muestra la data de los seguidores de un usuario --}}

    <div class="container mx-auto flex gap-6 p-10 justify-center md:flex-row flex-col">
        @foreach ($seguidos as $seguido)
            <div class=" border-2 rounded p-5 bg-white md:w-1/4">
                <div class="" >
                    <img class=" object-cover h-60 md:h-48 w-96 object-center" src="{{asset('perfiles/'.$seguido->imagen)}}" alt="imagen_perfil">
                </div>
                
                <a class="font-bold uppercase" href="{{ route('posts.muro', $seguido->username) }}">{{ $seguido->username }}</a>
            </div>
        @endforeach
    </div>
@endsection
