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

            <h2 class="h2">Editar producto</h2>

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

            <form method="POST" action="/inventario/editar/{{ $producto->id_producto }}" class="form-producto" enctype="multipart/form-data">

                @csrf

                <div class="form-group">
                    <label>Nombre del producto</label>
                    <input type="text" name="nombre" value="{{ $producto->nombre }}" required>
                </div>

                <div class="form-group">
                    <label>Descripción</label>
                    <input type="text" name="descripcion" value="{{ $producto->descripcion }}" required>
                </div>

                <div class="form-group">

                    <label>Imagen del producto</label>

                    <input type="file" name="imagen" accept="image/*" required>

                    @if($producto->imagen)
                    <div style="margin-top:10px">
                        <img src="{{ asset('storage/'.$producto->imagen) }}" width="120">
                    </div>
                    @endif

                </div>

                <div class="form-row">

                    <div class="form-group">
                        <label>Precio</label>
                        <input type="number" step="0.01" min="1" name="precio" value="{{ $producto->precio }}" required>
                    </div>

                    <div class="form-group">
                        <label>Stock</label>
                        <input type="number" min="0" name="stock" value="{{ $producto->stock }}" required>
                    </div>

                </div>

                <div class="form-group">

                    <label>Categoría</label>

                    <div style="display:flex; gap:10px; align-items:center;">

                        <select name="id_categoria" required>

                            @foreach($categorias as $c)

                            <option value="{{ $c->id_categoria }}"
                                @if($producto->id_categoria == $c->id_categoria) selected @endif>

                                {{ $c->nombre_categoria }}

                            </option>

                            @endforeach

                        </select>

                        <a href="/categorias/agregar" class="btn">+</a>

                    </div>

                </div>

                <div class="form-group">

                    <label>Estado del producto</label>

                    <select name="id_estado">

                        @foreach($estados as $e)

                        <option value="{{ $e->id_estado }}"
                            @if($producto->id_estado == $e->id_estado) selected @endif>

                            {{ $e->nombre_estado }}

                        </option>

                        @endforeach

                    </select>

                </div>

                <div class="form-actions">

                    <button type="submit" class="btn">Guardar cambios</button>

                    <a href="/inventario" class="btn">Volver</a>

                </div>

            </form>

        </section>
    </main>
</body>

</html>