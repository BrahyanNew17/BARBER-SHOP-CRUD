<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Categoria</title>
     <link rel="stylesheet" href="css/styles.css">
     <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    
 
  <h1>Insertar Categoria </h1>
  <form action="index.php?action=insertCategoria" method="POST">
    <label for="categoria">Nueva Categoria:</label>
    <input type="text" name="categoria">
    <button type="submit">Enviar</button>
</form>

<form action="index.php?action=dashboard" method="POST">
    <button type="submit">Dashboard</button>
</form>
</body>
</html>