<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proveedor</title>
</head>
<body>
    <h2>Proveedores</h2>

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
         <?php foreach($proveedors as $prov): ?>
           <tr>
            <td><?= $prov["NITproveedor"];?></td> 
            <td><?= $prov["nombreProveedor"];?></td>
            <td><?= $prov["direcProveedor"];?></td>
            <td><?= $prov["telefono"];?></td>
           </tr>
         <?php endforeach; ?>
        </tbody>
        </table>  
        <form action ="index.php?action=dashboard" method="post">
            <button type="submit" name="action"  value="dashboard"> Dashboard</button>
        </form>
 </body>
</html>