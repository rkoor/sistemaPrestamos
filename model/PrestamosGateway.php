<?php

class PrestamosGateway {

    public function selectAll($order) {
        if ( !isset($order) ) {
            $order = "codigo";
        }
        $link = mysqli_connect('localhost', 'root', '');
        mysqli_set_charset($link, 'utf8');
        $dbres = mysqli_query($link, "SELECT alumnos.alumnos.nombre as nombre, alumnos.alumnos.id as id, prestamo.articulos.codigo as codigo, prestamo.articulos.nombre_articulo as nombre_articulo, prestamo.prestamos.hora_prestamo as hora_prestamo, prestamo.prestamos.hora_entrega as hora_entrega, prestamo.prestamos.multa as multa, prestamo.prestamos.horas_prestamo as horas_prestamo FROM alumnos.alumnos, prestamo.articulos, prestamo.prestamos WHERE alumnos.alumnos.id=prestamo.prestamos.id_persona AND prestamo.prestamos.codigo=prestamo.articulos.codigo ORDER BY prestamo.prestamos.hora_prestamo DESC");

        $prestamos = array();
        while ( ($row = mysqli_fetch_assoc($dbres)) != NULL ) {
        $prestamos['prestamos'][]= $row;
      


        } 
        header('Content-Type: application/json');
        print json_encode($prestamos); 
       
      
         mysqli_close($link);
    }
    
 
   /* public function selectById($id_persona) {
        $link = mysqli_connect('localhost', 'root', '', 'prestamo');
        $dbId = mysqli_real_escape_string($link, $id_persona);
        
        $dbres = mysqli_query($link,  "SELECT persona.nombre, persona.id, articulos.nombre_articulo, prestamos.codigo, prestamos.hora_prestamo, prestamos.hora_entrega 
                                FROM persona, prestamos, articulos 
                                WHERE persona.id=$dbId persona.id=prestamos.id_persona 
                                AND prestamos.codigo=articulos.codigo ");
        return mysqli_fetch_object($dbres);
        
    } */
    public function updateMulta($multa_hora){
        $link = mysqli_connect('localhost', 'root', '', '');

        $dbMultaHora = ($multa_hora != NULL)?"'".mysqli_real_escape_string($link, $multa_hora)."'":'NULL';
        $consulta = mysqli_query($link, "UPDATE prestamo.prestamos SET multa = 0  WHERE hora_entrega = $dbMultaHora");
        $consulta2 = mysqli_query($link, "SELECT * FROM prestamo.prestamos WHERE hora_entrega = $dbMultaHora");
        print ($consulta);
        mysqli_close($link);
    }

    public function updateValid($codigo){
        $link = mysqli_connect('localhost', 'root', '', '');
        $dbCodigo = ($codigo != NULL)?"'".mysqli_real_escape_string($link, $codigo)."'":'NULL';
        $val1= mysqli_query($link, "SELECT prestamo.articulos.Estado, prestamo.articulos.nombre_articulo FROM prestamo.articulos WHERE prestamo.articulos.codigo = $dbCodigo");
        $horas = mysqli_query($link, "SELECT TIMESTAMPDIFF(hour, hora_prestamo, NOW()) AS 'valormulta'
                                            FROM prestamo.prestamos
                                            WHERE hora_entrega IS NULL");
        $resultado_horas = mysqli_fetch_assoc($horas);
        $row= array(mysqli_fetch_assoc($val1), $resultado_horas);
        print json_encode($row);
        mysqli_close($link);
    }

    public function updateExiste($codigo){
        $link = mysqli_connect('localhost', 'root', '', '');
        $dbCodigo = ($codigo != NULL)?"'".mysqli_real_escape_string($link, $codigo)."'":'NULL';
        $val = mysqli_query($link, "SELECT prestamo.articulos.codigo FROM prestamo.articulos WHERE prestamo.articulos.codigo = $dbCodigo");
        $resultado = mysqli_fetch_assoc($val);
        print json_encode($resultado);
        mysqli_close($link);
    }

    public function selectValid($id_persona, $codigo){
        $link = mysqli_connect('localhost', 'root', '', '');
        mysqli_set_charset($link, 'utf8');
        $dbId_persona = ($id_persona != NULL)?"'".mysqli_real_escape_string($link, $id_persona)."'":'NULL';
        $dbCodigo = ($codigo != NULL)?"'".mysqli_real_escape_string($link, $codigo)."'":'NULL';

        $valNombre = mysqli_query($link, "SELECT alumnos.alumnos.nombre FROM alumnos.alumnos WHERE alumnos.alumnos.id= $dbId_persona");
        $valArti = mysqli_query($link, "SELECT prestamo.articulos.nombre_articulo FROM prestamo.articulos WHERE prestamo.articulos.codigo= $dbCodigo");
                $row = array(mysqli_fetch_assoc($valNombre), mysqli_fetch_assoc($valArti));
        print json_encode($row);
        mysqli_close($link);

    }
    public function insert( $id_persona, $codigo ) {
        $link = mysqli_connect('localhost', 'root', '', 'prestamo');
        $link2 = mysqli_connect('localhost', 'root', '', 'alumnos');
        $dbId_persona = ($id_persona != NULL)?"'".mysqli_real_escape_string($link, $id_persona)."'":'NULL';
        $dbCodigo = ($codigo != NULL)?"'".mysqli_real_escape_string($link, $codigo)."'":'NULL';
        $val = mysqli_query($link2, "SELECT id FROM alumnos WHERE id = $dbId_persona");
        $val2 = mysqli_query($link, "SELECT estado FROM articulos WHERE codigo = $dbCodigo AND estado = 1");
        
        if (mysqli_num_rows($val) >= 1) {
            if (mysqli_num_rows($val2) == 1) {
                mysqli_query($link, "UPDATE articulos SET estado = 0 WHERE codigo = $dbCodigo");
                return mysqli_query($link, "INSERT INTO prestamos (id_persona, codigo, hora_prestamo) VALUES ($dbId_persona, $dbCodigo, NOW())");
            }
        } else {
            return NULL;    
        }
    }

    public function update($codigo) {
        $link = mysqli_connect('localhost', 'root', '', 'prestamo');
        $dbCodigo = mysqli_real_escape_string($link, $codigo);
        mysqli_query($link, "UPDATE articulos SET estado = 1 WHERE codigo = '$dbCodigo'");
        $horas = mysqli_query($link, "SELECT TIMESTAMPDIFF(hour, hora_prestamo, NOW()) AS 'valormulta'
                                            FROM prestamos
                                            WHERE hora_entrega IS NULL");
        $resultado_horas = mysqli_fetch_array($horas);
        $horas_prestamo = $resultado_horas[0];
        if ($horas_prestamo >= 6){
            mysqli_query($link, "UPDATE prestamos SET multa = 1 WHERE codigo = '$dbCodigo' AND hora_entrega is NULL");
        }
        mysqli_query($link, "UPDATE prestamos SET horas_multa = '$horas_prestamo', hora_entrega = NOW() WHERE codigo='$dbCodigo' AND hora_entrega is NULL");
        if ($horas_prestamo >= 6) {
            return mysqli_query($link, "UPDATE prestamos SET horas_prestamo = '$horas_prestamo', hora_entrega = NOW() WHERE codigo='$dbCodigo' AND hora_entrega is NULL");
        }
        return mysqli_query($link, "UPDATE prestamos SET hora_entrega = NOW()  WHERE codigo='$dbCodigo' AND hora_entrega IS NULL");
    }
}

?>
             
