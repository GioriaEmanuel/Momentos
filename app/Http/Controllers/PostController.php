<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate as FacadesGate;

class PostController extends Controller
{
    //Este va a ser el controlador de las paginas Get

    //Metodo de proteccion de rutas cuando no se halla iniciado session
    //al ser un constructor se ejecuta primero y revisa la autenticacion o redirije
    //es el helper de laravel para nuestra version de isAuth();
    //esto era asi en laravels anteriores - ahora se hace en las rutas
    
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    //Laravel 11 :

    // public static function middleware()
    // {
    //     return [
    //          'auth',
    //         new Middleware('auth', only: ['create']),
    //     ];
    // }

    public function index(User $user){

        //Consulta a la base de datos por medio de la relacion establecida en el modelo USER::posts,
        $posts = $user->posts()->paginate(4);
        
        //Relacion que retorna un array con los amigos en comun
        
        if(auth()->user()){
            $amigos = $user->common_friends();
        }else{
            $amigos = null;
        }
       
        
        

        //Consulta de manera tradicional con where propio de laravel, el get siempre es necesario
        //$posts = User::where('user_id')->get();

        

        return view('templates/muro',[
            'username' => $user->username,
            'posts' => $posts,
            'user' => $user,
            'amigos' => $amigos,
            'nav_derecha' => false,
                ]);
    }

    public function create(){

        return view('templates/nuevo_post');
    }                                                                                                                    
    public function store(Request $peti){

         //validacion de Laravel
         $peti->validate([
            'titulo' => 'required|min:5|max:50',
            'description' => 'required|min:15|max:250',
            'imagen' => 'required',
        ]);

        

        //Una vez pasada la validacion guardamos el registro en la base de datos
        //Se llama al modelo abstracto y se ejecuta el metodo create para guardar el registro
        //recibe un arreglo asociativo con los datos a guardar
        //este metodo create() -de insercion de registros- crea y guarda todo en un paso.
        // Post::create([
        //     'titulo' => $peti->titulo,
        //     'descripcion' => $peti->description,
        //     'imagen' => $peti->imagen,
        //     'user_id' => auth()->user()->id,

        // ]);

        //Otra forma de almacenar los datos es de la manera que ya habiamos visto en nuestro framework
        //instanciando el modelo y trabajndo con el objeto
        //este metodo instancia y luego creamos y llenamos los atributos, una vez echo esto guardamos con el motodo de save();
        $post = new Post;

        $post->titulo = $peti->titulo;
        $post->descripcion = $peti->description;
        $post->imagen = $peti->imagen;
        $post->user_id = auth()->user()->id;
        $post->save();

        //una vez insertados los datos en la base, redireccionamos

        return redirect('/'.auth()->user()->username);
    }

    //Convencion de laravel, cuando queremos mostrar un solo registro visitado usamos show
    public function show(User $user, Post $post){

        if ( $post->user_id !== $user->id){

            return redirect('/'.auth()->user()->username);
        }

        return view('templates/post',[
            'post' => $post,
            'user' => $user,
        ]);
    }

    public function destroy(Post $post){

        //Este es el policie creado para el control de acceso a la informacion y acciones dependiendo del usuario

        if(FacadesGate::allows('delete', $post)){
            
            //Elimino la imagen
            //File es una clase de los Facades de Laravel para la tratativa de archivos
            if(File::exists(public_path('uploads/'.$post->imagen))){

                unlink(public_path('uploads/'.$post->imagen));

            }

            //Elimino el post
            $post->delete();
        };

     

        //urilizacion de policies para la eliminacion o actualizacion de datos
        //los policies se encargarn de controlar el acceso a los datos dependiendo de quien este accediendo


        return redirect()->route('posts.muro', auth()->user());
    }
 
}
