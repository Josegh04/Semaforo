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
    <a href="/inventario" class="brand">
      <div class="logo">B&J</div>
      <div style="font-weight:800">Eliminar producto</div>
    </a>
  </div>
</header>

<main class="container">
<section class="card section">

@if(session('success'))
  <div style="background:#d4edda; padding:10px; border-radius:6px; margin-bottom:15px;">
    {{ session('success') }}
  </div>
@endif

<table class="table">
<thead>
<tr>
  <th>Producto</th>
  <th>Eliminar</th>
</tr>
</thead>
<tbody>
@foreach($productos as $p)
<tr>
  <td>{{ $p->nombre }}</td>
  <td>
    <form method="POST" action="/inventario/eliminar/{{ $p->id_producto }}"
          onsubmit="return confirm('¿Seguro que deseas eliminar este producto?');">
      @csrf
      <button type="submit" class="btn">🗑 Eliminar</button>
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