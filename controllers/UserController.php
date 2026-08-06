<?php
require_once './model/UserModel.php';
require_once './config/database.php';


class UserController
{
    private $db;

    private $UserModel;


    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->UserModel = new UserModel($this->db);
    }
    public function insertUser()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $numDocum      = trim($_POST['numDocum'] ?? '');
            $nombreComplet = trim($_POST['nombreComplet'] ?? '');
            $Telefono      = trim($_POST['Telefono'] ?? '');
            $direccion     = trim($_POST['direccion'] ?? '');
            $correo        = trim(strtolower($_POST['correo'] ?? ''));
            $password      = $_POST['password'] ?? '';
            $idtipoDoc     = $_POST['idtipoDoc'] ?? '';
            $idRol         = $_POST['idRol'] ?? '';

            
            if (empty($numDocum) || empty($nombreComplet) || empty($correo) || empty($password)) {
                header("Location: index.php?action=insertUser&error=empty_fields");
                exit();
            }

            
            $existeDoc = $this->UserModel->getUserByNumDocum($numDocum);
            if ($existeDoc) {
                header("Location: index.php?action=insertUser&error=document_exists");
                exit();
            }

            
            $existeCorreo = $this->UserModel->buscarPorEmail($correo);
            if ($existeCorreo) {
                header("Location: index.php?action=insertUser&error=email_exists");
                exit();
            }

            try {
                $this->UserModel->insertUser($numDocum, $nombreComplet, $Telefono, $direccion, $correo, $password, $idtipoDoc, $idRol);
                header("Location: index.php?action=insertUser&success=1");
                exit();
            } catch (Exception $e) {
                error_log("Error insertUser: " . $e->getMessage());
                header("Location: index.php?action=insertUser&error=system_error");
                exit();
            }
        }
    }

    public function getUsers()
    {

        return $this->UserModel->getUsers();
    }

    public function listUsersView()
    {
        $users = $this->UserModel->getUsers();
        include './views/list_users.php';
    }


    public function  UsersByName()
    {
        $name = $_POST['name'] ?? '';
        return $this->UserModel->getUserByName($name);
    }



    public function UserByNumDocum($numDocum = '')
    {
        if (empty($numDocum)) {
            $numDocum = $_POST['numDocum'] ?? $_GET['numDocum'] ?? '';
        }
        return $this->UserModel->getUserByNumDocum($numDocum);
    }

    public function eliminar()
    {
        if (isset($_POST['numDocum']) && !empty($_POST['numDocum'])) {
            $numDocum = $_POST['numDocum'];
            $this->UserModel->eliminar($numDocum);
        }
    }


    public function actualizar()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $numDocum      = $_POST['numDocum'];
            $nombreComplet = $_POST["nombreComplet"];
            $Telefono      = $_POST['Telefono'];
            $direccion     = $_POST['direccion'];
            $correo        = $_POST['correo'];
            $idtipoDoc     = $_POST['idtipoDoc'];

            if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'cliente') {
                
                $idRol = $_SESSION['user']['idRol'] ?? $_POST['idRol'] ?? 3;
            } else {
                $idRol = $_POST['idRol'];
            }

            $this->UserModel->actualizar($numDocum, $nombreComplet, $Telefono, $direccion, $correo, $idtipoDoc, $idRol);
            header("Location: index.php?action=openFormUpdate&success=1");
            exit;
        }
    }

    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $correo = $_POST['correo'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = $this->UserModel->login($correo, $password);

            if ($user) {
                $_SESSION['user'] = $user;
                $_SESSION['rol'] = $user['rol'];
                $_SESSION['nombreComplet'] = $user['nombreComplet'];
                $_SESSION['numDocum'] = $user['numDocum'];

                if ($user['rol'] === 'cliente') {
                    header("Location: index.php?action=principal");
                    exit();
                } else {
                    header("Location: index.php?action=dashboard");
                    exit();
                }
            } else {

                header("Location: index.php?action=login1&error=invalid_credentials");
                exit();
            }
        }
    }

    public function googleLogin()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        $correo = $data['email'] ?? '';
        $nombre = $data['name'] ?? '';

        if (empty($correo)) {
            http_response_code(400);
            echo json_encode(["success" => false, "error" => "Email requerido"]);
            return;
        }

        $cliente = $this->UserModel->buscarPorEmail($correo);

        if (!$cliente) {
            $this->UserModel->crearGoogle($nombre, $correo);
            $cliente = $this->UserModel->buscarPorEmail($correo);
        }


        $clienteConRol = $this->UserModel->buscarPorEmailConRol($correo);
        if ($clienteConRol) {
            $cliente = $clienteConRol;
        }


        $_SESSION['user'] = $cliente;
        $_SESSION['rol'] = $cliente['rol'] ?? 'cliente';
        $_SESSION['nombreComplet'] = $cliente['nombreComplet'];
        $_SESSION['numDocum'] = $cliente['numDocum'] ?? null;


        if (
            empty($cliente["Telefono"]) ||
            empty($cliente["direccion"]) ||
            empty($cliente["idtipoDoc"]) ||
            $cliente["numDocum"] < 0
        ) {
            echo json_encode(["success" => true, "redirect" => "index.php?action=completarPerfil"]);
        } else {
            $rol = $cliente['rol'] ?? 'cliente';
            $redirect = ($rol === 'cliente') ? "index.php?action=principal" : "index.php?action=dashboard";
            echo json_encode(["success" => true, "redirect" => $redirect]);
        }
    }
}