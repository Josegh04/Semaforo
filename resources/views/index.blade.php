<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Bosque y Jardín — Inicio</title>
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>

  <header class="header">
    <div class="wrap">
      <!-- Logo / Nombre → INICIO -->
      <a href="index.html" class="brand">
        <div class="logo">B&J</div>
        <div style="font-weight:800">Bosque y Jardín</div>
      </a>
<!--menu cambiar aqui-->
<nav class="nav">
  <a href="/">Inicio</a>
  <a href="/productos">Productos</a>
  <a href="/inventario">Inventario</a>
</nav>
  <!-- Carrito -->
  <a href="carrito.html" class="cart-pill">🛒 2</a>
    </div>
  </header>

  <!-- CONTENIDO -->
  <main class="container">

    <section class="card section">
      <h2 class="h2">Bienvenido a Bosque y Jardín</h2>
      <p class="small">
        Tu tienda de confianza para maquinaria y herramientas para el campo.
        Consulta productos, revisa ofertas y solicita servicios de reparación.
      </p>
    </section>

    <section id="ofertas" class="section">
      <h3 class="h2">Ofertas especiales</h3>
      <div class="grid products grid-3">

        <article class="card">
          <div class="thumb">Motosierra</div>
          <h4>Motosierra 18”</h4>
          <div class="kv">
            <div class="price">$2,499</div>
            <div class="small" style="text-decoration:line-through;color:#9aa79a">$3,000</div>
          </div>
          <div style="margin-top:10px">
            <button class="btn">Agregar</button>
          </div>
        </article>

        <article class="card">
          <div class="thumb">Podadora</div>
          <h4>Podadora eléctrica</h4>
          <div class="price">$1,799</div>
          <div style="margin-top:10px">
            <button class="btn">Agregar</button>
          </div>
        </article>

      </div>
    </section>

    <section class="section">
      <h3 class="h2">Otros productos</h3>
      <div class="grid products grid-3">

        <article class="card">
          <div class="thumb">Fumi</div>
          <h4>Fumigadora manual</h4>
          <div class="price">$799</div>
          <div style="margin-top:10px">
            <button class="btn-ghost">Ver</button>
            <button class="btn">Agregar</button>
          </div>
        </article>

        <article class="card">
          <div class="thumb">Refac</div>
          <h4>Refacción (Filtro)</h4>
          <div class="price">$95</div>
          <div style="margin-top:10px">
            <button class="btn-ghost">Ver</button>
            <button class="btn">Agregar</button>
          </div>
        </article>

      </div>
    </section>

    <section class="section card">
      <h3 class="h2">Destacados</h3>
      <div class="grid products grid-3">

        <article class="card">
          <div class="thumb">Desb</div>
          <h4>Desbrozadora Profesional</h4>
          <div class="price">$3,200</div>
          <div style="margin-top:10px">
            <button class="btn">Agregar</button>
          </div>
        </article>

        <article class="card">
          <div class="thumb">Kit</div>
          <h4>Kit Jardinería Premium</h4>
          <div class="price">$899</div>
          <div style="margin-top:10px">
            <button class="btn">Agregar</button>
          </div>
        </article>

      </div>
    </section>

  </main>

  <footer class="footer">
    © 2025 Bosque y Jardín. Todos los derechos reservados. <br>
    Boulevard Norte No. 51-B, Col. Candelaria, Comitán de Domínguez, Chiapas.
  </footer>


</body>
</html>


