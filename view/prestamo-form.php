<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>
        <?php print htmlentities($title) ?>
        </title>
    </head>
    <body>
        <?php
        if ( $errors ) {
            print '<ul class="errors">';
            foreach ( $errors as $field => $error ) {
                print '<li>'.htmlentities($error).'</li>';
            }
            print '</ul>';
        }
        ?>
        <form method="POST" action="">
            <label for="id_persona">ID:</label><br/>
            <input type="text" name="id_persona" value="<?php print htmlentities($id_persona) ?>"/>
            <br/>
            
            <label for="codigo">CODIGO:</label><br/>
            <input type="text" name="codigo" value="<?php print htmlentities($codigo) ?>"/>
            <br/>
            <input type="hidden" name="form-submitted" value="1" />
            <input type="submit" value="Submit" />
        </form>
        
    </body>
</html>
