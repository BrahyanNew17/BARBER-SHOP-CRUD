<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Cliente</title>
     <link rel="stylesheet" href="css/styles.css">
     <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    
 
  <h1>Insertar Cliente </h1>
  
  <form action="index.php?action=insertUser"method="POST" enctype="multipart/form-data">
    <label for="numDocum">Numero de Documento:</label>
    <input type="text" name="numDocum" required><br>

        <label for="nombreComplet">Nombre Completo:</label>
        <input type="text" name="nombreComplet" required><br>

        <label for="Telefono">Telefono:</label>
        <input type="number" name="Telefono" required><br>

         <label for="direccion">Direccion:</label>
        <input type="text" name="direccion" required><br>

        <label for="correo">Correo:</label>
        <input type="email" name="correo" required><br>

        <label for="idtipoDoc">Id Tipo De Documento:</label>

     <select name="idtipoDoc" id="">
        <?php foreach ($docums as $docum): ?>
            <option value="<?= $docum['idtipoDoc']; ?>"><?=$docum['tipoDocumento']; ?></option>
            <?php endforeach; ?>
        </select><br> 
<input type="submit" value="Guardar">
        </form>

<form action="index.php?action=dashboard" method="post">
    <button type="submit" name="action" value="dashboard">Dashboard</button>

</body>
</html>