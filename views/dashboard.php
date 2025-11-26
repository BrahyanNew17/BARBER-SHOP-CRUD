<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
     <link rel="stylesheet" href="css/styles.css">
     <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">

     
</head>
<body>
   <div class="background">
    <h1>Dashboard</h1>
</div>

<div class="contenedor-principal">
<div class="insercion">


      <h1>Inserciones de Datos</h1>

    



    <ul>
    <li><form action="index.php?action=insertUser" method="GET">
        <button type="submit" name="action" value="insertUser">Insertar Cliente</button>
    </form>
    </li>
    

 <li>
     <form action= "index.php?action=insertTipDocum"   method="GET">
           <button type="submit" name="action" value="insertTipDocum">Insertar Tipo De Documento</button>
    </form>
 <li>
    
    <form action= "index.php?action=insertBarbero"   method="GET">
        <button type="submit" name="action" value="insertBarbero">Insertar Barbero</button>
    </form>
 <li>
    <form action= "index.php?action=insertCategoria"   method="GET">
          <button type="submit" name="action" value="insertCategoria">Insertar Categoria</button>
    </form>
 <li>
    <form action= "index.php?action=insertMarca"   method="GET">
          <button type="submit" name="action" value="insertMarca">Insertar Marca</button>
    </form>
 <li>
    <form action= "index.php?action=insertProveedor"   method="GET">
          <button type="submit" name="action" value="insertProveedor">Insertar Proveedor</button>
    </form>
 <li>
     <form action= "index.php?action=insertServicio"   method="GET">
          <button type="submit" name="action" value="insertServicio">Insertar Servicio</button>
    </form>
 <li>
    <form action= "index.php?action=insertestado"   method="GET">
          <button type="submit" name="action" value="insertestado">Insertar Estado</button>
    </form>
 <li>
     <form action= "index.php?action=insertProducto"   method="GET">
          <button type="submit" name="action" value="insertProducto">Insertar Producto</button>
    </form>
 <li>
    <form action= "index.php?action=insertCita"   method="GET">
          <button type="submit" name="action" value="insertCita">Insertar Cita</button>
</li>
</div>

</ul>
<div class="consultas">
    <h1>Consultas de Datos</h1>
    <ul>
        <li>
    <form  action="index.php?action=listUsers" method="GET">
    <button type="submit" name="action" value="listUsers">Consultar cliente</button>
</form>
</li>
<li>
<form  action="index.php?action=searchUserByName" method="GET">
    <button type="submit" name="action" value="searchUserByName">Consulta de clientes por busqueda</button>
</form>
</li>

  <li>
    <form  action="index.php?action=listTipDocum" method="GET">
    <button type="submit" name="action" value="listTipDocum">Consultar Tipo de Documento</button>
</form>
</li>

    <form  action="index.php?action=listbarbers" method="GET">
    <button type="submit" name="action" value="listbarbers">Consultar barbero</button>
    </form>
    <form  action="index.php?action=searchBarberByName" method="GET">
    <button type="submit" name="action" value="searchBarberByName">Consulta de barberos por busqueda</button>
</form>
<form  action="index.php?action=listcategors" method="GET">
    <button type="submit" name="action" value="listcategors">Consultar categoria</button>
    </form>
            <form  action="index.php?action=searchcategorByName" method="GET">
            <button type="submit" name="action" value="searchcategorByName">Consulta de categorias por busqueda</button>
        </form>
<form  action="index.php?action=listMarca" method="GET">
    <button type="submit" name="action" value="listMarca">Consultar marca</button>
    </form>
        <form  action="index.php?action=searchMarcaBymarca" method="GET">
            <button type="submit" name="action" value="searchMarcaBymarca">Consulta de marcas por busqueda</button>
        </form>

        <form  action="index.php?action=listProveedores" method="GET">
    <button type="submit" name="action" value="listProveedores">Consultar proveedor</button>
    </form>
        <form  action="index.php?action=searchProveedorByName" method="GET">
            <button type="submit" name="action" value="searchProveedorByName">Consulta de proveedores por busqueda</button>
        </form>
</ul>

</div>

    <div class="eliminar">
    <ul>
            <h1>Eliminacion de Datos</h1>
    <li><form action="index.php?action=openFormDelete" method="GET">
        <button type="submit" name="action" value="openFormDelete">Eliminar Usuario por Número de Documento</button>
    </form>
</li>
</ul>
</div>

</div>
</body>
</html>