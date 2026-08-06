<?php

require_once './model/insertBarberoModel.php';
require_once './config/database.php';


 class   insertBarberoController
{
    private $db;
    private $insertBarberoModel;

    public function __construct()
{
    $database = new Database();
    $this->db = $database->getConnection();
    $this->insertBarberoModel = new insertBarberoModel($this->db);
}
public function insertBarbero() 
{
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $nomCompleto = $_POST['nomCompleto'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];
        

        $foto=$_FILES['foto']['name'];
        $target_dir="photo/";
        $target_file=$target_dir . basename($foto);
        move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);

        $this->insertBarberoModel->insertBarbero($nomCompleto, $telefono, $correo, $foto);
    }
}

public function listBarbers()
     {
        return $this->insertBarberoModel->getBarbers();
     }

     public function buscarPorNombre()
{
    if (isset($_POST['nomCompleto'])) {
        return $this->insertBarberoModel->getByNombre($_POST['nomCompleto']);
    }
    return [];
}

      public function  BarberByName()
     {
        $name = $_POST['nomCompleto'] ?? '';
        return $this->insertBarberoModel->getBarberByName($name);
     }

       public function eliminar()
     {
        $nomCompleto = $_POST['nomCompleto'] ?? '';
        $datosUsuario = $this->insertBarberoModel->eliminar($nomCompleto);
        return $this->insertBarberoModel->eliminar($nomCompleto);
     }

     public function actualizar() {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idBarbero'])) {
        $idBarbero = $_POST['idBarbero'];
        $nomCompleto = $_POST['nomCompleto'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];
        $foto = $_POST['foto'];

        $this->insertBarberoModel->actualizar(
            $idBarbero,
            $nomCompleto,
            $telefono,
            $correo,
            $foto
        );
    }
}

public function openFormUpdateBarbero() {
    $barbers = [];
    include "./views/update_barbero.php";
}

public function searchBarberForUpdate() {
    $nomCompleto = $_POST['nomCompleto'] ?? '';
    $barbers = $this->insertBarberoModel->getBarberByName($nomCompleto);
    include "./views/update_barbero.php";
}

public function actualizarBarbero() {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idBarbero'])) {
        $idBarbero = $_POST['idBarbero'];
        $nomCompleto = $_POST['nomCompleto'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];
        $foto = $_POST['foto'] ?? '';

        $this->insertBarberoModel->actualizar($idBarbero, $nomCompleto, $telefono, $correo, $foto);
        header("Location: index.php?action=openFormUpdateBarbero&success=1");
        exit();
    }
}

}