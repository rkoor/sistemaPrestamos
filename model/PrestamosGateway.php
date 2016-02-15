<?php

class PrestamosGateway {
    
    public function selectAll($order) {
        if ( !isset($order) ) {
            $order = "codigo";
        }
        $dbOrder =  mysql_real_escape_string($order);
        $dbres = mysql_query("SELECT * FROM Prestamos ORDER BY $dbOrder ASC");
        
        $prestamos = array();
        while ( ($obj = mysql_fetch_object($dbres)) != NULL ) {
            $prestamos[] = $obj;
        }
        
        return $prestamos;
    }
    
    public function selectById($id_persona) {
        $dbId = mysql_real_escape_string($id_persona);
        
        $dbres = mysql_query("SELECT persona.nombre, persona.id, articulos.codigo 
                                FROM persona, prestamos, articulos 
                                WHERE persona.id=$dbId persona.id=prestamos.id_persona 
                                AND prestamos.codigo=articulos.codigo ");
        
        return mysql_fetch_object($dbres);
        
    }

    public function insert( $id_persona, $codigo ) {
        $dbId_persona = ($id_persona != NULL)?"'".mysql_real_escape_string($id_persona)."'":'NULL';
        $dbCodigo = ($codigo != NULL)?"'".mysql_real_escape_string($codigo)."'":'NULL';
        return mysql_query("INSERT INTO prestamos (id_persona, codigo, hora_prestamo) VALUES ($dbId_persona, $dbCodigo, NOW())");
        

    }
    
    public function update($codigo) {
        $dbCodigo = mysql_real_escape_string($codigo);
        $valmulta = mysql_query("SELECT TIMESTAMPDIFF(day, hora_prestamo, NOW()) AS 'valormulta'
            FROM prestamos
            WHERE hora_entrega IS NULL");
        $resultado = mysql_fetch_array($valmulta);

        $multa = $resultado[0];
        print_r($resultado);
        if ($multa >= 1) {
           return mysql_query("UPDATE prestamos SET multa = 1, hora_entrega = NOW() WHERE codigo='$dbCodigo' AND hora_entrega is NULL");
        }

        return mysql_query("UPDATE prestamos SET hora_entrega = NOW()  WHERE codigo='$dbCodigo' AND hora_entrega IS NULL");

    }
    
}

?>
             
