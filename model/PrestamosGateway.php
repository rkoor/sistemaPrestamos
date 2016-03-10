<?php

class PrestamosGateway {

    public function selectAll($order) {
        if ( !isset($order) ) {
            $order = "codigo";
        }
        $link = mysqli_connect('localhost', 'root', '');
        mysqli_set_charset($link, 'utf8');
        $dbres = mysqli_query($link, "SELECT alumnos.alumnos.nombre, alumnos.alumnos.id, prestamo.articulos.codigo, prestamo.articulos.nombre_articulo, prestamo.prestamos.hora_prestamo, prestamo.prestamos.hora_entrega, prestamo.prestamos.multa FROM alumnos.alumnos, prestamo.articulos, prestamo.prestamos WHERE alumnos.alumnos.id=prestamo.prestamos.id_persona AND prestamo.prestamos.codigo=prestamo.articulos.codigo");

        $prestamos = array();
        while ( ($row = mysqli_fetch_row($dbres)) != NULL ) {
            $prestamos['Prestamos'][] = $row;
        }

         $json = json_encode($prestamos); 
        header('Content-Type: application/json');
        echo $json;
         
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

    public function insert( $id_persona, $codigo ) {
        $link = mysqli_connect('localhost', 'root', '', 'prestamo');
        $link2 = mysqli_connect('localhost', 'root', '', 'alumnos');
        $dbId_persona = ($id_persona != NULL)?"'".mysqli_real_escape_string($link, $id_persona)."'":'NULL';
        $dbCodigo = ($codigo != NULL)?"'".mysqli_real_escape_string($link, $codigo)."'":'NULL';

        $val = mysqli_query($link2, "SELECT id FROM alumnos WHERE $dbId_persona = id");
        $val2 = mysqli_query($link, "SELECT estado FROM articulos WHERE codigo = $dbCodigo AND estado = 1");
        if (mysqli_num_rows($val) == 1) {
            if (mysqli_num_rows($val2) == 1) {
                mysqli_query($link, "UPDATE articulos SET estado = 0 WHERE $dbCodigo = codigo");
                return mysqli_query($link, "INSERT INTO prestamos (id_persona, codigo, hora_prestamo) VALUES ($dbId_persona, $dbCodigo, NOW())");
            }
        } else {
            return NULL;    
        }
    }

    public function update($codigo) {
        $link = mysqli_connect('localhost', 'root', '', 'prestamo');
        $dbCodigo = mysqli_real_escape_string($link, $codigo);

        $valmulta = mysqli_query($link, "SELECT TIMESTAMPDIFF(day, hora_prestamo, NOW()) AS 'valormulta'
                                            FROM prestamos
                                            WHERE hora_entrega IS NULL");
        $resultado = mysqli_fetch_array($valmulta);

        $multa = $resultado[0];
        
        print_r(mysqli_query($link, "UPDATE articulos SET estado = 1 WHERE codigo = '$dbCodigo' "));
        if ($multa >= 1) {
            
           return mysqli_query($link, "UPDATE prestamos SET multa = 1, hora_entrega = NOW() WHERE codigo='$dbCodigo' AND hora_entrega is NULL");
        }

        
        return mysqli_query($link, "UPDATE prestamos SET hora_entrega = NOW()  WHERE codigo='$dbCodigo' AND hora_entrega IS NULL");

    }
    
}

?>
             
