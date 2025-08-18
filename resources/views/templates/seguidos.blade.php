@extends('app')



@section('titulo')
 Seguidos por {{$user->username}}
@endsection

@section('contenido')
    {{-- Muestra la data de los seguidores de un usuario --}}

    <div class="container mx-auto flex flex-col gap-6 p-10">
        @foreach ($seguidos as $seguido)
            <div class=" flex justify-start">
                <div class=" w-full flex justify-start items-center gap-4" >
                    <img class=" object-cover rounded-full w-24 h-24 object-center" src="{{asset('perfiles/'.$seguido->imagen)}}" alt="imagen_perfil">
                    <a class="font-bold capitalize text-titulos" href="{{ route('posts.muro', $seguido->username) }}">{{ $seguido->username }}</a>

                    {{-- Dejar de seguir --}}
                       <form action="{{ route('usuarios.no_seguir', $seguido->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input class="my-5 p-1 text-gray-600 uppercase rounded cursor-pointer" type="submit"
                                        value="X">
                        </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
