<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+RO:wght@100..400&display=swap" rel="stylesheet">
    @stack('styles')
    <title>Momentos</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    {{-- livewire estilos --}}
    @livewireStyles

</head>

<body class=" bg-fondo">

    <header class="px-5 py-4  bg-fondosecundario shadow">
        <div class="container mx-auto flex justify-between">
            <a href="{{ route('inicio') }}" class="font-black text-xl text-titulos titulo_hero">Momentos</a>

            @if (!auth()->user())
                <nav class="my-auto">
                    <a class="text-titulos font-bold  text-sm mx-5" href="/login">Login</a>
                    <a class="text-titulos font-bold  text-sm mx-5" href="/registrar">Crear Cuenta</a>
                </nav>
            @else
                <nav class="flex my-auto items-center">
                    <div>
                        <a href="/{{ auth()->user()->username }}"><img
                                class="w-8 h-8 object-cover rounded-full border-2 border-titulos"
                                src="{{ asset('perfiles/' . auth()->user()->imagen) }}" alt=""></a>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-titulos  text-sm mx-5 my-auto" href="/logout">Cerrar
                            Sesion</button>
                    </form>
                </nav>
            @endif

        </div>

    </header>


    {{-- El main donde se va a ir inyectando el contenido de cada vista con un @yield --}}

    <main>


        <h2 class=" uppercase text-center text-titulos font-black text-5xl mb-20 mt-20 w-full">
            @yield('titulo')
        </h2>




        <section class="min-h-screen">

            @yield('contenido')

        </section>

    </main>

    @auth


        @if (!isset($nav_derecha))
            <nav
                class=" bg-fondosecundario px-3 py-10 text-white flex flex-col gap-3 justify-evenly items-center fixed hover:right-0 -right-32 top-1/2 rounded-s-lg transition-all desplegable">
                <a class=" flex ml-2 uppercase hover:cursor-pointer hover:text-titulos transition-all"
                    href="{{ route('posts.create') }}">Nuevo Post <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="ml-2 size-6">
                        <path strokeLinecap="round" strokeLinejoin="round"
                            d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </a>
                <a class=" flex ml-2 uppercase hover:cursor-pointer hover:text-titulos transition-all"
                    href="{{ route('config.editar', auth()->user()) }}">Ajustes <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="ml-2 size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21.75 6.75a4.5 4.5 0 0 1-4.884 4.484c-1.076-.091-2.264.071-2.95.904l-7.152 8.684a2.548 2.548 0 1 1-3.586-3.586l8.684-7.152c.833-.686.995-1.874.904-2.95a4.5 4.5 0 0 1 6.336-4.486l-3.276 3.276a3.004 3.004 0 0 0 2.25 2.25l3.276-3.276c.256.565.398 1.192.398 1.852Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.867 19.125h.008v.008h-.008v-.008Z" />
                    </svg>
                </a>
                <a class=" flex ml-2 uppercase hover:cursor-pointer hover:text-titulos transition-all" href="{{route('usuarios.buscar')}}">Buscar
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="ml-2 size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </a>
                <a class=" flex ml-2 uppercase hover:cursor-pointer hover:text-titulos transition-all"
                    href="{{ route('chat.index', auth()->user()) }}">Mensajes <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="ml-2 size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </a>
            </nav>
        @endif

    @endauth


    <footer class=" bg-fondosecundario h-12 flex items-center justify-center mt-20 py-10">
        <h3 class=" text-white font-medium text-center"> Powered by GEM® - Todos los derechos reservados
            {{ now()->year . ' - ' . now()->month }}</h3>
    </footer>
</body>

{{-- livewire scripts --}}
@livewireScripts

</html>
