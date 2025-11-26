<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar proveedor por nombre</title>
</head>
<body>
    <h2>Buscar proveedor por nombre</h2>
      <form action="index.php?action=searchProveedorByName" method="get">
        <input type="hidden" name="action" value="searchProveedorByName">
        <label for="name">Nombre:</label>
         <input type="text" name="name" required>
             <input type="submit" value="buscar">
</form>

<?php if(isset($proveedors) && count ($proveedors) >0 ):?>
   <h2>Resultado de la busqueda </h2>
    <table border="1">
        <thead>
            <tr>
             <th>NIT del Proveedor</th>
     
            <th>Nombre del Proveedor</th>
            <th>Dirección del Proveedor</th>
            <th>Teléfono</th>
            
            </tr>
        </thead>
    <tbody>
       <?php foreach($proveedors as $proveedor): ?>
           <tr>
             <td><?= $proveedor["NITproveedor"];?></td> 
            <td><?= $proveedor["nombreProveedor"];?></td>
            <td><?= $proveedor["direcProveedor"];?></td>
            <td><?= $proveedor["telefono"];?></td>
          
        </tr>

            <?php endforeach; ?>
        </tbody> 
        </table>  
        <?php elseif (isset($users)): ?>
            <P>No se encontraron proveedores con ese nombre</p>
            <?php endif; ?>

        <form action ="index.php?action=dashboard" method="post">
            <button type="submit" name="action"  value="dashboard"> Dashboard</button>
        </form>
 </body>
</html>