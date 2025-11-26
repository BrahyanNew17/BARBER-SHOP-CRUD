<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Proveedor</title>
     <link rel="stylesheet" href="css/styles.css">
     <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    
 
  <h1>Insertar Proveedor </h1>
  <form action="index.php?action=insertProveedor" method="POST" enctype="multipart/form-data">
    <label for="NITproveedor">NIT del Proveedor:</label>
    <input type="text" name="NITproveedor" required><br>

    <label for="nombreProveedor">Nombre del Proveedor:</label>
    <input type="text" name="nombreProveedor" required><br>

    <label for="direcProveedor">Dirección del Proveedor:</label>
    <input type="text" name="direcProveedor" required><br>

    <label for="telefono">Teléfono:</label>
    <input type="text" name="telefono" required><br>

<input type="submit" value="Guardar">
        </form>

<form action="index.php?action=dashboard" method="post">
    <button type="submit" name="action" value="dashboard">Dashboard</button>
  </form>

</body>
</html>