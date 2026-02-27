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

/* FORM AGREGAR */
Route::get('/inventario/agregar', function () {
    $categorias = DB::table('categorias')->get();
    return view('agregar_producto', compact('categorias'));
});

/* GUARDAR PRODUCTO */
Route::post('/inventario/agregar', function (Request $request) {

    // VALIDACIONES
    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'required|string|max:255',
        'precio' => 'required|numeric|min:1',
        'stock' => 'required|integer|min:0',
        'id_categoria' => 'required',
        'id_estado' => 'nullable'
    ]);

    $stock = $request->stock;
    $estado_manual = $request->id_estado;

    // LÓGICA DE ESTADO
    if ($estado_manual == 3) {
        $estado = 3;
    } else {
        $estado = ($stock > 0) ? 1 : 2; 
    }

    DB::table('productos')->insert([
        'nombre' => $request->nombre,
        'descripcion' => $request->descripcion,
        'precio' => $request->precio,
        'stock' => $stock,
        'id_categoria' => $request->id_categoria,
        'id_estado' => $estado
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

    // VALIDACIONES
    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'required|string|max:255',
        'precio' => 'required|numeric|min:1',
        'stock' => 'required|integer|min:0',
        'id_categoria' => 'required',
        'id_estado' => 'nullable'
    ]);

    $stock = $request->stock;
    $estado_manual = $request->id_estado;

    // LÓGICA DE ESTADO
    if ($estado_manual == 3) {
        $estado = 3;
    } else {
        $estado = ($stock > 0) ? 1 : 2;
    }

    DB::table('productos')->where('id_producto', $id)->update([
        'nombre' => $request->nombre,
        'descripcion' => $request->descripcion,
        'precio' => $request->precio,
        'stock' => $stock,
        'id_categoria' => $request->id_categoria,
        'id_estado' => $estado
    ]);

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