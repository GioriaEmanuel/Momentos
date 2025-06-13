<div>
    <!-- Simplicity is the consequence of refined emotions. - Jean D'Alembert -->
    <div class="lista_chats flex flex-col gap-6" id="lista_chats">
        @foreach ($chats as $chat)
        <a href="{{route('chat.chat', ['user' => $chat->emisor, 'receptor' => $chat->receptor])}}" id="chat">

            <div id="contenedor_chats" class="flex gap-2">
                <div id="img_profile" class="box_border_animated w-12">
                    <div id="img" class="w-full h-full bg-cover bg-center" style="background-image: url({{asset('perfiles/'.$chat->receptor->imagen)}})"></div>
                </div>
                <div id="chat_info">
                    <p  class=" text-gray-400  font-thin text-sm" id="chat_fecha">{{$chat->created_at}}</p>
                    <p  class=" text-titulos font-bold" id="chat_receptor">{{$chat->receptor->name}}</p>
                    <p class="text-white" id="ultimo_mensaje">{{$chat->ultimo_mensaje($chat->emisor, $chat->receptor)['emisor']. '' . $chat->ultimo_mensaje($chat->emisor, $chat->receptor)['mensaje']}}</p>
                </div>
            </div>

        </a>
        @endforeach
    </div>
</div>