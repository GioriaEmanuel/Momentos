
@foreach ($posts as $post)


        <div class=" border-2 rounded p-5 bg-fondosecundario  flex flex-col gap-3 h-fit ">

            {{-- Usuarios y ultimo post de cada uno --}}
            <div class=" flex gap-3">
                <img class="h-20 w-20 object-center object-cover rounded-full border-titulos border-2"
                    src="{{ asset('perfiles/' . $post->user->imagen) }}" alt="imagen_perfil">
                <div>
                    <a class="font-bold uppercase text-titulos text-xs"
                        href="{{ route('posts.muro', $post->user->username) }}">{{ $post->user->username }}</a>
                    <p class="text-white text-xs">{{ $post->user->seguidores->count() }} @choice('Seguidor|Seguidores', $post->user->seguidores->count()) </p>
                </div>
            </div>
            {{-- post si es que tienen --}}
            @if ($post)

                <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}"><img
                        class=" max-h-80 object-cover w-full"
                        src="{{ asset('uploads/' . ($post->imagen ?? 'placeholder.avif')) }}" alt=""></a>

                <div class="text-titulos">
                    <p class="">{{ $post->titulo }}</p>
                    <p>{{ $post->descripcion }}</p>

                </div>

                <div class="flex gap-4">

                    <p><span
                            class="font-bold text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</span>
                    </p>
                    <p class="text-gray-500">{{ $post->likes->count() }} Likes</p>
                    <p class="text-gray-500">{{ $post->comentarios->count() }} Comentarios</p>
                </div>

                @auth
                    <div class="flex gap-4">
                        @if ($post->liked())
                            <form action="{{ route('likes.destroy', ['post' => $post]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="hover:cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg" fill="red"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                    </svg></button>

                            </form>
                        @else
                            <form action="{{ route('likes.store', ['user' => $post->user, 'post' => $post]) }}"
                                method="POST">
                                @csrf
                                <button class="hover:cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                    </svg></button>

                            </form>
                        @endif
                    </div>
                @endauth
            @endif
        </div>
    @endforeach

