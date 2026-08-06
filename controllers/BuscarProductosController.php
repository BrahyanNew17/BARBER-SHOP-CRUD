<?php
session_start();
require_once '../config/database.php';
require_once '../model/insertProductoModel.php';

header('Content-Type: application/json');

$database = new Database();
$db = $database->getConnection();
$productoModel = new insertProductoModel($db);

$busqueda = isset($_GET['busqueda']) ? trim($_GET['busqueda']) : '';

if ($busqueda === '') {
    // Si está vacío, traer todos los productos
    $stmt = $productoModel->getProductos();
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Buscar productos por nombre
    $productos = $productoModel->buscarProducto($busqueda);
}

// Devolver JSON
echo json_encode([
    'success' => true,
    'productos' => $productos,
    'total' => count($productos)
]);