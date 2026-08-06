<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once __DIR__ . '/../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php?action=recuperar_password");
    exit();
}

$correo = isset($_POST['correo']) ? trim(strtolower($_POST['correo'])) : '';

if (empty($correo)) {
    header("Location: index.php?action=recuperar_password&error=empty_email");
    exit();
}

if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    header("Location: index.php?action=recuperar_password&error=invalid_email");
    exit();
}


$database = new Database();
$db = $database->getConnection();

if (!$db) {
    error_log("PasswordResetController: no se pudo conectar a la BD");
    header("Location: index.php?action=recuperar_password&error=system_error");
    exit();
}


$stmt = $db->prepare("SELECT numDocum, correo, nombreComplet FROM cliente WHERE correo = ?");
$stmt->execute([$correo]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
   
    header("Location: index.php?action=recuperar_password&message=check_email");
    exit();
}

$token   = bin2hex(random_bytes(32));                             
$expires = date("Y-m-d H:i:s", strtotime("+1 hour"));


$stmt = $db->prepare("UPDATE cliente SET reset_token = ?, reset_expires = ? WHERE correo = ?");

try {
    $stmt->execute([$token, $expires, $correo]);
} catch (PDOException $e) {
    error_log("PasswordResetController – error al guardar token: " . $e->getMessage());
    header("Location: index.php?action=recuperar_password&error=system_error");
    exit();
}

$protocol  = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http';
$host      = $_SERVER['HTTP_HOST'];


$scriptPath = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']);

$projectPath = dirname($scriptPath);

$basePath = ($projectPath !== '/') ? $projectPath : '';

$resetLink = $protocol . "://" . $host . $basePath . "/index.php?action=resetPassword&token=" . $token;



$_SESSION['emailData'] = [
    'to_email'   => $user['correo'],
    'to_name'    => isset($user['nombreComplet']) ? $user['nombreComplet'] : 'Usuario',
    'reset_link' => $resetLink,
    'document'   => (string)$user['numDocum']
];


header("Location: index.php?action=sendMailView");
exit();
?>