<html lang="es">
<body>

<h1>Eliminar Usuario por Número de Documento</h1>

<form action="index.php?action=openFormDelete" method="POST">
        <input type="hidden" name="action" value="openFormDelete">
        <label for=" numDocum">Numero de Documento:</label>
         <input type="text" name="numDocum" required>
             <input type="submit" value="Eliminar Usuario">
</form>

<h1>Lista de Usuarios</h1>

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
</table>

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
