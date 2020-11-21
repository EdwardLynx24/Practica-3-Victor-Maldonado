<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/foto','ArchivoController@guardarImagen');
/**Personas */
Route::post('/registrar/persona','PersonaController@registrarPersona')->middleware('validar.Edad');
/**Usuarios */
Route::post('/registrar/usuario','UserController@registrarUsuario');
Route::post('/iniciarsesion','UserController@iniciarSesion')->middleware('verificar.verificacion');
Route::middleware('auth:sanctum')->delete('/cerrarSesion','UserController@cerrarSesion');
/**Publicaciones */
Route::post('/nueva/publicacion','PublicacionController@crearPublicacion');
/**Comentarios */
Route::post('/nuevo/comentario','ComentarioController@registrarComentario');
/**Correo */
Route::post('/correo','EmailController@enviarEmail');
Route::get('/validar/cuenta/{correo}','UserController@verificarCuenta');
/**Consulta */
Route::get('/ver/perfil','UserController@verPerfil')->middleware('verificar.rol','auth:sanctum');