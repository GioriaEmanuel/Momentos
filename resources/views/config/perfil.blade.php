@extends('app')



@section('titulo')
    Edicion de perfil
@endsection

@section('contenido')
    {{-- Formulario y carga de foto de perfil --}}

    <div class="container w-10/12 mx-auto my-10 ">


        {{-- formulario --}}
        <div>
            <form action="{{ route('config.store', $user) }}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="my-5">
                    <label for="username" class="mb-2 block uppercase text-titulos font-bold">Username</label>
                    <input
                        class=" w-full rounded p-3 bg-fondosecundario
                        @error('username')
                            border-red-400 border-solid border-2
                        @enderror"
                        type="text" name="username" id="username" placeholder="{{ $user->username }}"
                        value='{{ $user->username }}'>
                </div>

                @error('username')
                    <p class=" text-white bg-red-400 p-2 font-bold rounded">{{ $message }}</p>
                @enderror

                <div class="my-5">
                    <label for="email" class="mb-2 block uppercase text-titulos font-bold">Email</label>
                    <input
                        class=" w-full rounded p-3  bg-fondosecundario
                        @error('email')
                            border-red-400 border-solid border-2
                        @enderror"
                        type="text" name="email" id="email" placeholder="{{ $user->email }}"
                        value="{{ $user->email }}"></input>
                </div>
                @error('email')
                    <p class=" text-white bg-red-400 p-2 font-bold rounded">{{ $message }}</p>
                @enderror

                <div class="my-5">
                    <label for="password" class="mb-2 block uppercase text-titulos font-bold">Password</label>
                    <input
                        class=" w-full rounded p-3  bg-fondosecundario
                        @error('password')
                            border-red-400 border-solid border-2
                        @enderror"
                        type="password" name="password" id="password" placeholder="">{{ old('password') }}</input>
                </div>
                @error('password')
                    <p class=" text-white bg-red-400 p-2 font-bold rounded">{{ $message }}</p>
                @enderror
                <div class="my-5">
                    <label for="password_verify"
                        class="mb-2 block uppercase text-titulos font-bold">Verificar Password</label>
                    <input
                        class=" w-full rounded p-3  bg-fondosecundario
                        @error('password_verify')
                            border-red-400 border-solid border-2
                        @enderror"
                        type="password" name="password_verify" id="password_verify"
                        placeholder="">{{ old('password_verify') }}</input>
                </div>
                @error('password_verify')
                    <p class=" text-white bg-red-400 p-2 font-bold rounded">{{ $message }}</p>
                @enderror
                
                @if (session('mensaje'))
                    <p class=" text-white bg-red-400 p-2 font-bold rounded">{{session('mensaje')}}</p>
                @endif

                {{-- //input imagen --}}
                <input type="file" name="imagen" value="{{ old('imagen') }}" id='imagen' class="  bg-fondosecundario p-10 w-full mb-5 rounded">

                {{-- //boton submit --}}
                <input type="submit" value="Actualizar datos"
                    class=" bg-fondosecundario p-3 rounded uppercase text-titulos font-bold w-full cursor-pointer  hover:bg-titulos hover:text-fondosecundario transition-colors duration-500">

                
            </form>
        </div>
    </div>
@endsection
