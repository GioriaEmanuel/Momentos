<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ComentariosController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\NotificacionesController;
use App\Http\Controllers\PaginasController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SeguirController;
use App\Models\Notificaciones;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Route;



//el middleware de proteccion ahora se hace en las rutas, el name es un alias, como una variable que contiene el endpoint, si este endpoint cambia, la variable siempre va a ser igual

//Inicio
Route::get('/', [PaginasController::class,'index'])->name('inicio');

//Ruta del buscado
Route::get('/buscar',[PaginasController::class,'buscar'])->name('usuarios.buscar')->middleware('auth');

//Login
Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login',[LoginController::class,'store']);

//Logout
Route::post('/logout',[LogoutController::class,'store'])->name('logout');

//Registro
Route::get('/registrar',[RegisterController::class,'index']);
Route::post('/registrar',[RegisterController::class,'store']);

//Rutas protegidas y posts con URL`s dinamicas pasadas como modelos
Route::get('/{user:username}', [PostController::class,'index'])->name('posts.muro');

Route::get('/posts/create',[PostController::class, 'create'])->name('posts.create')->middleware('auth');
Route::post('/posts',[PostController::class, 'store'])->name('post.store')->middleware('auth');

Route::get('/{user:username}/posts/{post}',[PostController::class, 'show'])->name('posts.show');
Route::delete('/posts/{post}', [PostController::class,'destroy'])->name('posts.destroy');

//Rutas para comentarios
Route::post('/{user:username}/posts/{post}',[ComentariosController::class, 'store'])->name('comentarios.store');

//Rutas para likes
Route::post('/{user:username}/posts/like/{post}',[LikesController::class, 'store'])->name('likes.store');
Route::delete('/posts/like/{post}',[LikesController::class, 'destroy'])->name('likes.destroy');

//Imagenes
Route::post('/posts/imagenes',[ImageController::class,'store'])->name('posts.imagen');

//Rutas para configuracion y edicion
Route::get('/{user}/editar_perfil',[ConfiguracionController::class,'index'])->name('config.editar')->middleware('auth');
Route::post('/{user}/editar_perfil',[ConfiguracionController::class,'store'])->name('config.store');


//Rutas para los follows
Route::post('/{user}/seguir', [SeguirController::class, 'store'])->name('usuarios.seguir')->middleware('auth');
Route::delete('/{user}/seguir', [SeguirController::class, 'destroy'])->name('usuarios.no_seguir')->middleware('auth');

//Rutas para ver los seguidores o los seguidos
Route::get('/{user:username}/seguidores', [SeguirController::class, 'show_seguidores'])->name('usuarios.seguidores')->middleware('auth');
Route::get('/{user:username}/seguidos', [SeguirController::class, 'show_seguidos'])->name('usuarios.seguidos')->middleware('auth');

//Rutas para las notificaciones
Route::middleware(['auth'])->group(function () {

Route::get('/{user:username}/notificaciones',[NotificacionesController::class,'index'])->name('notificaciones.index');

//Rutas para el chat en vivo

Route::get('/{user:username}/mensajes',[ChatController::class,'index'])->name('chat.index');
Route::get('/{user:username}/chat/{receptor:id}',[ChatController::class,'show'])->name('chat.chat');

});