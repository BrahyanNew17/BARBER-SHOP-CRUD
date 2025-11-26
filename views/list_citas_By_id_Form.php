<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar citas por id</title>
</head>
<body>
    <h2>Buscar citas por id</h2>
      <form action="index.php?action=searchUserByName" method="get">
        <input type="hidden" name="action" value="searchUserByName">
        <label for="idCita">Id:</label>
         <input type="text" name="idCita" required>
             <input type="submit" value="buscar">
</form>

<?php if(isset($cits) && count ($cits) >0 ):?>
   <h2>Resultado de la busqueda </h2>
    <table border="1">
        <thead>
            <tr>
            <th>Fecha</th>
     
            <th>Hora</th>
            <th>Numero de Documento</th>
            <th>Id Barbero</th>
            <th>Id Estado</th>
            
            </tr>
        </thead>
    <tbody>
        <?php foreach($cits as $cit): ?>
           <tr>
            <td><?= $cit["fecha"];?></td> 
          
            <td><?= $cit["hora"];?></td>
            <td><?= $cit["numDocum"];?></td>
            <td><?= $cit["idBarbero"];?></td>
          
            <td><?= $cit["idEstado"];?></td>
         
        </tr>

            <?php endforeach; ?>
        </tbody> 
        </table>  
        <?php elseif (isset($users)): ?>
            <P>No se encontraron citas con ese id</p>
            <?php endif; ?>

        <form action ="index.php?action=dashboard" method="post">
            <button type="submit" name="action"  value="dashboard"> Dashboard</button>
        </form>
 </body>
</html>