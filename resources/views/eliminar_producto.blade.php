<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <title>Eliminar producto</title>
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>

<header class="header">
  <div class="wrap">

    <a href="/" class="brand">
      <div class="logo">B&J</div>
      <div style="font-weight:800">Bosque y Jardín</div>
    </a>

    <nav class="nav">
      <a href="/">Inicio</a>
      <a href="/productos">Productos</a>
      <a href="/inventario">Inventario</a>
    </nav>

  </div>
</header>

  <main class="container">
    <section class="card section">

      <h2 class="h2">Eliminar productos</h2>

      @if(session('success'))
      <div class="alert-success">
        {{ session('success') }}
      </div>
      @endif

      <div class="form-actions" style="margin-bottom:15px;">
        <a href="/inventario" class="btn btn-secondary">Volver</a>
      </div>

      <table class="table">
        <thead>
          <tr>
            <th>Producto</th>
            <th>Descripción</th>
            <th>Eliminar</th>
          </tr>
        </thead>
        <tbody>
          @foreach($productos as $p)
          <tr>
            <td>{{ $p->nombre }}</td>
            <td>{{ $p->descripcion }}</td>
            <td>
              <form method="POST"
                action="/inventario/eliminar/{{ $p->id_producto }}"
                onsubmit="return confirm('¿Seguro que deseas eliminar este producto?');">
                @csrf
                <button type="submit" class="btn">Eliminar</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

    </section>
  </main>

</body>

</html>