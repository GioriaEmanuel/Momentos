<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    //

    public function index()
    {


        $chats = Chat::where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc') // Ordena por fecha de creación para obtener el último chat
            ->get()
            ->unique('receptor_id') // Obtiene solo el primer chat para cada receptor
            ->values(); // Reindexa la colección


        return view(
            'chat.index',

            [
                'chats' => $chats,

            ]
        );
    }

    public function show(User $user,  $receptor){

        $receptor = User::find($receptor);
        

        return view('chat.chat',[
            'emisor' => $user,
            'receptor' => $receptor,
        ]);
    }
}
