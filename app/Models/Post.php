<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comentarios;
use App\Models\User;
use App\Models\Likes;


class Post extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     //Siempre hay que agregar los atributos que pueden ser asignados de manera masiva
     
    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id',
        
    ];
    //Relacion de post con user, belongs to, relacion de uno a uno, indicador de a que modelo
    //esta relacionado o "pertenece" el objeto que llama la funcion

    public function user(){

    //---------- return $this->belongsTo(User::class);---------//

        //Esto nos retorna toda la informacion del usuario al que esta relacionado el post
        //Podemos filtrar los resultados con el metodo select(),

        return $this->belongsTo(User::class)->select([
            'name','username','imagen'
        ]);
    }

    public function comentarios(){

        return $this->hasMany(Comentarios::class);
    }
    public function likes(){

        return $this->hasMany(Likes::class);
    }

    public function liked(){

        //con esta funcion puedo revisar si un usuario o el usuario autenticado dio like
        $liked = Likes::where([
            ['user_id','=', auth()->user()->id],
            ['post_id','=', $this->id],

        ])->get();

        //laravel tiene un metodo para revisar sin existe un registro en la base de datos

        $liked_laravel = $this->likes->contains('user_id' , auth()->user()->id);
        //utilizando la relacion likes que hicimos anteriormente para obtener todos los likes de este post
        //revisamos si alguno de los resultados CONTAINS (contiene) en la columna 'user_id' el id del usuario registrado
        
        return $liked_laravel;
    }
}
