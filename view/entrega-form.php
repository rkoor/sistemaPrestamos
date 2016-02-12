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
            <label for="codigo">CODIGO:</label><br/>
            <input type="text" name="codigo" />
            <br/>
            <input type="hidden" name="form-entrega-submitted"/>
            <input type="submit" value="Submit" />
        </form>
        
    </body>
</html>