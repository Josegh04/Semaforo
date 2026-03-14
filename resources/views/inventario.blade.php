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

            <div style="display:flex; gap:10px; margin-bottom:15px;">
                <a href="/inventario/agregar" class="btn">Agregar</a>
                <a href="/inventario/eliminar" class="btn">Eliminar</a>
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
                        <td style="display:flex; align-items:center; gap:8px;">
                            @if($p->imagen)
                                <img src="{{ asset('storage/'.$p->imagen) }}" alt="{{ $p->nombre }}" style="width:50px; height:50px; object-fit:cover; border-radius:4px;">
                            @else
                                <span style="width:50px; height:50px; display:inline-block; background:#f3fbf4; border-radius:4px; text-align:center; line-height:50px; color:var(--primary); font-size:12px;">Sin imagen</span>
                            @endif
                            <span>{{ $p->nombre }}</span>
                        </td>
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