@extends('app')

@section('titulo')

{{$receptor->name}}

@endsection

@section('contenido')

<section id="ventana_chat" class="h-full ">

    <div id="contenedor_chat" class="  max-h-[650px] overflow-auto no-scrollbar py-3 bg-fondosecundario md:w-8/12 m-auto rounded-md flex flex-col justify-between">

        {{-- //que el componente se encarge de recuperar todos los mensajes --}}
        {{-- input de mensaje, cargar emojis, usar metodos de comentarios --}}

        {{-- primero el componenete que muestra los comentarios --}}
        @livewire('live-chat', ['emisor' => $emisor, 'receptor' => $receptor])



        
    </div>
    {{-- segundo el que los alamacena --}}
    @livewire('ingresar-mensaje', ['emisor' => $emisor, 'receptor' => $receptor])


</section>


    

@endsection