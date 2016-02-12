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
            if ( !$op || $op == 'list' ) {
                $this->listPrestamos();
            } elseif ( $op == 'new' ) {
                $this->savePrestamo();
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
        $prestamos = $this->prestamosService->getAllPrestamos($orderby);
        include 'view/prestamos.php';
    }

    public function savePrestamo() {
       
        $title = 'Nuevo Prestamo';
        
        $id_persona = '';
        $codigo = '';
       
        $errors = array();
        
        if ( isset($_POST['form-submitted']) ) {
            
            $id_persona       = isset($_POST['id_persona']) ?   $_POST['id_persona']  :NULL;
            $codigo           = isset($_POST['codigo'])?   $_POST['codigo'] :NULL;

            
            try {
                $this->prestamosService->createNewPrestamo($id_persona, $codigo);
                $this->redirect('index.php');
                return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }
        
        include 'view/prestamo-form.php';
    }

    public function updatePrestamo() {
       
        $title = 'Entregar Prestamo';
        $codigo = '';
        $errors = array();

        if ( isset($_POST['form-entrega-submitted']) ) {
            $codigo           = isset($_POST['codigo'])?   $_POST['codigo'] :NULL;          
            try {
                $this->prestamosService->updatePrestamo($codigo);
                //$this->redirect('index.php');
                return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }
        
        include 'view/entrega-form.php';
    }

    public function showError($title, $message) {
        include 'view/error.php';
    }
}
?>
