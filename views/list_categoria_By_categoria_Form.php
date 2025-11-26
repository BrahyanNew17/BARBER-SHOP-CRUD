<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar categoria por nombre</title>
</head>
<body>
    <h2>Buscar categoria por nombre</h2>
      <form action="index.php?action=searchcategorByName" method="post">
        <input type="hidden" name="action" value="searchcategorByName">
        <label for="name">Categoria:</label>
         <input type="text" name="name" required>
             <input type="submit" value="buscar">
</form>

<?php if(isset($categors) && count ($categors) >0 ):?>
   <h2>Resultado de la busqueda </h2>
    <table border="1">
        <thead>
             <tr>
            <th>Id Categoria</th>
     
            <th>Categoria</th>

            </tr>
        </thead>
    <tbody>
     <?php foreach($categors as $categor): ?>
           <tr>
             <td><?= $categor["idCategoria"];?></td> 
          
            <td><?= $categor["categoria"];?></td>
           
          
        </tr>

            <?php endforeach; ?>
        </tbody> 
        </table>  
        <?php elseif (isset($categors)): ?>
            <P>No se encontraron categorias con ese nombre</p>
            <?php endif; ?>

        <form action ="index.php?action=dashboard" method="post">
            <button type="submit" name="action"  value="dashboard"> Dashboard</button>
        </form>
 </body>
</html>