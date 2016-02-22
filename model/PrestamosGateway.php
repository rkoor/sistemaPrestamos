<?php

class PrestamosGateway {
    public function selectAll($order) {
        if ( !isset($order) ) {
            $order = "codigo";
        }
        $link = mysqli_connect('localhost', 'root', '', 'prestamo');
        $link2 = mysqli_connect('localhost', 'root', '', 'alumnos');
        $dbres = mysqli_query($link, "SELECT * FROM Prestamos ORDER BY $order ASC");
        $prestamos = array();
        while ( ($obj = mysqli_fetch_object($dbres)) != NULL ) {
            $prestamos[] = $obj;
        }
        
        return $prestamos;
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
        $dbId_persona = ($id_persona != NULL)?"'".mysqli_real_escape_string($link, $id_persona)."'":'NULL';
        $dbCodigo = ($codigo != NULL)?"'".mysqli_real_escape_string($link, $codigo)."'":'NULL';
        return mysqli_query($link, "INSERT INTO prestamos (id_persona, codigo, hora_prestamo) VALUES ($dbId_persona, $dbCodigo, NOW())");
        

    }
    
    public function update($codigo) {
        $link = mysqli_connect('localhost', 'root', '', 'prestamo');
        $dbCodigo = mysqli_real_escape_string($link, $codigo);
        $valmulta = mysqli_query($link, "SELECT TIMESTAMPDIFF(day, hora_prestamo, NOW()) AS 'valormulta'
            FROM prestamos
            WHERE hora_entrega IS NULL");
        $resultado = mysqli_fetch_array($valmulta);

        $multa = $resultado[0];
        print_r($resultado);
        if ($multa >= 1) {
           return mysqli_query($link, "UPDATE prestamos SET multa = 1, hora_entrega = NOW() WHERE codigo='$dbCodigo' AND hora_entrega is NULL");
        }

        return mysqli_query($link, "UPDATE prestamos SET hora_entrega = NOW()  WHERE codigo='$dbCodigo' AND hora_entrega IS NULL");

    }
    
}

?>
             
