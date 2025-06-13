@extends('app')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('titulo')
    Crear Post
@endsection

@section('contenido')
    <div class=" md:flex md:items-center container justify-around mb-12 mx-auto p-8">

        <div class="md:w-6/12 w-full text-center p-4">
        
       
            <form action='{{route('posts.imagen')}}' method="POST" enctype="multipart/form-data" id="dropzone" class="dropzone border-4 text-titulos border-titulos bg-fondosecundario h-96 w-full flex items-center justify-center">
                @csrf
                
            </form>
            @error('imagen')
                    <p class=" text-white bg-red-400 p-2 font-bold rounded">{{ $message }}</p>
                @enderror
        
        </div>
        <div class=" md:w-6/12 w-full">
            <form action="{{route('post.store')}}" method="POST">

                @csrf

                <div class="my-5">
                    <label for="titulo" class="mb-2 block uppercase text-titulos font-bold">Título</label>
                    <input
                        class=" w-full rounded p-3 border-titulos bg-fondosecundario
                        @error('titulo')
                            border-solid border-2
                        @enderror"
                        type="text" name="titulo" id="titulo" placeholder="Título" value='{{ old('titulo') }}'>
                </div>

                @error('titulo')
                    <p class=" text-white bg-red-400 p-2 font-bold rounded">{{ $message }}</p>
                @enderror

                <div class="my-5">
                    <label for="description" class="mb-2 block uppercase text-titulos font-bold">Descripción</label>
                    <textarea
                        class=" w-full rounded p-3 border-titulos bg-fondosecundario
                        @error('description')
                            border-solid border-2
                        @enderror"
                        type="text" name="description" id="description" placeholder="Descripción" rows="10">{{ old('description') }}</textarea>
                </div>
                @error('description')
                    <p class=" text-white bg-red-400 p-2 font-bold rounded">{{ $message }}</p>
                @enderror

                <input type="submit" value="Crear Post"
                    class="bg-fondosecundario p-3 rounded uppercase text-titulos font-bold w-full cursor-pointer hover:bg-titulos hover:text-fondo transition-colors duration-500">

                <input type="hidden" name="imagen" value="{{old('imagen')}}" id='imagen'>
            </form>
        </div>
        
    </div>
@endsection
