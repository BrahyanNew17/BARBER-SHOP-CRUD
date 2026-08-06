<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once __DIR__ . '/../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php?action=login");
    exit();
}

$token    = isset($_POST['token'])    ? trim($_POST['token'])    : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';

if (empty($token) || empty($password)) {
    header("Location: index.php?action=recuperar_password&error=system_error");
    exit();
}

if (strlen($password) < 6) {
    
    header("Location: index.php?action=resetPassword&token=" . urlencode($token) . "&error=short");
    exit();
}

$database = new Database();
$db = $database->getConnection();

if (!$db) {
    header("Location: index.php?action=recuperar_password&error=system_error");
    exit();
}


$stmt = $db->prepare("SELECT numDocum FROM cliente WHERE reset_token = ? AND reset_expires > NOW()");
$stmt->execute([$token]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    header("Location: index.php?action=recuperar_password&error=token_invalid");
    exit();
}
    

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);


$stmt = $db->prepare("UPDATE cliente SET password = ?, reset_token = NULL, reset_expires = NULL WHERE numDocum = ?");

try {
    $stmt->execute([$hashedPassword, $user['numDocum']]);

   
   header("Location: index.php?action=login1&success=password_changed");
exit();


} catch (PDOException $e) {
    error_log("UpdatePasswordController – error al actualizar contraseña: " . $e->getMessage());
    header("Location: index.php?action=recuperar_password&error=system_error");
    exit();
}
?>