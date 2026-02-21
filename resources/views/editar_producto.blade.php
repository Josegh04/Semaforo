<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Editar producto</title>
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>

<header class="header">
<div class="wrap">
<a href="/inventario" class="brand">
<div class="logo">B&J</div>
<div style="font-weight:800">Editar producto</div>
</a>
</div>
</header>

<main class="container">
<section class="card section">
<h2>Editar producto</h2>

<!-- MENSAJE -->
@if(session('success'))
  <div style="background:#d4edda; color:#155724; padding:10px; border-radius:6px; margin-bottom:15px;">
    {{ session('success') }}
  </div>
@endif

<form method="POST" action="/inventario/editar/{{ $producto->id_producto }}">
@csrf
  <label>Nombre</label>
  <input type="text" name="nombre" value="{{ $producto->nombre }}" required>

  <label>Descripción</label>
  <input type="text" name="descripcion" value="{{ $producto->descripcion }}" required>

  <label>Precio</label>
  <input type="number" step="0.01" name="precio" value="{{ $producto->precio }}" required>

  <label>Stock</label>
  <input type="number" name="stock" value="{{ $producto->stock }}" required>

  <label>Categoría</label>
  <select name="id_categoria">
    @foreach($categorias as $c)
    <option value="{{ $c->id_categoria }}" 
      @if($producto->id_categoria == $c->id_categoria) selected @endif>
      {{ $c->nombre_categoria }}
    </option>
    @endforeach
  </select>

  <label>Estado especial</label>
  <select name="id_estado">
    <option value="">Automático (por stock)</option>
    @foreach($estados as $e)
      <option value="{{ $e->id_estado }}" 
        @if($producto->id_estado == $e->id_estado) selected @endif>
        {{ $e->nombre_estado }}
      </option>
    @endforeach
  </select>

  <br><br>
  <button class="btn">Guardar cambios</button>
  <a href="/inventario" class="btn">Volver</a>
</form>
</section>
</main>

</body>
</html>