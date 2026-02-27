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
      <h2 class="h2">Registro de nuevo producto</h2>

      @if($errors->any())
      <div class="alert-error">
        <ul>
          @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      @if(session('success'))
      <div class="alert-success">
        {{ session('success') }}
      </div>
      @endif

      <form method="POST" action="/inventario/agregar" class="form-producto">
        @csrf

        <div class="form-group">
          <label>Nombre del producto</label>
          <input type="text" name="nombre" required value="{{ old('nombre') }}">
        </div>

        <div class="form-group">
          <label>Descripción</label>
          <input type="text" name="descripcion" required value="{{ old('descripcion') }}">
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>Precio</label>
            <input type="number" step="0.01" min="1" name="precio" required value="{{ old('precio') }}">
          </div>

          <div class="form-group">
            <label>Stock</label>
            <input type="number" min="1" name="stock" required value="{{ old('stock') }}">
          </div>
        </div>

        <div class="form-group">
          <label>Categoría</label>
          <select name="id_categoria" required>
            @foreach($categorias as $c)
            <option value="{{ $c->id_categoria }}">{{ $c->nombre_categoria }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-actions">
          <button type="submit" class="btn btn-primary">Guardar producto</button>
          <a href="/inventario" class="btn btn-secondary">Volver</a>
        </div>

      </form>
    </section>
  </main>

</body>

</html>