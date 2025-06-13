<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'mensaje',
        'user_id',
        'receptor_id',

    ];

    public function emisor()
    {

        return $this->belongsTo(User::class, 'user_id');
    }

    public function receptor()
    {

        return $this->belongsTo(User::class, 'receptor_id');
    }
    public function ultimo_mensaje($emisor,$receptor)
    {

        // Recupera todos los mensajes entre los dos usuarios
        $mensajes = Chat::where(function ($query) use ($emisor, $receptor) {
            $query->where('user_id', $emisor->id)->where('receptor_id', $receptor->id);
        })
        ->orWhere(function ($query) use ($emisor, $receptor) {
            $query->where('user_id', $receptor->id)->where('receptor_id', $emisor->id);
        })
        //y los traigo en orden por fecha
        ->orderBy('created_at', 'desc')->get();

        // Verifico si hay mensajes
        if ($mensajes->isNotEmpty()) {
            $ultimoMensaje = $mensajes->first(); // Me traigo el primero

            // reviso quién envió el último mensaje
            $emisorUltimoMensaje = ($ultimoMensaje->user_id == $emisor->id) ? 'Tu: ' : $receptor->name;

            return [
                'mensaje' => $ultimoMensaje->mensaje,
                'emisor' => $emisorUltimoMensaje,
            ];
        } else {
            return [
                'mensaje' => 'Sin mensajes',
                'emisor' => '',
            ];
        }
    }
    static function mensajes_entre_usuarios($emisor, $receptor)
    {
        
        $mensajes = Chat::where(function ($query) use ($emisor, $receptor) {
            $query->where('user_id', $emisor->id)->where('receptor_id', $receptor->id);
        })
        ->orWhere(function ($query) use ($emisor, $receptor) {
            $query->where('user_id', $receptor->id)->where('receptor_id', $emisor->id);
        })
        ->orderBy('created_at', 'asc')
        ->get();
    
        // Formatea los mensajes para incluir el emisor
        $mensajesFormateados = $mensajes->map(function ($mensaje) use ($emisor, $receptor) {
            $emisorMensaje = ($mensaje->user_id == $emisor->id) ? 'Tu: ' : $receptor->name;
            return [
                'mensaje' => $mensaje->mensaje,
                'emisor' => $emisorMensaje,
                'fecha' => $mensaje->created_at, // Opcional: Incluir la fecha del mensaje
            ];
        });
    
        return $mensajes;
    }
}
