<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Servicio</title>
     <link rel="stylesheet" href="css/styles.css">
     <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    
 
  <h1>Insertar Servicio </h1>
  <form action="index.php?action=insertServicio" method="POST" enctype="multipart/form-data">
    <label for="nombreServi">Nombre del Servicio:</label>
    <input type="text" name="nombreServi" required><br>

    <label for="precioUni">Precio Unitario:</label>
    <input type="number" name="precioUni" required><br>

    <label for="duracion">Duración:</label>
    <input type="text" name="duracion" required><br>

    
<input type="submit" value="Guardar">
        </form>

<form action="index.php?action=dashboard" method="post">
    <button type="submit" name="action" value="dashboard">Dashboard</button>

</body>
</html>