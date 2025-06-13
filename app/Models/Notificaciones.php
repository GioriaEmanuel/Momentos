<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificaciones extends Model
{
    use HasFactory;

    protected $fillable = [

        'user_de',
        'user_id',
        'notificacion',
        'leido',
        'posts_id',


    ];


    //Establecer relaciones
    //BelongsTo
    public function pertenece(){

       return $this->belongsTo(User::class, 'user_de');

    }
    public function post(){

       return $this->belongsTo(Post::class, 'posts_id');

    }
    public function leido(){

   
        $this->leido = true;
        $this->save();
    }
}
