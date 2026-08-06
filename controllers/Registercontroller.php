<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../config/database.php';

class RegisterController
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        
       
        if (!$this->db) {
            die("Error: No se pudo conectar a la base de datos");
        }
    }

    public function showRegisterForm()
    {
        try {
            $stmt = $this->db->prepare("SELECT idtipoDoc, tipoDocumento FROM tipodocumento ORDER BY tipoDocumento");
            $stmt->execute();
            $docums = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al cargar tipos de documento: " . $e->getMessage());
            $docums = [];
        }
        
        include __DIR__ . '/../views/register.php';
    }

    public function registerUser()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?action=register");
            exit();
        }

       
        $nombreComplet = trim($_POST['nombreComplet'] ?? '');
        $numDocum = trim($_POST['numDocum'] ?? '');
        $idtipoDoc = trim($_POST['idtipoDoc'] ?? '');
        $Telefono = trim($_POST['Telefono'] ?? '');
        $direccion = trim($_POST['direccion'] ?? '');
        $correo = trim(strtolower($_POST['correo'] ?? ''));
        $password = $_POST['password'] ?? '';
        $password_confirm = $_POST['password_confirm'] ?? '';

        if (empty($nombreComplet) || empty($numDocum) || empty($idtipoDoc) || 
            empty($Telefono) || empty($direccion) || empty($correo) || 
            empty($password) || empty($password_confirm)) {
            $this->redirectWithError('empty_fields', $_POST);
            return;
        }

       
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $this->redirectWithError('invalid_email', $_POST);
            return;
        }

        
        if (strlen($password) < 6) {
            $this->redirectWithError('password_short', $_POST);
            return;
        }

        
        if ($password !== $password_confirm) {
            $this->redirectWithError('passwords_dont_match', $_POST);
            return;
        }

        
        if (strlen(preg_replace('/\D/', '', $Telefono)) < 7) {
            $this->redirectWithError('invalid_phone', $_POST);
            return;
        }

        
        if ($this->emailExists($correo)) {
            $this->redirectWithError('email_exists', $_POST);
            return;
        }

        
        if ($this->documentExists($numDocum)) {
            $this->redirectWithError('document_exists', $_POST);
            return;
        }

     
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        
        try {
            $query = "INSERT INTO cliente 
                      (numDocum, nombreComplet, Telefono, direccion, correo, password, idtipoDoc, idRol) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, 3)";
            
            $stmt = $this->db->prepare($query);
            $result = $stmt->execute([
                $numDocum,
                $nombreComplet,
                $Telefono,
                $direccion,
                $correo,
                $hashedPassword,
                $idtipoDoc
            ]);

            if ($result) {
                
                header("Location: index.php?action=login1&success=1&registered=1");
                exit();
            } else {
                error_log("Error: No se pudo insertar el usuario");
                $this->redirectWithError('system_error', $_POST);
            }

        } catch (PDOException $e) {
            error_log("Error en registro: " . $e->getMessage());
            error_log("SQL State: " . $e->getCode());
            $this->redirectWithError('system_error', $_POST);
        }
    }

    
    private function emailExists($correo)
    {
        try {
            $query = "SELECT COUNT(*) as count FROM cliente WHERE correo = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$correo]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $result['count'] > 0;
        } catch (PDOException $e) {
            error_log("Error al verificar correo: " . $e->getMessage());
            return false;
        }
    }

    private function documentExists($numDocum)
    {
        try {
            $query = "SELECT COUNT(*) as count FROM cliente WHERE numDocum = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$numDocum]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $result['count'] > 0;
        } catch (PDOException $e) {
            error_log("Error al verificar documento: " . $e->getMessage());
            return false; 
        }
    }

   
    private function redirectWithError($errorType, $postData)
    {
        $params = [
            'error' => $errorType,
            'nombre' => $postData['nombreComplet'] ?? '',
            'documento' => $postData['numDocum'] ?? '',
            'telefono' => $postData['Telefono'] ?? '',
            'direccion' => $postData['direccion'] ?? '',
            'correo' => $postData['correo'] ?? ''
        ];
        
        $queryString = http_build_query($params);
        header("Location: index.php?action=register&" . $queryString);
        exit();
    }
}
?>