<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citas</title>
</head>
<body>
    <h2>Citas</h2>

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
        <form action ="index.php?action=dashboard" method="post">
            <button type="submit" name="action"  value="dashboard"> Dashboard</button>
        </form>
 </body>
</html>