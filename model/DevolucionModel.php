<?php

class DevolucionModel {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }


    public function getPedidosCliente(string $numDocum): array {
        $sql = "SELECT 
                    vp.idVentaProducto,
                    vp.fecha,
                    vp.hora,
                    vp.total,
                    dvp.idDetalleVent,
                    dvp.cantidad,
                    dvp.precioUnitario,
                    dvp.subTotal,
                    dvp.idProducto,
                    p.nomProduc,
                    p.foto
                FROM ventaproducto vp
                INNER JOIN detalleventproducto dvp ON vp.idVentaProducto = dvp.idVentaProducto
                INNER JOIN producto p ON dvp.idProducto = p.idProducto
                WHERE vp.numDocum = ?
                ORDER BY vp.fecha DESC, vp.hora DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$numDocum]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function verificarPertenencia(int $idVenta, string $numDocum): bool {
        $stmt = $this->conn->prepare(
            "SELECT COUNT(*) FROM ventaproducto WHERE idVentaProducto = ? AND numDocum = ?"
        );
        $stmt->execute([$idVenta, $numDocum]);
        return (int)$stmt->fetchColumn() > 0;
    }

 
    public function yaExisteDevolucion(int $idVenta, int $idProducto): bool {
        $stmt = $this->conn->prepare(
            "SELECT COUNT(*) FROM devolucion 
             WHERE idVentaProducto = ? AND idProducto = ? AND estado IN ('Pendiente','Aprobada')"
        );
        $stmt->execute([$idVenta, $idProducto]);
        return (int)$stmt->fetchColumn() > 0;
    }

   
    public function crear(int $idVenta, int $idProducto, int $cantidad, string $motivo): int {
        date_default_timezone_set('America/Bogota');
        $fecha = date('Y-m-d');
        $hora  = date('H:i:s');

        $stmt = $this->conn->prepare(
            "INSERT INTO devolucion 
             (idVentaProducto, idProducto, cantidadDevuelta, motivo, estado, fechaSolicitud, horaSolicitud)
             VALUES (?, ?, ?, ?, 'Pendiente', ?, ?)"
        );
        $stmt->execute([$idVenta, $idProducto, $cantidad, $motivo, $fecha, $hora]);
        return (int)$this->conn->lastInsertId();
    }


    public function getDevolucionesCliente(string $numDocum): array {
        $sql = "SELECT 
                    d.idDevolucion,
                    d.idVentaProducto,
                    d.cantidadDevuelta,
                    d.motivo,
                    d.estado,
                    d.fechaSolicitud,
                    d.horaSolicitud,
                    d.observacion,
                    p.nomProduc,
                    p.foto
                FROM devolucion d
                INNER JOIN ventaproducto vp ON d.idVentaProducto = vp.idVentaProducto
                INNER JOIN producto p ON d.idProducto = p.idProducto
                WHERE vp.numDocum = ?
                ORDER BY d.fechaSolicitud DESC, d.horaSolicitud DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$numDocum]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTodas(): array {
        $sql = "SELECT 
                    d.*,
                    p.nomProduc,
                    c.nombreComplet,
                    c.numDocum,
                    c.correo
                FROM devolucion d
                INNER JOIN ventaproducto vp ON d.idVentaProducto = vp.idVentaProducto
                INNER JOIN producto p ON d.idProducto = p.idProducto
                LEFT JOIN cliente c ON vp.numDocum = c.numDocum
                ORDER BY 
                    CASE d.estado WHEN 'Pendiente' THEN 0 ELSE 1 END,
                    d.fechaSolicitud DESC";

        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

  
    public function actualizarEstado(int $idDevolucion, string $estado, string $observacion): void {
        date_default_timezone_set('America/Bogota');
        $fecha = date('Y-m-d');

        $stmt = $this->conn->prepare(
            "UPDATE devolucion 
             SET estado = ?, observacion = ?, fechaRespuesta = ?
             WHERE idDevolucion = ?"
        );
        $stmt->execute([$estado, $observacion, $fecha, $idDevolucion]);

        
        if ($estado === 'Aprobada') {
            $stmtDev = $this->conn->prepare(
                "SELECT idProducto, cantidadDevuelta FROM devolucion WHERE idDevolucion = ?"
            );
            $stmtDev->execute([$idDevolucion]);
            $row = $stmtDev->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $stmtStock = $this->conn->prepare(
                    "UPDATE producto SET cantidad = cantidad + ? WHERE idProducto = ?"
                );
                $stmtStock->execute([$row['cantidadDevuelta'], $row['idProducto']]);
            }
        }
    }

    
    public function getVentaParaFactura(int $idVenta, string $numDocum): ?array {
        
        if (!$this->verificarPertenencia($idVenta, $numDocum)) return null;

        $sqlVenta = "SELECT vp.*, c.nombreComplet, c.correo, c.direccion, c.Telefono
                     FROM ventaproducto vp
                     INNER JOIN cliente c ON vp.numDocum = c.numDocum
                     WHERE vp.idVentaProducto = ?";
        $stmt = $this->conn->prepare($sqlVenta);
        $stmt->execute([$idVenta]);
        $venta = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$venta) return null;

        $sqlItems = "SELECT dvp.cantidad, dvp.precioUnitario, dvp.subTotal, p.nomProduc
                     FROM detalleventproducto dvp
                     INNER JOIN producto p ON dvp.idProducto = p.idProducto
                     WHERE dvp.idVentaProducto = ?";
        $stmtI = $this->conn->prepare($sqlItems);
        $stmtI->execute([$idVenta]);
        $venta['items'] = $stmtI->fetchAll(PDO::FETCH_ASSOC);

        return $venta;
    }
}