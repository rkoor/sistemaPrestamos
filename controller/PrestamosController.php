<?php

require_once 'model/PrestamosService.php';

class PrestamosController {
    
    private $prestamosService = NULL;
    
    public function __construct() {
        $this->prestamosService = new PrestamosService();
    }
    
    public function redirect($location) {
        header('Location: '.$location);
    }
    
    public function handleRequest() {
        $op = isset($_GET['op'])?$_GET['op']:NULL;
        try {
            if ( !$op || $op == 'new' ) {
                $this->savePrestamo();
            } elseif ( $op == 'list' ) {
                $this->listPrestamos();
            } elseif ( $op == 'update' ) {
                $this->updatePrestamo();
            } else {
                $this->showError("Page not found", "Page for operation ".$op." was not found!");
            }
        } catch ( Exception $e ) {
            $this->showError("Application error", $e->getMessage());
        }
    }
    
    public function listPrestamos() {
        $orderby = isset($_GET['orderby'])?$_GET['orderby']:NULL;
        return $this->prestamosService->getAllPrestamos($orderby);
        
        include 'view/prestamos.php';
    }

    public function savePrestamo() {
        $title = 'Servicios Tecnológicos';
        $id_persona = '';
        $codigo = '';
        $errors = array();
        if ( isset($_POST['id_persona']) ) {
            $id_persona       = isset($_POST['id_persona']) ?   $_POST['id_persona']  :NULL;
            $codigo           = isset($_POST['codigo'])?   $_POST['codigo'] :NULL;
            try {
                echo $this->prestamosService->createNewPrestamo($id_persona, $codigo);
                //$this->redirect('index.php');
                //return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }
        else include 'view/prestamo-form.php';
    }
    
    public function updatePrestamo() {  
        $title = 'Servicios Tecnológicos';
        $codigo = '';
        $errors = array();

        if ( isset($_POST['codigo']) ) {
            $codigo           = isset($_POST['codigo'])?   $_POST['codigo'] :NULL;          
            try {
                echo $this->prestamosService->updatePrestamo($codigo);
                //$this->redirect('index.php');
                //return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }
        
       else include 'view/entrega-form.php';
    }

    public function showError($title, $message) {
        include 'view/error.php';
    }
}
?>
