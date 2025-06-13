@extends('app')

@section('titulo')
<div class=" -mt-20 ">

    <div class="h-full w-full flex items-center pt-32 justify-center titulo_hero text-2xl" >
        Encuentra nuevos amigos
    </div>
</div>
@endsection


@section('contenido')
    <div class="container mx-auto  gap-6 p-10 justify-center flex">
        
        {{-- Componente ListarPosts se encarga de mostrar el contenido de los posts de los usuarios en la main page --}}
        @livewire('buscador-usuarios')

    </div>

    
        
@endsection