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
            } elseif ( $op == 'nuevo' ) {
                $this->guardaPrestamo();
            } elseif ( $op == 'update' ) {
                $this->updatePrestamo();
            } elseif ( $op == 'updatevalid' ) {
                $this->updateValid();
            } elseif ( $op == 'updatemulta' ) {
                $this->updateMulta();
            } elseif ( $op == 'lista' ) {
                $this->lista();
            } elseif ( $op == 'articuloexists' ){
                $this->updateExiste();
            } elseif ( $op == 'valid' ) {
                $this->validacion();
            } else {
                $this->showError("Page not found", "Page for operation ".$op." was not found!");
            }
        } catch ( Exception $e ) {
            $this->showError("Application error", $e->getMessage());
        }
    }
    
    public function updateExiste(){
        $title='Servicios Tecnológicos';
        $codigo = $_GET['codigo'];
        echo $this->prestamosService->updateExiste($codigo);
    }

    public function updateMulta(){
        $title = 'Servicios Tecnológicos';
        $multa_hora           = isset($_GET['multa_hora'])?   $_GET['multa_hora'] :NULL;
        echo $multa_hora;
        echo $this->prestamosService->updateMulta($multa_hora);
    }

    public function updateValid(){
        $title = 'Servicios Tecnológicos';
        $codigo           = $_GET['codigo'];
        echo $this->prestamosService->updateValid($codigo);
    }
    public function listPrestamos() {
        $orderby = isset($_GET['orderby'])?$_GET['orderby']:NULL;
        return $this->prestamosService->getAllPrestamos($orderby);
        
        include 'view/prestamos.php';
    }
    public function guardaPrestamo(){
         $title = 'Servicios Tecnológicos';
        $id_persona = '';
        $codigo = '';
        $errors = array();  
            $id_persona       = isset($_GET['id_persona']) ?   $_GET['id_persona']  :NULL;
            $codigo           = isset($_GET['codigo'])?   $_GET['codigo'] :NULL;

            try {
                echo $this->prestamosService->createNewPrestamo($id_persona, $codigo);
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        
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
                echo "hola";
                return $this->prestamosService->createNewPrestamo($id_persona, $codigo);
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }
        else include 'view/prestamo-form.php';
    }


    public function validacion(){
        $title = 'Servicios Tecnológicos';
        $id_persona     = $_GET['id_persona'];
        $codigo           = $_GET['codigo'];
        echo $this->prestamosService->validarPrestamo($id_persona, $codigo);
      //  include 'view/bal.php';
    }

    public function lista() {
        
          include 'view/lista-form.php';
    }
    
    public function updatePrestamo() {  
        $title = 'Servicios Tecnológicos';
        $codigo = '';
        $errors = array();

        
            $codigo           = isset($_POST['codigo'])?   $_POST['codigo'] :NULL;          
            try {
                echo $this->prestamosService->updatePrestamo($codigo);
                //$this->redirect('index.php');
                //return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        
        
    }

    public function showError($title, $message) {
        include 'view/error.php';
    }
}
?>
