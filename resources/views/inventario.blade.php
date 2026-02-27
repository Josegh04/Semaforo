<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <title>Inventario</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>

    <header class="header">
        <div class="wrap">
            <a href="/" class="brand">
                <div class="logo">B&J</div>
                <div style="font-weight:800">Empleados</div>
            </a>

            <nav class="nav">
                <a href="/inventario">Inventario</a>
                <a href="/">Bosque y Jardín</a>
            </nav>
        </div>
    </header>

    <main class="container">
        <section class="card section">

            <div style="display:flex; gap:10px; margin-bottom:15px;">
                <a href="/inventario/agregar" class="btn">➕ Agregar</a>
                <a href="/inventario/eliminar" class="btn">🗑 Eliminar</a>
            </div>

            @if(session('success'))
            <div style="background:#d4edda; padding:10px; border-radius:6px; margin-bottom:15px;">
                {{ session('success') }}
            </div>
            @endif

            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Descripción</th>
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th>Estado</th>
                        <th>Stock</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productos as $p)
                    <tr>
                        <td>{{ $p->nombre }}</td>
                        <td>{{ $p->descripcion }}</td>
                        <td>{{ $p->categoria }}</td>
                        <td>${{ $p->precio }}</td>
                        <td>{{ $p->estado }}</td>
                        <td>{{ $p->stock }}</td>
                        <td>
                            <a href="/inventario/editar/{{ $p->id_producto }}" class="btn">Actualizar</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </section>
    </main>

</body>

</html>