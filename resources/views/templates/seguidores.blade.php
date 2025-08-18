@extends('app')



@section('titulo')
Seguidores de {{$user->username}}
 
@endsection

@section('contenido')
    {{-- Muestra la data de los seguidores de un usuario --}}

    <div class="container mx-auto flex flex-col gap-6 p-10">
        @foreach ($seguidores as $seguidor)
            <div class=" flex justify-start">
                <div class=" w-full flex justify-start items-center gap-4" >
                    <img class=" object-cover rounded-full w-24 h-24 object-center" src="{{asset('perfiles/'.$seguidor->imagen)}}" alt="imagen_perfil">
                    <a class="font-bold capitalize text-titulos" href="{{ route('posts.muro', $seguidor->username) }}">{{ $seguidor->username }}</a>

                    {{-- Eliminar seguidor --}}
                       <form action="{{ route('usuarios.no_seguir', ['user' => $seguidor->id, 'eliminarSeguidor' => 'eliminar']) }}" method="POST">
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
