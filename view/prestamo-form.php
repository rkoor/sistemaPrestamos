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
          <md-tabs md-dynamic-height md-border-bottom>
            <md-tab label="PRESTAMO">
              <div ng-controller="Prestar" layout="column" ng-cloak >
                <md-content class="md-padding">
                  <div layout="column">
                        <form method="POST" action="">
                            <div layout="column">
                                  <md-input-container class="md-block">
                                    <label>ID</label>
                                    <input  required ng-model="id">
                                  </md-input-container>
                                  <md-input-container class="md-block">
                                    <label>Código</label>
                                    <input required ng-model="codigo">
                                  </md-input-container>
                                    <section layout="row" layout-sm="column" layout-align="center center" layout-wrap>
                                        <md-button class="md-primary md-raised" ng-click="prestar()">Enviar</md-button>
                                    </section>
                            </div>
                        </form>
                    </div>
                </md-content>
              </div>


            </md-tab>
                <md-tab label="ENTREGA">
                <div ng-controller="Entregar" layout="column" ng-cloak >
                  <md-content class="md-padding">
                      <div layout="column">
                          <form method="POST" action="">
                              <div layout="column">
                                <div ng-controller="Entregar" layout="column" ng-cloak class="md-inline-form">               
                                      <md-input-container focused class="md-block">
                                        <label>Código</label>
                                        <input required ng-model="codigo">
                                      </md-input-container>
                                      <section layout="row" layout-sm="column" layout-align="center center" layout-wrap>
                                        <md-button class="md-primary md-raised" ng-click="pentregar()">Enviar</md-button>
                                      </section>
                                </div>
                              </div>
                          </form>
                      </div>
                  </md-content>
                  </div>
                </md-tab>
                </md-tab>
            </md-tabs>
            </div>
          </md-content>
        </div>  
        <md-button class="md-fab md-mini md-primary" aria-label="Use Android" href="index.php?op=lista">
          <md-tooltip md-direction="right">
            LISTADO DE PRESTAMOS
          </md-tooltip>
        </md-button> 
    </body>
</html>




