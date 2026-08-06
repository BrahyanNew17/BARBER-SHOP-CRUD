<?php
class insertProductoModel
{
    private $conn;
    private $table = 'producto';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function insertProducto($nomProduc, $descripcion, $foto, $precioUni, $cantidad, $idMarca, $idCategoria)
    {
        $query = "INSERT INTO " . $this->table . " (nomProduc, descripcion, foto, precioUni, cantidad, idMarca, idCategoria
) VALUES(?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$nomProduc, $descripcion, $foto, $precioUni, $cantidad, $idMarca, $idCategoria]);
    }

    public function getProductos()
    {
        $query = "SELECT p.idProducto,
                     p.nomProduc,
                     p.descripcion,
                     p.foto,
                     p.precioUni,
                     p.cantidad,
                     p.idMarca,
                     p.idCategoria,
                     m.marca AS marca,
                     c.categoria AS categoria
              FROM producto p
              INNER JOIN marca m ON p.idMarca = m.idMarca
              INNER JOIN categoria c ON p.idCategoria = c.idCategoria";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductoByProducto($nomProduc)
    {
        $sql = "SELECT 
            p.idProducto,
            p.nomProduc,
            p.descripcion,
            p.foto,
            p.precioUni,
            p.cantidad,
            p.idMarca,
            p.idCategoria,
            m.marca AS marca,
            c.categoria AS categoria
        FROM producto p
        INNER JOIN marca m ON p.idMarca = m.idMarca
        INNER JOIN categoria c ON p.idCategoria = c.idCategoria
        WHERE p.nomProduc LIKE ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["%" . $nomProduc . "%"]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


public function eliminar($nomProduc)
{
    
    $stmt = $this->conn->prepare("SELECT idProducto FROM producto WHERE nomProduc = ?");
    $stmt->execute([$nomProduc]);
    $prod = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($prod) {
        $idProducto = $prod['idProducto'];

        $this->conn->prepare("DELETE FROM devolucion WHERE idProducto = ?")->execute([$idProducto]);
        $this->conn->prepare("DELETE FROM detalleventproducto WHERE idProducto = ?")->execute([$idProducto]);
        $this->conn->prepare("DELETE FROM proveedorproducto WHERE idProducto = ?")->execute([$idProducto]);
    }

   
    $query = "DELETE FROM " . $this->table . " WHERE nomProduc=?";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$nomProduc]);
}

    public function actualizarProducto($idProducto, $nomProduc, $descripcion, $precioUni, $cantidad, $idMarca, $idCategoria, $foto = null)
    {
        if ($foto) {
            $query = "UPDATE " . $this->table . " 
                  SET nomProduc = ?, descripcion = ?, precioUni = ?, cantidad = ?, idMarca = ?, idCategoria = ?, foto = ?
                  WHERE idProducto = ?";
            $stmt = $this->conn->prepare($query);
            return $stmt->execute([$nomProduc, $descripcion, $precioUni, $cantidad, $idMarca, $idCategoria, $foto, $idProducto]);
        } else {
            $query = "UPDATE " . $this->table . " 
                  SET nomProduc = ?, descripcion = ?, precioUni = ?, cantidad = ?, idMarca = ?, idCategoria = ?
                  WHERE idProducto = ?";
            $stmt = $this->conn->prepare($query);
            return $stmt->execute([$nomProduc, $descripcion, $precioUni, $cantidad, $idMarca, $idCategoria, $idProducto]);
        }
    }


    public function buscarProducto($texto)
    {
        $sql = "SELECT * FROM {$this->table} 
                WHERE nomProduc LIKE :texto";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":texto", "%" . $texto . "%", PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}