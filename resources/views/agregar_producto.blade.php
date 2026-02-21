<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Agregar producto</title>
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>

<header class="header">
  <div class="wrap">
    <a href="/inventario" class="brand">
      <div class="logo">B&J</div>
      <div style="font-weight:800">Agregar producto</div>
    </a>
  </div>
</header>

<main class="container">
  <section class="card section">
    <h2 class="h2">Nuevo producto</h2>

@if(session('success'))
  <div style="background:#d4edda; color:#155724; padding:10px; border-radius:6px; margin-bottom:15px;">
    {{ session('success') }}
  </div>
@endif

<form method="POST" action="/inventario/agregar">
@csrf

      <label>Nombre</label>
      <input type="text" name="nombre" required>

      <label>Descripción</label>
      <input type="text" name="descripcion" required>

      <label>Precio</label>
      <input type="number" step="0.01" name="precio" required>

      <label>Stock</label>
      <input type="number" name="stock" required>

      <label>Categoría</label>
      <select name="id_categoria" required>
        @foreach($categorias as $c)
          <option value="{{ $c->id_categoria }}">{{ $c->nombre_categoria }}</option>
        @endforeach
      </select>

      <label>Estado especial (opcional)</label>
      <select name="id_estado">
        <option value="">Automático (por stock)</option>
        @foreach($estados as $e)
          <option value="{{ $e->id_estado }}">{{ $e->nombre_estado }}</option>
        @endforeach
      </select>

      <br><br>
      <button type="submit" class="btn">Guardar producto</button>
      <a href="/inventario" class="btn">Volver</a>

</form>
  </section>
</main>

</body>
</html>