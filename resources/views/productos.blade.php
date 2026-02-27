<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <title>Catálogo - Bosque y Jardín</title>
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
      <h2 class="h2">Productos</h2>

      <div class="grid grid-3 products">
        @foreach($productos as $p)
        <article class="card">
          <div class="thumb">Prod</div>

          <h4>{{ $p->nombre }}</h4>

          <p class="small">{{ $p->descripcion }}</p>

          <p class="small">
            <strong>Categoría:</strong> {{ $p->categoria ?? 'Sin definir' }}
          </p>

          <div class="kv">
            <div class="price">${{ $p->precio }}</div>
            <div class="small">Stock: {{ $p->stock }}</div>
          </div>
        </article>
        @endforeach
      </div>

    </section>
  </main>

  <footer class="footer">
    Boulevard Norte No. 51-B, Col. Candelaria, Comitán de Domínguez, Chiapas
  </footer>

</body>

</html>