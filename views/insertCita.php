<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Cita</title>
     <link rel="stylesheet" href="css/styles.css">
     <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    
 
  <h1>Insertar Cita </h1>
  <form action="index.php?action=insertCita" method="POST" enctype="multipart/form-data">
    <label for="fecha">Fecha:</label>
    <input type="date" name="fecha" required><br>

    <label for="hora">Hora:</label>
    <input type="time" name="hora" required><br>

    <label for="numDocum">Numero de Documento:</label>
    <input type="text" name="numDocum" required><br>

    <label for="idBarbero">Id Barbero:</label>
    <input type="num" name="idBarbero" required><br>

     <label for="idEstado">Id Estado:</label>
    <input type="num" name="idEstado" required><br>

<input type="submit" value="Guardar">
        </form>

<form action="index.php?action=dashboard" method="post">
    <button type="submit" name="action" value="dashboard">Dashboard</button>
  </form>

</body>
</html>