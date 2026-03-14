<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

/* INICIO */
Route::get('/', function () {
    return view('index');
});

/* PRODUCTOS */
Route::get('/productos', function () {
    $productos = DB::table('productos')
        ->leftJoin('categorias', 'productos.id_categoria', '=', 'categorias.id_categoria')
        ->select('productos.*', 'categorias.nombre_categoria as categoria')
        ->get();

    return view('productos', compact('productos'));
});

/* INVENTARIO */
Route::get('/inventario', function () {
    $productos = DB::table('productos')
        ->leftJoin('catalogo_estado_producto', 'productos.id_estado', '=', 'catalogo_estado_producto.id_estado')
        ->leftJoin('categorias', 'productos.id_categoria', '=', 'categorias.id_categoria')
        ->select(
            'productos.*',
            'catalogo_estado_producto.nombre_estado as estado',
            'categorias.nombre_categoria as categoria'
        )
        ->get();

    return view('inventario', compact('productos'));
});

/* FORM AGREGAR PRODUCTO */
Route::get('/inventario/agregar', function () {
    $categorias = DB::table('categorias')->get();
    return view('agregar_producto', compact('categorias'));
});

/* GUARDAR PRODUCTO */
Route::post('/inventario/agregar', function (Request $request) {

    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'required|string|max:255',
        'precio' => 'required|numeric|min:1',
        'stock' => 'required|integer|min:0',
        'id_categoria' => 'required',
        'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    $stock = $request->stock;
    $estado_manual = $request->id_estado;

    if ($estado_manual == 3) {
        $estado = 3;
    } else {
        $estado = ($stock > 0) ? 1 : 2;
    }

    $imagen = null;

    if ($request->hasFile('imagen')) {
        $imagen = $request->file('imagen')->store('productos','public');
    }

    DB::table('productos')->insert([
        'nombre' => $request->nombre,
        'descripcion' => $request->descripcion,
        'precio' => $request->precio,
        'stock' => $stock,
        'id_categoria' => $request->id_categoria,
        'id_estado' => $estado,
        'imagen' => $imagen
    ]);

    return redirect('/inventario/agregar')->with('success', 'Producto agregado correctamente.');
});

/* FORM EDITAR */
Route::get('/inventario/editar/{id}', function($id){
    $producto = DB::table('productos')->where('id_producto', $id)->first();
    $categorias = DB::table('categorias')->get();
    $estados = DB::table('catalogo_estado_producto')->get();

    return view('editar_producto', compact('producto','categorias','estados'));
});

/* GUARDAR CAMBIOS */
Route::post('/inventario/editar/{id}', function(Request $request, $id){

    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'required|string|max:255',
        'precio' => 'required|numeric|min:1',
        'stock' => 'required|integer|min:0',
        'id_categoria' => 'required',
        'imagen' => 'required|image|mimes:jpg,jpeg,png'
    ]);

    $stock = $request->stock;
    $estado_manual = $request->id_estado;

    if ($estado_manual == 3) {
        $estado = 3;
    } else {
        $estado = ($stock > 0) ? 1 : 2;
    }

    $datos = [
        'nombre' => $request->nombre,
        'descripcion' => $request->descripcion,
        'precio' => $request->precio,
        'stock' => $stock,
        'id_categoria' => $request->id_categoria,
        'id_estado' => $estado
    ];

    if ($request->hasFile('imagen')) {
        $imagen = $request->file('imagen')->store('productos','public');
        $datos['imagen'] = $imagen;
    }

    DB::table('productos')->where('id_producto', $id)->update($datos);

    return redirect("/inventario/editar/$id")->with('success', 'Producto actualizado correctamente.');
});

/* LISTA ELIMINAR */
Route::get('/inventario/eliminar', function () {
    $productos = DB::table('productos')->get();
    return view('eliminar_producto', compact('productos'));
});

/* CONFIRMAR ELIMINAR */
Route::post('/inventario/eliminar/{id}', function ($id) {
    DB::table('productos')->where('id_producto', $id)->delete();
    return redirect('/inventario/eliminar')->with('success', 'Producto eliminado.');
});


/* =============================== */
/* CATEGORIAS */
/* =============================== */

/* FORM AGREGAR CATEGORIA */
Route::get('/categorias/agregar', function () {
    return view('agregar_categoria');
});

/* GUARDAR CATEGORIA */
Route::post('/categorias/agregar', function (Request $request) {

    $request->validate([
        'nombre_categoria' => 'required|max:100'
    ]);

    DB::table('categorias')->insert([
        'nombre_categoria' => $request->nombre_categoria
    ]);

    return redirect('/categorias/agregar')
        ->with('success','Categoría agregada correctamente');
});








/*tareas esto es aparte del proyecto recordar */

/*  Tarea 3 U3: Laboratorio de Intercambio de Datos actividad extra ajena a proyecto recuerda */
Route::get('/saludo/{nombre}', function ($nombre) {
    $nombreMayuscula = strtoupper($nombre);
    return view('prueba', ['nombre' => $nombreMayuscula]);
});

/*Tarea 4 U3: Laboratorio de Resiliencia */
use App\Http\Controllers\ErrorControladoController;

Route::get('/prueba-error', [ErrorControladoController::class, 'prueba']);

/*Tarea 4 U4: Laboratorio de Seguridad de API */
use App\Http\Controllers\ApiLoginController;

/* LABORATORIO SEGURIDAD API */
Route::post('/api/login', [ApiLoginController::class, 'login'])
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

Route::get('/api/perfil', [ApiLoginController::class, 'perfil'])
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);