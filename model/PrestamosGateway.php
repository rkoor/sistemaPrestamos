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
        
        $dbres = mysql_query("SELECT * FROM prestamos WHERE id=$dbId");
        
        return mysql_fetch_object($dbres);
        
    }

    public function insert( $id_persona, $codigo ) {
        $dbId_persona = ($id_persona != NULL)?"'".mysql_real_escape_string($id_persona)."'":'NULL';
        $dbCodigo = ($codigo != NULL)?"'".mysql_real_escape_string($codigo)."'":'NULL';
        mysql_query("INSERT INTO prestamos (id_persona, codigo, hora_prestamo) VALUES ($dbId_persona, $dbCodigo, NOW())");
        return mysql_insert_id();

    }
    
    public function update($codigo) {
        $dbCodigo = mysql_real_escape_string($codigo);
        $sql = mysql_query("UPDATE prestamos SET hora_entrega = NOW()  WHERE codigo='$dbCodigo' AND hora_entrega IS NULL");

        //$fecha_prestamo = mysql_query("SELECT hora_prestamo FROM prestamos WHERE codigo='$dbCodigo' AND hora_entrega IS NULL");
        
        $valmulta = mysql_query("SELECT TIMESTAMPDIFF(day, NOW(), hora_prestamo) AS 'valormulta'
            FROM prestamos
            WHERE hora_entrega IS NULL;");
        

        if ($valmulta<) {
            mysql_query("UPDATE prestamos SET multa = 1  WHERE codigo='$dbCodigo'");
        }

       // echo "ENTREGADO";
    }
    
}

?>
             
