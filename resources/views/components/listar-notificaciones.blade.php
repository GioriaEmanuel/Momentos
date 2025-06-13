<div>

   
    @foreach ($user->notificaciones as $notificacion)
    <div class=" container w-9/12 m-auto bg-fondosecundario rounded grid md:grid-cols-12 grid-cols-6 mb-10 ">
        {{-- usuario que deja la noti --}}
        <div class="box_border_animated imagen__notificacion col-span-1">
            <a class="" href="{{route('posts.muro', $notificacion->pertenece)}}">
                <img class=" h-full w-full " src="{{asset('perfiles/'. $notificacion->pertenece->imagen)}}" alt="imagen perfil">
            </a>
        </div>
        {{-- notificacion info --}}
        <div class="info_pertenece flex gap-2 items-center justify-center md:col-span-10 col-span-4">
            <p class=" text-titulos uppercase font-bold text-xs text-center">{{$notificacion->notificacion}} de {{$notificacion->pertenece->name}}</p>
          
        </div>

        {{-- Tratamos de traer el post --}}
        <div class=" col-span-1 box_border_animated">
            @if ($notificacion->posts_id)
            <a href="{{route('posts.show', [ 'post' => $notificacion->post , 'user' => $user])}}">
                <img class="h-full w-full" src="{{asset('uploads/'.$notificacion->post->imagen)}}" alt="imagen post">
            </a>
            @else
            <a href="{{route('posts.muro', $user)}}">
                <img class="h-full w-full" src="{{asset('perfiles/'.$user->imagen)}}" alt="imagen post">
            </a>
            @endif
        </div>
    </div>
        
    @endforeach
</div>