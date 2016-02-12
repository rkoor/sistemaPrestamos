<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Servicios Tecnologicos</title>
        <style type="text/css">
            table.contacts {
                width: 100%;
            }
            
            table.contacts thead {
                background-color: #eee;
                text-align: left;
            }
            
            table.contacts thead th {
                border: solid 1px #fff;
                padding: 3px;
            }
            
            table.contacts tbody td {
                border: solid 1px #eee;
                padding: 3px;
            }
            
            a, a:hover, a:active, a:visited {
                color: blue;
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <div><a href="index.php?op=new">Nuevo Prestamo</a></div>
        <table class="contacts" border="0" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th><a href="?orderby=id_persona">ID</a></th>
                    <th><a href="?orderby=codigo">CODIGO</a></th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($prestamos as $prestamo): ?>
                <tr>
                    <td><a href="index.php?op=show&id=<?php print $contact->id; ?>"><?php print htmlentities($prestamo->id_persona); ?></a></td>
                    <td><?php print htmlentities($prestamo->codigo); ?></td>
                    <td><a href="index.php?op=update&id=<?php print $prestamo->hora_prestamo; ?>">MODIFICAR</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </body>
</html>
