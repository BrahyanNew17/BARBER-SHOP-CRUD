<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
</head>
<body>
    <h2>Usuarios</h2>

    <table border="1">
        <thead>
            <tr>
            <th>Número de Documento</th>
     
            <th>Nombre</th>
            <th>Telefono</th>
            <th>Direccion</th>
            <th>Correo</th>
            <th>ID tipo Documento</th>
            </tr>
        </thead>
    <tbody>
        <?php foreach($users as $user): ?>
           <tr>
             <td><?= $user["numDocum"];?></td> 
          
            <td><?= $user["nombreComplet"];?></td>
            <td><?= $user["Telefono"];?></td>
            <td><?= $user["direccion"];?></td>
          
            <td><?= $user["correo"];?></td>
          
            <td><?= $user["idtipoDoc"]; ?></td>
        </tr>

            <?php endforeach; ?>
        </tbody> 
        </table>  
        <form action ="index.php?action=dashboard" method="post">
            <button type="submit" name="action"  value="dashboard"> Dashboard</button>
        </form>
 </body>
</html>