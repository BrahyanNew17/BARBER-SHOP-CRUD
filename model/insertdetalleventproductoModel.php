<?php
class insertdetalleventproductoModel
{
    private $conn;
    private $table = 'detalleventproducto';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function insertdetalleventproducto($cantidad, $precioUnitario, $subTotal, $idProducto, $idVentaProducto)
    {
        
        $query = "INSERT INTO " . $this->table . " (idVentaProducto, cantidad, precioUnitario, subTotal, idProducto) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$idVentaProducto, $cantidad, $precioUnitario, $subTotal, $idProducto]);

        
        $sqlStock = "UPDATE producto SET cantidad = cantidad - ? WHERE idProducto = ? AND cantidad >= ?";
        $stmtStock = $this->conn->prepare($sqlStock);
        $stmtStock->execute([$cantidad, $idProducto, $cantidad]);
    }
    public function getVentasParaSelect()
    {
        $query = "SELECT idVentaProducto, fecha, hora, total, numDocum FROM ventaproducto";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getDetalleVentProducto()
    {
        $query = "SELECT 
                dvp.idDetalleVent,
                dvp.cantidad,
                dvp.precioUnitario,
                dvp.subTotal,
                p.idProducto,
                p.nomProduc AS nomProduc,
                vp.idVentaProducto,
                vp.fecha,
                vp.hora,
                vp.total,
                vp.numDocum
              FROM detalleventproducto dvp
              INNER JOIN producto p ON dvp.idProducto = p.idProducto
              INNER JOIN ventaproducto vp ON dvp.idVentaProducto = vp.idVentaProducto";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    public function getDetalleVentProductoById($idVentaProducto)
    {
        $sql = "SELECT 
    dvp.idDetalleVent,  
                dvp.cantidad,
                dvp.precioUnitario,
                dvp.subTotal,
                p.idProducto,
                p.nomProduc AS nomProduc,
                vp.idVentaProducto,
                vp.fecha,
                vp.hora,
                vp.total,
                vp.numDocum
              FROM detalleventproducto dvp
              INNER JOIN producto p ON dvp.idProducto = p.idProducto
              INNER JOIN ventaproducto vp ON dvp.idVentaProducto = vp.idVentaProducto
              WHERE dvp.idVentaProducto LIKE ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["%" . $idVentaProducto . "%"]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function eliminar($idDetalleVent)
    {
        $query = "DELETE FROM " . $this->table . " WHERE idDetalleVent=?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$idDetalleVent]);
    }

    public function actualizar(
        $idDetalleVent,
        $cantidad,
        $precioUnitario,
        $subTotal,
        $idProducto,
        $idVentaProducto
    ) {
        $query = "UPDATE detalleventproducto
              SET cantidad = ?, precioUnitario = ?, subTotal = ?, idProducto = ?, idVentaProducto = ?
              WHERE idDetalleVent = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$cantidad, $precioUnitario, $subTotal, $idProducto, $idVentaProducto, $idDetalleVent]);
    }
}