<!DOCTYPE html>
<html ng-app="Prestamo">
    <head>
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/angular_material/1.0.0/angular-material.min.css">
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
        <?php
        if ( $errors ) {
            print '<ul class="errors">';
            foreach ( $errors as $field => $error ) {
                print '<li>'.htmlentities($error).'</li>';
            }
            print '</ul>';
        }
        ?>
        <div ng-controller="Prestar" layout="column" ng-cloak >
          <md-content class="md-padding" layout="row" layout-wrap layout-align="center start" style="background:#001525">
          <div flex="50" layout="column">
            <p>&nbsp;</p>
                <img src="http://www.anahuacoaxaca.edu.mx/images/galerias/tecnologias/logo-servtec-blanco.png" style="margin: 0 auto;">
            <p>&nbsp;</p>
            <form method="POST" action="">
                <div flex="" layout="column">
                    <md-card style="padding:30px">
                      <md-input-container class="md-block">
                        <label>ID</label>
                        <input  md-maxlength="8" required ng-model="id" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                      </md-input-container>
                      <md-input-container class="md-block">
                        <label>Código</label>
                        <input  md-maxlength="6" required ng-model="codigo">
                      </md-input-container>
                        <section layout="row" layout-sm="column" layout-align="center center" layout-wrap>
                            <md-button class="md-primary md-raised" ng-click="prestar()">Enviar</md-button>
                        </section>
                    </md-card>
                </div>
            </form>
            </div>
          </md-content>
        </div>          
    </body>
</html>
