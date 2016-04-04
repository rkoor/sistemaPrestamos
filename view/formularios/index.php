<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
require('map.php');
if(!isset($_SESSION['admin'])) header('location: login.php');
if (isset($_GET['url'])) {
	$url = $_GET['url'];
	switch ($url) {
		case 'estadisticas':
			echo file_get_contents('views/chart.html');
			break;

		case 'mi':
			echo file_get_contents('views/miregistro.html');
			break;

		case 'admin':
			echo file_get_contents('views/administrador.html');
			break;
		
		default:
			echo file_get_contents('views/registro.html');
			break;
	}
}
else if(isset($_GET['metodo'])) {
	$metodo = $_GET['metodo'];
	$est = new Estadistica();
	switch ($metodo) {
		case 'mostrar':
			echo array2json($est->porMes());
			break;

		case 'carrera':
			echo array2json($est->verCarrera());
			break;

		case 'carreras':
			echo json_encode($est->verCarreras($_GET['esc']));
			break;

		case 'escuela':
			echo array2json($est->verEscuela());
			break;

		case 'masvisita':
			echo array2json($est->masVisita());
			break;

		case 'vermio':
			echo json_encode($est->verRegistro($_GET['id']));
			break;

		case 'usuarios':
			$fecha = date('Y-m-d');
			echo json_encode($est->usuarios($fecha));
			break;

		case 'fecha':
			echo json_encode($est->usuarios($_GET['fecha']));
			break;

		case 'estadsHora':
			echo array2json($est->porHora($_GET['f1'],$_GET['f2']));
			break;

		case 'estadsSexo':
			echo array2json($est->porSexo($_GET['f1'],$_GET['f2']));
			break;

		case 'tablaSemana':
			echo array2json($est->porSemana($_GET['f1'],$_GET['f2']));
			break;

		case 'nuevo':
			echo $est->guardar($_GET['id'], $_GET['name'], $_GET['carr'], $_GET['esc'], $_GET['sem']);
			break;

		/*Para reportes*/
		case 'escuelas':
			echo array2json($est->getEscuelas());
			break;
		case 'programas':
			echo array2json($est->getProgramas());
			break;

		case 'rTotal':
			echo $est->rTotal($_GET['f1'],$_GET['f2']);
			break;

		case 'rEscuela':
			echo $est->rEscuela($_GET['escuela'],$_GET['f1'],$_GET['f2']);
			break;

		case 'rPrograma':
			echo $est->rPrograma($_GET['programa'],$_GET['f1'],$_GET['f2']);
			break;
		
		default:
			# code...
			break;
	}
}
else echo file_get_contents('views/registro.html');
function array2json($arr) { 
        $parts = array(); 
        $is_list = false; 

        //Find out if the given array is a numerical array 
        $keys = array_keys($arr); 
        $max_length = count($arr)-1; 
        if(($keys[0] == 0) and ($keys[$max_length] == $max_length)) {//See if the first key is 0 and last key is length - 1
            $is_list = true; 
            for($i=0; $i<count($keys); $i++) { //See if each key correspondes to its position 
                if($i != $keys[$i]) { //A key fails at position check. 
                    $is_list = false; //It is an associative array. 
                    break; 
                } 
            } 
        } 

        foreach($arr as $key=>$value) { 
            if(is_array($value)) { //Custom handling for arrays 
                if($is_list) $parts[] = array2json($value); /* :RECURSION: */ 
                else $parts[] = '"' . $key . '":' . array2json($value); /* :RECURSION: */ 
            } else { 
                $str = ''; 
                if(!$is_list) $str = '"' . $key . '":'; 

                //Custom handling for multiple data types 
                if(is_numeric($value)) $str .= $value; //Numbers 
                elseif($value === false) $str .= 'false'; //The booleans 
                elseif($value === true) $str .= 'true'; 
                else $str .= '"' . addslashes($value) . '"'; //All other things 
                // :TODO: Is there any more datatype we should be in the lookout for? (Object?) 

                $parts[] = $str; 
            } 
        } 
        $json = implode(',',$parts); 
     
        if($is_list) return '[' . $json . ']';//Return numerical JSON 
        return '{' . $json . '}';//Return associative JSON 
    } 