<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar marca por nombre de Marca</title>
</head>
<body>
    <h2>Buscar marca por nombre de Marca</h2>
      <form action="index.php?action=searchMarcaBymarca" method="get">
        <input type="hidden" name="action" value="searchMarcaBymarca">
        <label for="name">Marca:</label>
         <input type="text" name="name" required>
             <input type="submit" value="buscar">
</form>

<?php if(isset($marcs) && count ($marcs) >0 ):?>
   <h2>Resultado de la busqueda </h2>
    <table border="1">
        <thead>
            <tr>
            <th>ID Marca</th>
            <th>Marca</th>
            </tr>
        </thead>
    <tbody>
        <?php foreach($marcs as $marc): ?>
           <tr>
            <td><?= $marc["idMarca"];?></td>
            <td><?= $marc["marca"];?></td>
        </tr>

            <?php endforeach; ?>
        </tbody>
        </table>
        <?php elseif (isset($marcs)): ?>
            <P>No se encontraron marcas con ese nombre</p>
            <?php endif; ?>

        <form action ="index.php?action=dashboard" method="post">
            <button type="submit" name="action"  value="dashboard"> Dashboard</button>
        </form>
 </body>
</html>