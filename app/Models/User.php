<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    //Metodo de relacion de User con Post, por medio de los metodos de eloquent
    
    public function posts(){

        //orderBy() nos permite ordenar por la columna que le indiquemos de la manera que le indiquemos
        return $this->hasMany(Post::class)->orderBy('id', 'desc');
    }
    public function last_post(){

        //latest('id' ) es un metodo que ordena en este caso por la columna id de ultimo a primero
        //first() se trae el primer registro del resultado, es como el shift de un array
        return $this->hasMany(Post::class)->latest('id')->first();
    }

    public function likes(){

        return $this->hasMany(Likes::class);
    }

    Public function seguidores(){

        //Esto alamacena en la tabla de seguirs las relaciones entre user_id y seguidor_id
        //indicando que $this (usuario dueño del muro) es user_id y el usuario autenticado es el seguidor_id
        return $this->belongsToMany(User::class, 'seguirs', 'user_id', 'seguidor_id');
    }

    public function seguidos(){

        //Lo mismo pero al revez, indico que relacion al seguido, osea, la persona auth con user_id que es el dueño del muro
        return $this->belongsToMany(User::class, 'seguirs', 'seguidor_id', 'user_id');

        
    }

    public function siguiendo(){

        $siguiendo = Seguir::where([
            ['seguidor_id', auth()->user()->id],
            ['user_id', $this->id]
        ])->get();

        //Con esto compruebo si en la tabla de seguirs en seguidor id existe la relacion entre $this (usuario del muro),
        //y el usuario autenticado
        return $this->seguidores->contains(auth()->user()->id);

    }

    public function no_seguidos()
{
    // Obtiene los IDs de los usuarios que el usuario actual sigue, pluck se encarga de traer solo los valores de la columna id
    $seguidos = $this->seguidos()->pluck('users.id');

    // Retorna todos los usuarios que no están en la lista de IDs que el usuario actual sigue con whereNotIt,
    // y además no es el propio usuario actual con where.
    return User::whereNotIn('id', $seguidos)
                ->where('id', '!=', $this->id);
}

    public function common_friends(){
        
        //whereIn me trae todos los registros que tengan los valores especificados entre corchetes en la columna pasada entre comillas
        $seguidosTotal = Seguir::whereIn('seguidor_id',[$this->id , auth()->user()->id])->get();

        //Los agrupo en un array filtrando por la columna que quiero que contenga valores repetidos
        //en los casos que ambos compartan el valor de la columna ese array va a tener dos valores
        $amigosEnComun = $seguidosTotal->groupBy('user_id');

        $duplicados = [];
        $usuarios = [];

        //alamaceno en un array los registros duplicados
        foreach($amigosEnComun as $amigo){

            if ($amigo->count() > 1){

            
                $duplicados [] = $amigo;
            };
        }
        //obengo  los usuarios seguidos por ambos
        
        foreach($duplicados as $usuario){
            foreach($usuario as $user){
                $usuarios [] = User::find($user->user_id);
            }
        }
        //filtro los usuarios para que no halla repetidos
        $usuarios = array_unique($usuarios);
        
        return $usuarios;
    }

    public function notificaciones(){

        return $this->hasMany(Notificaciones::class);
    }

    public function chats(){
        return $this->hasMany(Chat::class);
    }
}
