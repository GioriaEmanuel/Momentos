@extends('app')

@section('titulo')
<div class="m-0"></div>
@endsection

@section('contenido')
    <div class="md:grid grid-cols-2  gap-5 h-screen md:-mt-20">
        <div class="md:w-full flex items-center justify-center"
        style="background-image: url('{{asset('img/registrar.jpg')}}'); background-position: center center; background-size:cover; filter: sepia(0.4px);">
            
        </div>

        <div class="md:w-full px-5 pt-20  flex">
            {{-- novalidate es un atributo que previene la validacion de html del formulario al darle subbmit --}}
            <form method="POST" novalidate class="w-full flex flex-col">

                {{-- //helper de blade para evitra ataques CSRF - una vez por form --}}
                @csrf

                {{-- Muestra del mensaje enviado con el back() en caso de fallo de credenciales
                    para acceder a la info enviada por el controlador desde la vista lo hacemos por medio del helper
                    session() --}}

                @if (session('mensaje'))
                    
                <p class=" text-white bg-red-400 p-2 font-bold rounded">{{ session('mensaje') }}</p>

                @endif
                <div class="my-5 w-full">
                    <label for="email" class="mb-1 block uppercase text-gray-500 font-bold">email</label>
                    <input
                        class="w-full rounded p-3   @error('email')
                    border-red-400 border-solid border-2
                @enderror"
                        type="text" name="email" id="email" placeholder="Tu email" value='{{ old('email') }}'>
                </div>
                @error('email')
                    <p class=" text-white bg-red-400 p-2 font-bold rounded">{{ $message }}</p>
                @enderror

                <div class="my-5 w-full">
                    <label for="password" class="mb-1 block uppercase text-gray-500 font-bold">Password</label>
                    <input
                        class="w-full rounded p-3   @error('password')
                    border-red-400 border-solid border-2
                @enderror"
                        type="password" name="password" id="password" placeholder="Password">
                </div>
                @error('password')
                    <p class=" text-white bg-red-400 p-2 font-bold rounded">{{ $message }}</p>
                @enderror

                <div class="my-5">
                    <input type="checkbox" name="remember"><label for="remember" class="mx-1 text-gray-600">Recuerdame</label>
                </div>
                <input type="submit" value="Iniciar seción"
                    class="bg-sky-500 p-3 rounded uppercase text-white font-bold w-full cursor-pointer hover:bg-sky-700 transition-colors duration-500">

            </form>
        </div>

    </div>
@endsection
