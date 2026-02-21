<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('index');
});

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
    $estados = DB::table('catalogo_estado_producto')
        ->where('nombre_estado', 'Descontinuado')
        ->get();

    return view('agregar_producto', compact('categorias', 'estados'));
});

/* GUARDAR */
Route::post('/inventario/agregar', function (Request $request) {

    $stock = $request->stock;
    $estado_manual = $request->id_estado;

    $estado = $estado_manual ?? ($stock > 0 ? 1 : 2);

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

/* FORMULARIO EDITAR */
Route::get('/inventario/editar/{id}', function($id){
    $producto = DB::table('productos')->where('id_producto', $id)->first();
    $categorias = DB::table('categorias')->get();
    $estados = DB::table('catalogo_estado_producto')->get();
    return view('editar_producto', compact('producto','categorias','estados'));
});

/* GUARDAR CAMBIOS */
Route::post('/inventario/editar/{id}', function(Request $request, $id){
    $stock = $request->stock;
    $estado_manual = $request->id_estado;

    $estado = $estado_manual ?? ($stock > 0 ? 1 : 2);

    DB::table('productos')->where('id_producto', $id)->update([
        'nombre' => $request->nombre,
        'descripcion' => $request->descripcion,
        'precio' => $request->precio,
        'stock' => $stock,
        'id_categoria' => $request->id_categoria,
        'id_estado' => $estado
    ]);

    // REDIRECCIONA AL MISMO EDITAR con mensaje
    return redirect("/inventario/editar/$id")->with('success', 'Producto actualizado correctamente.');
});

/* LISTA PARA ELIMINAR */
Route::get('/inventario/eliminar', function () {
    $productos = DB::table('productos')->get();
    return view('eliminar_producto', compact('productos'));
});

/* ELIMINAR DEFINITIVO */
Route::post('/inventario/eliminar/{id}', function ($id) {
    DB::table('productos')->where('id_producto', $id)->delete();
    return redirect('/inventario/eliminar')->with('success', 'Producto eliminado.');
});