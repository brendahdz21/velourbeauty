<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MaquillajeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\SiteController;

/*
|--------------------------------------------------------------------------
| RUTA PRINCIPAL
|--------------------------------------------------------------------------
| Cuando entren a "/" serán redirigidos a la vista home.
*/
Route::redirect('/', '/home');


/*
|--------------------------------------------------------------------------
| RUTAS PÚBLICAS
|--------------------------------------------------------------------------
| Estas rutas las puede ver cualquier visitante sin iniciar sesión.
*/
Route::get('/home', [
    SiteController::class, 'home'
])->name('home');


/*
|--------------------------------------------------------------------------
| LOGIN Y REGISTRO PÚBLICO
|--------------------------------------------------------------------------
| Aquí se muestra el formulario de acceso, el formulario de registro
| público y se procesan ambas operaciones.
*/
Route::middleware('guest')->group(function () {

    Route::get('/acceso', [
        AuthController::class, 'loginForm'
    ])->name('login');

    Route::post('/acceso', [
        AuthController::class, 'login'
    ])->name('login.store');

    Route::get('/registro', [
        AuthController::class, 'publicRegisterForm'
    ])->name('register.public');

    Route::post('/registro', [
        AuthController::class, 'publicRegister'
    ])->name('register.public.store');
});


/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
| Cierra la sesión del usuario autenticado.
*/
Route::post('/cerrar', [
    AuthController::class, 'logout'
])->name('logout');


/*
|--------------------------------------------------------------------------
| RUTAS PROTEGIDAS PARA USUARIOS AUTENTICADOS
|--------------------------------------------------------------------------
| Solo pueden entrar usuarios que ya iniciaron sesión.
| Aquí está el CRUD normal de maquillajes y el catálogo API.
| Si el usuario no tiene sesión iniciada, será redirigido a login.
*/
Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | CATALOGO DE CLIENTE
    |--------------------------------------------------------------------------
    | Muestra el catálogo de productos externos consumidos desde API.
    */
    Route::get('/catalogo', [
        SiteController::class, 'catalogo'
    ])->name('catalogo');

    /*
    |--------------------------------------------------------------------------
    | VISTA CONÓCENOS
    |--------------------------------------------------------------------------
    | Página informativa de la empresa.
    | Solo usuarios con sesión pueden verla.
    */
    Route::get('/conocenos', [
        SiteController::class, 'conocenos'
    ])->name('conocenos');

    /*
    |--------------------------------------------------------------------------
    | CRUD DE MAQUILLAJES
    |--------------------------------------------------------------------------
    | Rutas para consultar, registrar, editar y eliminar maquillajes.
    */
    Route::resource('maquillajes', MaquillajeController::class);

});


/*
|--------------------------------------------------------------------------
| RUTAS SOLO PARA ADMINISTRADORES
|--------------------------------------------------------------------------
| Estas rutas solo las puede usar un administrador autenticado.
*/
Route::middleware(['auth', 'admin'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | PANEL ADMIN PRINCIPAL
    |--------------------------------------------------------------------------
    | Al iniciar sesión como admin, lo mandamos primero a gestión de usuarios.
    */
    Route::get('/admin-dashboard', [
        AuthController::class, 'usuarios'
    ])->name('admin-dashboard');


    /*
    |--------------------------------------------------------------------------
    | GESTIÓN DE USUARIOS
    |--------------------------------------------------------------------------
    | Aquí se listan los usuarios, se muestra el formulario de crear
    | y se guarda un nuevo usuario.
    */
    Route::get('/admin/usuarios', [
        AuthController::class, 'usuarios'
    ])->name('admin.usuarios');

    Route::get('/admin/usuarios/crear', [
        AuthController::class, 'registerForm'
    ])->name('admin.usuarios.create');

    Route::post('/admin/usuarios', [
        AuthController::class, 'register'
    ])->name('admin.usuarios.store');

    // EDITAR USUARIO
    Route::get('/admin/usuarios/{usuario}/editar', [
        AuthController::class, 'edit'
    ])->name('admin.usuarios.edit');

    // ACTUALIZAR USUARIO
    Route::put('/admin/usuarios/{usuario}', [
        AuthController::class, 'update'
    ])->name('admin.usuarios.update');

    // ELIMINAR USUARIO
    Route::delete('/admin/usuarios/{usuario}', [
        AuthController::class, 'destroy'
    ])->name('admin.usuarios.destroy');


    /*
    |--------------------------------------------------------------------------
    | GESTIÓN DE MARCAS
    |--------------------------------------------------------------------------
    | Aquí se listan las marcas, se muestra el formulario de crear
    | y se guarda una nueva marca.
    */
    Route::get('/admin/marcas', [
        MarcaController::class, 'index'
    ])->name('admin.marcas');

    Route::get('/admin/marcas/crear', [
        MarcaController::class, 'create'
    ])->name('admin.marcas.create');

    Route::post('/admin/marcas', [
        MarcaController::class, 'store'
    ])->name('admin.marcas.store');

    // EDITAR MARCA
    Route::get('/admin/marcas/{marca}/editar', [
        MarcaController::class, 'edit'
    ])->name('admin.marcas.edit');

    // ACTUALIZAR MARCA
    Route::put('/admin/marcas/{marca}', [
        MarcaController::class, 'update'
    ])->name('admin.marcas.update');

    // ELIMINAR MARCA
    Route::delete('/admin/marcas/{marca}', [
        MarcaController::class, 'destroy'
    ])->name('admin.marcas.destroy');

});