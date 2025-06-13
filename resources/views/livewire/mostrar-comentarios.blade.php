
<div>
    <p class=" text-titulos">Comentarios</p>
    @foreach ($post->comentarios as $comentario)
        <div class=" bg-fondosecundario p-4 rounded my-3 text-titulos">
            <a class="font-bold uppercase "
                href='{{ route('posts.muro', $comentario->user->username) }}'>{{ $comentario->user->username }}:</a>
            <p class="my-2 text-sm">{{ $comentario->comentario }}</p>
            <p class="text-gray-400 text-sm text-right">{{ $comentario->created_at->diffForHumans() }}</p>
        </div>
    @endforeach
</div>