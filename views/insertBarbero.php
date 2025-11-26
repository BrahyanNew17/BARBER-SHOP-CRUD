<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Barbero</title>
     <link rel="stylesheet" href="css/styles.css">
     <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
      <h1>Insertar Barbero </h1>
      <form action="index.php?action=insertBarbero" method="POST" enctype="multipart/form-data">

<label for="nomCompleto" id="nomCompleto">Nombre:</label>
        <input type="text" name="nomCompleto" required><br>

        <label for="telefono">Telefono:</label>
        <input type="text" name="telefono" required><br>

        <label for="correo">Correo:</label>
        <input type="correo" name="correo" required><br>

         <label for="foto">Foto:</label>
        <input type="file" name="foto" required><br>

    <button type="submit">Enviar</button>
</form>

<form action="index.php?action=dashboard" method="POST">
    <button type="submit">Dashboard</button>
</form>

</body>
</html>