<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barberos</title>
</head>
<body>
    <h2>Barberos</h2>

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
            <td> <img src="photo/<?= $barber['foto']; ?>" width="80" height="80"></td>
        </tr>

        

            <?php endforeach; ?>
        </tbody> 
        </table>  
        <form action ="index.php?action=dashboard" method="post">
            <button type="submit" name="action"  value="dashboard"> Dashboard</button>
        </form>
 </body>
</html>