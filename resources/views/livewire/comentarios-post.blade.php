<div>
    {{-- @auth y @endauth condicionan la muestra de un segmento de codigo a usuarios autenticados. --}}
    @auth
        <form method="POST" class="m-auto pb-5 w-full">
            @csrf
            <textarea wire:model="comentario" class="w-full p-3 bg-fondosecundario text-titulos" name="comentario" id="coment"
                cols="30" rows="5" placeholder="Deja tu comentario"></textarea>
            @error('comentario')
                <p class="text-white bg-red-400 p-2 font-bold rounded">{{ $message }}</p>
            @enderror
            <div id="emojis" class="relative">

                <svg xmlns="http://www.w3.org/2000/svg" fill="yellow" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-4 cursor-pointer" id="abrirEmoji">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.182 15.182a4.5 4.5 0 0 1-6.364 0M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z" />
                </svg>

                <emoji-picker class=" absolute hidden" id="emoji-picker"></emoji-picker>
               

            </div>
            <input wire:click="AlmacenarComentario" value="Comentar" id="btn_comentar"
                class="uppercase font-bold text-center bg-fondosecundario text-titulos p-3 rounded my-2 hover:cursor-pointer hidden ">
        </form>
    @endauth

    {{-- validacion / retroalimentacion --}}
    @if (session('mensaje'))
        <p class="text-white bg-green-400 p-2 font-bold rounded">{{ session('mensaje') }}</p>
    @endif

    

</div>
