<div>
    {{-- Stop trying to control. --}}
    
    {{-- Formulario de busqueda --}}

    <form id="form_busqueda" class="w-full flex items-center justify-center">
        @csrf
        <input wire:model.live="nombre" type="text" id="input_buscador" name="input_buscador" class=" mb-6 w-full p-2 rounded-md bg-black text-titulos" placeholder="Encuentra a tus amigos">        <p>{{$nombre}}</p>
        {{-- wire.model.live hace que el atributo al que esta relacionado el input, en este caso nombre, se actualize automaticamente cuando ingresemos info en el input --}}
    </form>


    @foreach ($users as $user)
    <div class=" container w-11/12 max-h-52 m-auto bg-fondosecundario rounded grid grid-cols-12  mb-10 gap-4">
        {{-- usuario buscado --}}
        <div class="box_border_animated imagen__notificacion md:col-span-2 col-span-4">
            <a class="" href="{{route('posts.muro', $user->name)}}">
                <img class=" h-24 w-32 object-cover " src="{{asset('perfiles/'. $user->imagen)}}" alt="imagen perfil">
            </a>
        </div>
        {{-- usuario info --}}
        <div class="info_pertenece flex gap-2 items-center justify-start md:col-span-10 col-span-4">
            <p class="titulo_hero capitalize">{{$user->name}}</p>
          
        </div>

    </div>
        
    @endforeach
</div>
