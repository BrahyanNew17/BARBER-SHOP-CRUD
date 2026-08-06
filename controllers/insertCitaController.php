<?php

require_once './model/insertCitaModel.php';
require_once './config/database.php';

class insertCitaController
{
    private $db;
    private $insertCitaModel;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->insertCitaModel = new insertCitaModel($this->db);
    }

    
    public function insertCita()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            return;
        }

        
        if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'cliente') {
            $numDocum = $_SESSION['numDocum'] ?? '';
        } else {
            $numDocum = $_POST['numDocum'] ?? '';
        }

        $fecha      = $_POST['fecha'] ?? '';
        $hora       = $_POST['hora'] ?? '';
        $idBarbero  = $_POST['idBarbero'] ?? '';
        $idServicio = $_POST['idServicio'] ?? null;
        $idEstado   = 1;

        
        if ($fecha < date('Y-m-d')) {
            header("Location: index.php?action=insertCita&error=fecha_pasada");
            exit;
        }

        
        if (!$this->insertCitaModel->existeCliente($numDocum)) {
            header("Location: index.php?action=insertCita&error=cliente_no_existe");
            exit;
        }

        
        if ($this->insertCitaModel->citaOcupada($idBarbero, $fecha, $hora)) {
            header("Location: index.php?action=insertCita&error=ocupado");
            exit;
        }

        $this->insertCitaModel->insertCita(
            $fecha,
            $hora,
            $numDocum,
            $idBarbero,
            $idEstado,
            $idServicio
        );

        header("Location: index.php?action=insertCita&success=1");
        exit;
    }

    
    public function listCitas()
    {
        if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'cliente') {
            $numDocum = $_SESSION['numDocum'] ?? '';
            return $this->insertCitaModel->getCitaByNumDocum($numDocum);
        }
        return $this->insertCitaModel->getCitas();
    }

    
    public function CitaByNumDocum()
    {
        $numDocum = $_POST['numDocum'] ?? '';
        
        if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'cliente') {
            $numDocum = $_SESSION['numDocum'] ?? '';
        }
        
        return $this->insertCitaModel->getCitaByNumDocum($numDocum);
    }


    public function eliminar()
    {
        $idCita = $_POST['idCita'] ?? '';
        return $this->insertCitaModel->eliminar($idCita);
    }

    public function openFormUpdateCita()
    {
        $citas = [];
        include "./views/update_cita.php";
    }

    public function searchCitaForUpdate()
    {
        $numDocum = $_POST['numDocum'] ?? '';
        $citas = $this->insertCitaModel->getCitaByNumDocum($numDocum);
        include "./views/update_cita.php";
    }

    public function actualizarCita()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idCita'])) {

            $idCita     = $_POST['idCita'];
            $fecha      = $_POST['fecha'];
            $hora       = $_POST['hora'];
            $numDocum   = $_POST['numDocum'];
            $idBarbero  = $_POST['idBarbero'];
            $idEstado   = $_POST['idEstado'];
            $idServicio = $_POST['idServicio'];

          
            if ($idEstado == 4 || $idEstado == 5 || $idEstado == 6) {
                $this->insertCitaModel->eliminar($idCita);
                header("Location: index.php?action=openFormUpdateCita&success=cancelada");
                exit;
            }

            if ($this->insertCitaModel->citaOcupada($idBarbero, $fecha, $hora, $idCita)) {
                header("Location: index.php?action=openFormUpdateCita&error=ocupado");
                exit;
            }

            $this->insertCitaModel->actualizar(
                $idCita,
                $fecha,
                $hora,
                $numDocum,
                $idBarbero,
                $idEstado,
                $idServicio
            );

            header("Location: index.php?action=openFormUpdateCita&success=1");
            exit;
        }
    }
}