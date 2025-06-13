<div class="">
   
    {{-- Because she competes with no one, no one can compete with her. --}}
    <form class="md:w-8/12 rounded-md mx-auto my-2 bg-fondosecundario p-4" action="">
        @csrf

        <textarea wire:model='mensaje' id="coment"  rows="5" class="w-full bg-black text-titulos focus:border-none relative md:p-4 pr-20 no-scrollbar"></textarea>
        <input wire:click="AlmacenarMensaje" value=">" id="btn_enviarMensaje"
        class="uppercase font-bold text-center bg-fondosecundario text-titulos w-12 h-12 rounded-full my-2 hover:cursor-pointer absolute right-[5%] md:right-[20%]">
        
        <div id="emojis" class="relative">

            <svg xmlns="http://www.w3.org/2000/svg" fill="yellow" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-4 cursor-pointer" id="abrirEmoji">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.182 15.182a4.5 4.5 0 0 1-6.364 0M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z" />
            </svg>

            <emoji-picker class=" absolute hidden top-[-26rem] left-6" id="emoji-picker"></emoji-picker>
           

        </div>
        
    </form>

    
</div>
