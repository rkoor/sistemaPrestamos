<?php

/**
 * Table data gateway.
 * 
 *  OK I'm using old MySQL driver, so kill me ...
 *  This will do for simple apps but for serious apps you should use PDO.
 */
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
    
    public function selectById($id) {
        $dbId = mysql_real_escape_string($id);
        
        $dbres = mysql_query("SELECT * FROM contacts WHERE id=$dbId");
        
        return mysql_fetch_object($dbres);
		
    }

    public function insert( $id_persona, $codigo ) {
        
        $dbId_persona = ($id_persona != NULL)?"'".mysql_real_escape_string($id_persona)."'":'NULL';
        $dbCodigo = ($codigo != NULL)?"'".mysql_real_escape_string($codigo)."'":'NULL';

        mysql_query("INSERT INTO prestamos (id_persona, codigo ) VALUES ($dbId_persona, $dbCodigo)");
        return mysql_insert_id();
    }
    
    
    
}

?>
