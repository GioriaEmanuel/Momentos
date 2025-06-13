@extends('app')



@section('titulo')
Seguidores de {{$user->username}}
 
@endsection

@section('contenido')
    {{-- Muestra la data de los seguidores de un usuario --}}

    <div class="container mx-auto md:flex gap-6 p-10 justify-center md:flex-row grid grid-cols-1 sm:grid-cols-2">
        @foreach ($seguidores as $seguidor)
            <div class=" border-2 rounded p-5 bg-white md:w-1/4">
                <div class="" >
                    <img class=" object-cover h-60 md:h-48 w-96 object-center" src="{{asset('perfiles/'.$seguidor->imagen)}}" alt="imagen_perfil">
                </div>
                
                <a class="font-bold uppercase" href="{{ route('posts.muro', $seguidor->username) }}">{{ $seguidor->username }}</a>
            </div>
        @endforeach
    </div>
@endsection
