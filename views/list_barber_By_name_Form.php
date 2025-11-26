<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar barbero por nombre</title>
</head>
<body>
    <h2>Buscar barbero por nombre</h2>
      <form action="index.php?action=searchBarberByName" method="get">
        <input type="hidden" name="action" value="searchBarberByName">
        <label for="name">Nombre:</label>
         <input type="text" name="name" required>
             <input type="submit" value="buscar">
</form>

<?php if(isset($barbers) && count ($barbers) >0 ):?>
   <h2>Resultado de la busqueda </h2>
    <table border="1">
        <thead>
            <tr>
            <th>Nombre Completo</th>
     
            <th>Telefono</th>
            <th>Correo</th>
            <th>Foto</th>
            
            </tr>
        </thead>
    <tbody>
       <?php foreach($barbers as $barber): ?>
           <tr>
             <td><?= $barber["nomCompleto"];?></td> 
          
            <td><?= $barber["telefono"];?></td>
            <td><?= $barber["correo"];?></td>
          
           <td>
    <img src="photo/<?= $barber['foto']; ?>" width="80" height="80">
</td>
          
        </tr>

            <?php endforeach; ?>
        </tbody> 
        </table>  
        <?php elseif (isset($users)): ?>
            <P>No se encontraron barberos con ese nombre</p>
            <?php endif; ?>

        <form action ="index.php?action=dashboard" method="post">
            <button type="submit" name="action"  value="dashboard"> Dashboard</button>
        </form>
 </body>
</html>