@extends('app')

@section('titulo')
<div class=" -mt-20 ">

    <div class=" hero_2 h-full w-full flex items-center p-20 justify-center" >
        <h1 class="titulo_hero font-serif text-5xl"><span class="m_titulo text-titulos text-6xl">M</span>omentos
        </h1>
    </div>
</div>
@endsection


@section('contenido')

    <h3 class="text-center text-2xl my-10 text-titulos titulo_hero">Ultimos posts de tus amigos</h3>
    <div class="container mx-auto  gap-6 p-10 justify-center grid grid-cols-1 lg:grid-cols-3">
        
        {{-- Componente ListarPosts se encarga de mostrar el contenido de los posts de los usuarios en la main page --}}
        <x-ListarPosts :usuarios="$posts"/>

    </div>

    <div class="container mx-auto  gap-6 p-10 justify-center grid grid-cols-1 lg:grid-cols-3">
        
        {{-- Componente ListarPosts se encarga de mostrar el contenido de los posts de los usuarios en la main page --}}
        <x-ListarPosts :usuarios="$posts_no_seguidos"/>

    </div>

    
        
@endsection
