<!DOCTYPE html>
<html ng-app="Prestamo">
    <head>
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/angular_material/1.0.0/angular-material.min.css">
    <link rel="stylesheet" type="text/css" href="view/style.css">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script src="http://code.jquery.com/jquery-2.2.0.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-animate.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-aria.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-messages.min.js"></script>
    <script src="js/index.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angular_material/1.0.0/angular-material.min.js"></script>
        
        <title>
        <?php print htmlentities($title) ?>
        </title>
    </head>
    <body layout="column" style="background:#001525">
                <md-tab label="Prestamos ">
                <div  layout="column" ng-cloak >
                  <md-content  >
                      <div layout="column" ng-controller="Lista">
                          <div   > 
                            <table>
                              <tr>
                                <th><md-subheader class="md-no-sticky">Nombre</md-subheader></th>
                                <th><md-subheader class="md-no-sticky">ID</md-subheader></th>
                                <th><md-subheader class="md-no-sticky">Código</md-subheader></th>
                                <th><md-subheader class="md-no-sticky">Nombre del Artículo</md-subheader></th>
                                <th><md-subheader class="md-no-sticky">Hora de préstamo</md-subheader></th>
                                <th><md-subheader class="md-no-sticky">Hora Entrega</md-subheader></th>
                                <th><md-subheader class="md-no-sticky">Multa</md-subheader></th>

                              </tr>
                              <div ng-repeat="prestamo in prestamos">
                                    <tr >
                                      <td ><md-list-item >{{ prestamos.nombre}}</md-list-item> </td>
                                      <td><md-list-item >{{ prestamos.id}}</md-list-item></td>
                                      <td><md-list-item >{{ prestamos.codigo}}</md-list-item></td>
                                      <td><md-list-item >{{ prestamos.articulo}}</md-list-item></td>
                                      <td><md-list-item >{{ prestamos.hora_prestamo}}</md-list-item></td>
                                      <td><md-list-item >{{ prestamos.hora_entrega}}</md-list-item></td>
                                      <td><md-list-item >{{ prestamos.multa}}</md-list-item></td>
                                    
                                    </tr>
                              </div>
                            </table>
                          </div>
                      </div>
                  </md-content>
                  </div>
                </md-tab>


    </body>
</html>

