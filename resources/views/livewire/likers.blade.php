<div class=" modal rounded-md w-3/12 max-h-96 overflow-y-scroll no-scrollbar bg-black shadow-sm p-6 shadow-titulos absolute top-1/2 left-1/2">
    
    {{-- Listar los likeros --}}
    
    <div class=" flex flex-col gap-6 relative">
        <button class=" self-end cerrar_modal text-red-700 font-extrabold uppercase w-8 h-8 text-center  rounded-full bg-fondosecundario sticky top-0 hover:bg-titulos hover:text-black transition-all ">
            X
        </button>
        @if(!empty($likers))
        
        @foreach ($likers as $liker)
        <a class="" href="{{route('posts.muro', $liker)}}">
            <div class="text-center flex gap-3 items-center">
                <img class="w-16 max-w-none h-16 object-cover rounded-full" src="{{asset('perfiles/'. $liker->imagen)}}" alt="">
                <p class="text-white text-xs uppercase font-bold">{{$liker->name}}</p>
            </div>
        </a> 
        @endforeach
       @endif
        
    </div>
    {{-- The Master doesn't talk, he acts. --}}
</div>
