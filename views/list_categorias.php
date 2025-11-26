<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categoria</title>
</head>
<body>
    <h2>Categoria</h2>

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
        <form action ="index.php?action=dashboard" method="post">
            <button type="submit" name="action"  value="dashboard"> Dashboard</button>
        </form>
 </body>
</html>