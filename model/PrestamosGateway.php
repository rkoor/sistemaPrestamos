<?php

class PrestamosGateway {
    
    public function selectAll($order) {
        if ( !isset($order) ) {
            $order = "codigo";
        }
        $dbOrder =  mysqli_real_escape_string($order);
        $dbres = mysqli_query("SELECT * FROM Prestamos ORDER BY $dbOrder ASC");
        
        $prestamos = array();
        while ( ($obj = mysqli_fetch_object($dbres)) != NULL ) {
            $prestamos[] = $obj;
        }
        
        return $prestamos;
    }
    
    public function selectById($id_persona) {
        $dbId = mysqli_real_escape_string($id_persona);
        
        $dbres = mysqli_query("SELECT persona.nombre, persona.id, articulos.nombre_articulo, prestamos.codigo, prestamos.hora_prestamo, prestamos.hora_entrega 
                                FROM persona, prestamos, articulos 
                                WHERE persona.id=$dbId persona.id=prestamos.id_persona 
                                AND prestamos.codigo=articulos.codigo ");
        return mysqli_fetch_object($dbres);
        
    }

    public function insert( $id_persona, $codigo ) {
        $dbId_persona = ($id_persona != NULL)?"'".mysql_real_escape_string($id_persona)."'":'NULL';
        $dbCodigo = ($codigo != NULL)?"'".mysql_real_escape_string($codigo)."'":'NULL';
        return mysqli_query("INSERT INTO prestamos (id_persona, codigo, hora_prestamo) VALUES ($dbId_persona, $dbCodigo, NOW())");
        

    }
    
    public function update($codigo) {
        $dbCodigo = mysqli_real_escape_string($codigo);
        $valmulta = mysqli_query("SELECT TIMESTAMPDIFF(day, hora_prestamo, NOW()) AS 'valormulta'
            FROM prestamos
            WHERE hora_entrega IS NULL");
        $resultado = mysqli_fetch_array($valmulta);

        $multa = $resultado[0];
        print_r($resultado);
        if ($multa >= 1) {
           return mysqli_query("UPDATE prestamos SET multa = 1, hora_entrega = NOW() WHERE codigo='$dbCodigo' AND hora_entrega is NULL");
        }

        return mysqli_query("UPDATE prestamos SET hora_entrega = NOW()  WHERE codigo='$dbCodigo' AND hora_entrega IS NULL");

    }
    
}

?>
             
