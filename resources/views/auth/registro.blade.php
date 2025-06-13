@extends('app')

@section('titulo')



@endsection

@section('contenido')

 <div class="md:grid grid-cols-2  gap-5 h-screen md:-mt-20">
    <div class="md:w-full flex items-center justify-center "
    style="background-image: url('{{asset('img/registrar.jpg')}}'); background-position: center center; background-size:cover; filter: sepia(0.4px);">
       
    </div>
    
    <div class="md:w-full px-5 pt-20">
        <form action="" method="POST">
            @csrf
            <div class="my-5">
                <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">Nombre</label>
                <input class=" w-full rounded p-3 
                @error('name')
                    border-red-400 border-solid border-2
                @enderror" type="text" name="name" id="name" placeholder="Tu Nombre" value='{{old('name')}}'>
            </div>
            @error('name')
                <p class=" text-white bg-red-400 p-2 font-bold rounded">{{$message}}</p>
            @enderror
            <div class="my-5">
                <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Username</label>
                <input class="w-full rounded p-3   @error('username')
                    border-red-400 border-solid border-2
                @enderror" type="text" name="username" id="username" placeholder="Username" value='{{old('username')}}'>
            </div>
            @error('username')
            <p class=" text-white bg-red-400 p-2 font-bold rounded">{{$message}}</p>
        @enderror
            <div class="my-5">
                <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">email</label>
                <input class="w-full rounded p-3   @error('email')
                    border-red-400 border-solid border-2
                @enderror" type="text" name="email" id="email" placeholder="Tu email" value='{{old('email')}}'>
            </div>
            @error('email')
            <p class=" text-white bg-red-400 p-2 font-bold rounded">{{$message}}</p>
        @enderror
            <div class="my-5">
                <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Password</label>
                <input class="w-full rounded p-3   @error('password')
                    border-red-400 border-solid border-2
                @enderror" type="password" name="password" id="password" placeholder="Password">
            </div>
            @error('password')
            <p class=" text-white bg-red-400 p-2 font-bold rounded">{{$message}}</p>
        @enderror
            <div class="my-5">
                <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">Confirma tu password</label>
                <input class="w-full rounded p-3   @error('password_confirmation')
                    border-red-400 border-solid border-2
                @enderror" type="password" name="password_confirmation" id="password_confirmation" placeholder="Password">
            </div>
            @error('password_confirmation')
            <p class=" text-white bg-red-400 p-2 font-bold rounded">{{$message}}</p>
        @enderror
            <input type="submit" value="Crear Cuenta" class="bg-sky-500 p-3 rounded uppercase text-white font-bold w-full cursor-pointer hover:bg-sky-700 transition-colors duration-500">
           
        </form>
    </div>
    
 </div>


@endsection