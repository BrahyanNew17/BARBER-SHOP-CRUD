<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Producto</title>
</head>
<body>
      <h1>Insertar Producto</h1>
      <form action="index.php?action=insertProducto" method="POST" enctype="multipart/form-data">

<label for="nomProducto" id="nom">Nombre del Producto:</label>
        <input type="text" name="nomProducto" required><br>

        <label for="precioUni">Precio Unitario:</label>
        <input type="number" name="precioUni" required><br>

        <label for="Cantidad">Cantidad:</label>
        <input type="number" name="Cantidad" required><br>

        <label for="idMarca">ID Marca:</label>
        <input type="number" name="idMarca" required><br>

        <label for="idCategoria">ID Categoria:</label>
        <input type="number" name="idCategoria" required><br>

    <button type="submit">Enviar</button>
</form>

<form action="index.php?action=dashboard" method="POST">
    <button type="submit">Dashboard</button>
</form>

</body>
</html>