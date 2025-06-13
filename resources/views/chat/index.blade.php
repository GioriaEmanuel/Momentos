@extends('app')

@section('titulo')

<div class=" -mt-20 ">

    <div class="h-full w-full flex items-center py-20 justify-center titulo_hero text-2xl" >
        Chatea con tus amigos
    </div>
</div>
    <form action="" class=" max-w-80 text-center m-auto">
        @csrf
        <input type="text" name="buscar_chat" id="buscar_chat" placeholder="Buscar chat"
            class="px-3 rounded-lg h-10 text-sm w-full bg-black">
    </form>
@endsection

@section('contenido')

    <section class="container_chats container m-auto w-10/12" id="chats">
        
        <x-listar-mensajes :chats="$chats"/>
       
    </section>


@endsection
