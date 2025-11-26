<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Marca</title>
     <link rel="stylesheet" href="css/styles.css">
     <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    
 
  <h1>Insertar Marca </h1>
 <form action="index.php?action=insertMarca" method="POST">
    <label for="marca">Insertar nueva marca:</label>
    <input type="text" name="marca" required><br>
    <input type="submit" value="Guardar">
</form>


<form action="index.php?action=dashboard" method="post">
    <button type="submit" name="action" value="dashboard">Dashboard</button>

</body>
</html>