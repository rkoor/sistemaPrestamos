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
        
      
    </head>
    <body layout="column" style="background:#001525">
              <div color="#FFFF" layout="column">
                
                    <img src="http://www.anahuacoaxaca.edu.mx/images/galerias/tecnologias/logo-servtec-blanco.png" style="margin: 0 auto;">
                    
              
                
                 
                      <div layout="column" ng-controller="Lista">
                          <div> 
                            <table align="center">
                                <tr>
                                  <th>Nombre</th>
                                  <th>ID</th>
                                  <th>Código</th>
                                  <th>Nombre del Artículo</th>
                                  <th>Hora de préstamo</th>
                                  <th>Hora Entrega</th>
                                  <th>Multa</th>
                                </tr>
                              <div ng-repeat="prestamo in prestamos">
                                    <tr >
                                      <td><md-list-item >{{ prestamo.nombre}}</md-list-item> </td>
                                      <td><md-list-item >{{ prestamo.id}}</md-list-item></td>
                                      <td><md-list-item >{{ prestamo.codigo}}</md-list-item></td>
                                      <td><md-list-item >{{ prestamo.nombre_articulo}}</md-list-item></td>
                                      <td><md-list-item >{{ prestamo.hora_prestamo}}</md-list-item></td>
                                      <td><md-list-item >{{ prestamo.hora_entrega}}</md-list-item></td>
                                      <td><md-list-item ><md-checkbox class="md-secondary" ng-model="topping.wanted"></md-list-item> </td>
                                    </tr>
                              </div>
                            </table>
                          </div>
                      </div>

                  </body>
</html>

