@extends('app')

@section('titulo')

    {{$user->name;}}

@endsection

@section('contenido')
<div class="grid lg:grid-cols-[10%_80%_10%] p-4">
    @auth
        
   
    <div id="aside-left" class="bg-fondosecundario rounded shadow-lg w-[95%] mx-auto shadow-black py-12 px-2 flex  lg:flex-col gap-4 items-center overflow-x-auto lg:overflow-y-auto max-h-11 lg:max-h-screen no-scrollbar">
        <h4 class="titulo_hero mb-4">Seguidos</h4>
        @foreach ($user->seguidos as $seguido)
        <a href="{{route('posts.muro', $seguido)}}">
            <div class="text-center">
                <img class="w-16 max-w-none h-16 object-cover rounded-full" src="{{asset('perfiles/'. $seguido->imagen)}}" alt="">
                <p class="text-white font-thin text-xs">{{$seguido->name}}</p>
            </div>
        </a> 
        @endforeach
       
       
       
        
        @endauth
    </div>

    <div id="center" class="w-full pt-20">

        <div class="container mx-auto lg:flex justify-center my-8 gap-5 px-12 ">
           
                <div class=" w-8/12 lg:w-6/12 mx-auto">
                    <div class="box_border_animated__rounded m-auto">
                        <img class=" md:w-80 md:h-80 w-60 h-60 rounded-full object-cover mx-auto border-titulos border-2 shadow-lg shadow-black" src="{{ $user->imagen ? asset('perfiles/' . $user->imagen) : asset('img/foto-perfil-generica.jpg') }}"
                        alt="usuario">
                    </div>
                </div>
            
            <div class="w-12/12  lg:w-11/12 mx-5 lg:block lg:mx-auto md:my-12">
    
                <div class=" text-center lg:text-start ">
                    
                    {{-- Seccion info usuario --}}
                    <div class="grid grid-cols-3 lg:flex  gap-6  ">

                        <div class="text-center">
                            <p class=" mt-4 text-titulos font-bold">{{ $user->posts->count() }}</p>
                            <p class=" text-titulos">Posts</p> 
                        </div>
    
                        <a  class=" flex flex-col text-center" href="{{ route('usuarios.seguidores', $user) }}">
                            <p class=" mt-4 text-titulos font-bold"> {{ $user->seguidores->count() }}</p>
                            <p class=" text-titulos"> @choice('Seguidor|Seguidores', $user->seguidores->count())</p>
                        </a>
    
                        <a class="text-center" href="{{ route('usuarios.seguidos', $user) }}">
                            <p class=" mt-4 text-titulos font-bold">{{ $user->seguidos->count() }}</p>
                            <p class=" text-titulos">Seguidos</p> 
                        </a>
        
                    </div>
                    @auth
                        @if ($user->id != auth()->user()->id)
                            @if (!$user->siguiendo())
                                <form action="{{ route('usuarios.seguir', $user) }}" method="POST">
                                    @csrf
    
                                    <input class="my-5 p-2 bg-fondosecundario text-white uppercase rounded cursor-pointer" type="submit"
                                        value="seguir">
                                </form>
                            @else
                                <form action="{{ route('usuarios.no_seguir', $user) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input class="my-5 p-2 bg-fondosecundario text-white uppercase rounded cursor-pointer" type="submit"
                                        value=" dejar de seguir">
                                </form>
                            @endif

                            
                            <div class=" flex  items-center">
                            @if ($amigos)
                                <p class=" text-xs text-gray-600 mr-2">{{ $user->username }} tambien sigue a...</p>
    
                                    @foreach ($amigos as $amigo)
                                    <div class="group/item relative">
                                        <a href="{{route('posts.muro', $amigo)}}"><img class="  -mr-1 rounded-full border-gray-500 w-6 h-5"
                                            src="{{ asset('perfiles/' . $amigo->imagen) }}" alt="imagen usuario">
                                        </a>
                                        <p class=" absolute top-4 left-2 group/edit invisible text-gray-500 text-xs p-1 group-hover/item:visible bg-white rounded-md border-zinc-700">{{$amigo->name}}</p>
                                    </div>
                            
                                    @endforeach

                                    @else
                                    <div class=" flex  items-center">
                                        <p class=" text-xs text-gray-600 mr-2">Sin amigos en comun</p>
                                    </div>

                                @endif
    
                            </div>
                        @endif
                    @endauth
    
    
                </div>
            </div>
    
        </div>
    
        <section class=" w-11/12 bg-fondosecundario shadow-md p-4 mt-12 mx-auto rounded-md">
    

    
            @if (!$posts->count())
                <h3 class="text-titulos uppercase">Todavia no hay posts</h3>
            @endif
    
            <div class=" grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-3">
    
                @foreach ($posts as $post)
                    <div class="p-2 border border-titulos mh-20">
                        <picture>
                            <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}">
                                <img class="hover:cursor-pointer h-full object-cover" src="{{ asset('uploads/' . $post->imagen) }}"
                                    alt="Imagen_post">
    
                            </a>
                        </picture>
                    </div>
                @endforeach
    
                
    
            </div>
    
            <div>
                {{ $posts->links('pagination::bootstrap-4') }}
            </div>
    
        </section>
    </div>


    @auth
    <div id="aside-rigth" class="bg-fondosecundario rounded shadow-lg shadow-black lg:pt-12 px-2 flex flex-col lg:flex-col gap-4 items-center justify-evenly lg:justify-start lg:max-h-screen no-scrollbar mt-8 lg:m-0 p-4 lg:p-0 w-[95%] mx-auto">
        <h4 class="titulo_hero mb-4 ">Opciones</h4>
        <a class=" flex ml-2 uppercase hover:cursor-pointer text-white text-xs hover:text-titulos transition-all" href="{{route('posts.create')}}">Nuevo Post <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="ml-2 size-4">
            <path strokeLinecap="round" strokeLinejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
    </a>

    <a class=" flex ml-2 uppercase hover:cursor-pointer text-white text-xs hover:text-titulos transition-all" href="/buscar">Buscar <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="ml-2 size-4">
        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
      </svg>
      </a>
      
    <a class=" flex ml-2 uppercase hover:cursor-pointer text-white text-xs hover:text-titulos transition-all" href="{{route('config.editar', auth()->user())}}">Ajustes <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="ml-2 size-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75a4.5 4.5 0 0 1-4.884 4.484c-1.076-.091-2.264.071-2.95.904l-7.152 8.684a2.548 2.548 0 1 1-3.586-3.586l8.684-7.152c.833-.686.995-1.874.904-2.95a4.5 4.5 0 0 1 6.336-4.486l-3.276 3.276a3.004 3.004 0 0 0 2.25 2.25l3.276-3.276c.256.565.398 1.192.398 1.852Z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.867 19.125h.008v.008h-.008v-.008Z" />
          </svg>
          </a>
          <a class=" flex ml-2 uppercase hover:cursor-pointer text-white text-xs hover:text-titulos transition-all" href="{{route('notificaciones.index', auth()->user())}}">notificaciones<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
            </svg>
            
            </a>
            <a class="  flex ml-2 uppercase hover:cursor-pointer text-white text-xs hover:text-titulos transition-all" href="{{route('chat.index', auth()->user())}}">Mensajes <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="ml-2 size-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
              </svg>
              </a>
    @endauth
    </div>
</div>
@endsection
