<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipo de Documento</title>
</head>
<body>
    <h2>Tipo de Documento</h2>

    <table border="1">
        <thead>
            <tr>
            <th>ID tipoDoc</th>

            <th>Tipo de Documento</th>
           
            </tr>
        </thead>
    <tbody>
        <?php foreach($tips as $tip): ?>
           <tr>
             <td><?= $tip["idtipoDoc"];?></td> 
          
            <td><?= $tip["tipoDocumento"];?></td>
          
        </tr>

            <?php endforeach; ?>
        </tbody> 
        </table>  
        <form action ="index.php?action=dashboard" method="post">
            <button type="submit" name="action"  value="dashboard"> Dashboard</button>
        </form>
 </body>
</html>