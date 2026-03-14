<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Agregar categoría</title>
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

            <h2 class="h2">Agregar categoría</h2>

            @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
            @endif

            <form method="POST" action="/categorias/agregar">

                @csrf

                <div class="form-group">

                    <label>Nombre de la categoría</label>

                    <input type="text" name="nombre_categoria" required>

                </div>

                <div class="form-actions">

                    <button type="submit" class="btn">Guardar</button>

                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Volver</a>

                </div>

            </form>

        </section>
    </main>

</body>

</html>