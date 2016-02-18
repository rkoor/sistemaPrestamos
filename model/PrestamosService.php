<?php

require_once 'model/PrestamosGateway.php';
require_once 'model/ValidationException.php';


class PrestamosService {
    
    private $prestamosGateway    = NULL;
    
    private function openDb() {
        if (!mysqli_connect("localhost", "root", "")) {
            throw new Exception("FALLO LA CONEXION AL SERVIDOR DE DB");
        }
        if (!mysqli_select_db("prestamo")) {
            throw new Exception("NO SE ENCONTRO LA BD");
        }
    }
    
    private function closeDb() {
        mysqli_close();
    }
  
    public function __construct() {
        $this->prestamosGateway = new PrestamosGateway();
    }
    
    public function getAllPrestamos($order) {
        try {
            $this->openDb();
            $res = $this->prestamosGateway->selectAll($order);
            $this->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->closeDb();
            throw $e;
        }
    }
    
    private function validatePrestamoParams( $id_persona, $codigo ) {
        $errors = array();
        if ( !isset($id_persona) || empty($id_persona) ) {
            $errors[] = 'el ID es requerido';
        }
        if ( empty($errors) ) {
            return;
        }
        throw new ValidationException($errors);
    }

    public function createNewPrestamo( $id_persona, $codigo ) {
        try {
            $this->openDb();
            $this->validatePrestamoParams($id_persona, $codigo);
            $res = $this->prestamosGateway->insert($id_persona, $codigo);
            $this->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->closeDb();
            throw $e;
        }
    }

    public function updatePrestamo( $codigo ) {
        try {
            $this->openDb();
            $res = $this->prestamosGateway->update($codigo);
            $this->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->closeDb();
            throw $e;
        }
    }
    
    
}

?>
