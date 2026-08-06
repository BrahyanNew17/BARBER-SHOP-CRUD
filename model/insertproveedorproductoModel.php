<?php
class insertproveedorproductoModel
{
    private $conn;
    private $table = 'proveedorproducto';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function insertproveedorproducto($NITproveedor, $idProducto)
    {
        $query = "INSERT INTO " . $this->table . " (NITproveedor, idProducto) VALUES(?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$NITproveedor, $idProducto]);
    }

    //Metodo para obtener todos los productos
    public function getproveedorproductos()
    {
        $query = "SELECT 
                pp.idProveProduc AS idProveProduc,
                pr.NITproveedor AS NITproveedor,
                pr.nombreProveedor AS nombreProveedor,
                p.idProducto AS idProducto,
                p.nomProduc AS nomProduc
              FROM proveedorproducto pp
              INNER JOIN proveedor pr ON pp.NITproveedor = pr.NITproveedor
              INNER JOIN producto p ON pp.idProducto = p.idProducto";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    public function getproveedorproductobyidproveproduc($idProveProduc)
    {
        $sql = "SELECT 
                pp.idProveProduc,
               pr.NITproveedor AS NITproveedor,
                pr.nombreProveedor AS nombreProveedor,
                p.idProducto AS idProducto,
                p.nomProduc AS nomProduc
              FROM proveedorproducto pp
              INNER JOIN proveedor pr ON pp.NITproveedor = pr.NITproveedor
              INNER JOIN producto p ON pp.idProducto = p.idProducto
              WHERE pp.idProveProduc LIKE ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["%" . $idProveProduc . "%"]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function listproveedorproducto()
    {
        return $this->getproveedorproductos();
    }
    public function eliminar($idProveProduc)
    {
        $query = "DELETE FROM " . $this->table . " WHERE idProveProduc=?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$idProveProduc]);
    }
}