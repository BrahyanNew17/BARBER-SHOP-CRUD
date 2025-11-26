<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marca</title>
</head>
<body>
    <h2>Marcas </h2>

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
        <form action ="index.php?action=dashboard" method="post">
            <button type="submit" name="action"  value="dashboard"> Dashboard</button>
        </form>
 </body>
</html>