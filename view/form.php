</head>

<body class="formulario" ng-app="Nuevo">
  <div ng-controller="Registrar" layout="column" ng-cloak>
    <md-content layout-padding>
      <form id="reg" name="reg" method="get" action="form.php" accept-charset="UTF-8" enctype="application/x-www-form-urlencoded" ng-submit="enviar()">
        <md-input-container class="md-block">
          <label>ID</label>
          <input type="text" pattern="[0-9]{8}" name="id" ng-model="id" id="fr" required>
        </md-input-container>
        <md-input-container class="md-block">
          <label>Nombre</label>
          <input type="text" name="name" id="fr" ng-model="name" required autofocus>
        </md-input-container>
        <md-input-container class="md-block">
          <label>Escuela</label>
          <md-select ng-model="otro" name="esc" id="escuela" ng-change="verCarrera()">
            <md-option ng-repeat="esc in escuelas" value="{{esc.escuela}}">
              {{esc.nombre_esc}}
            </md-option>
          </md-select>
        </md-input-container>
        <md-input-container class="md-block">
          <label>Carrera</label>
          <md-select ng-model="otro2" name="carr" id="carrera" required>
            <md-option ng-repeat="carrera in carreras" value="{{carrera.carrera}}">
            {{carrera.carrera}}
            </md-option>
          </md-select>
        </md-input-container>
        <md-input-container class="md-block">
          <label>Semestre</label>
          <input type="number" name="sem" ng-model="sem" id="fr" min="1" required/>
        </md-input-container>
        <section layout="row" layout-sm="column" layout-align="center center" layout-wrap>
          <md-button class="md-raised md-primary" type="submit">Enviar</md-button>
        </section>
      </form>
    </md-content>
  </div>



  <!-- Angular Material requires Angular.js Libraries -->
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-animate.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-aria.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-messages.min.js"></script>

  <!-- Angular Material Library -->
  <script src="http://ajax.googleapis.com/ajax/libs/angular_material/1.0.0/angular-material.min.js"></script>
<script type="text/javascript">
  var app = angular.module('Nuevo', ['ngMaterial']);
  app.controller('Registrar', function($scope, $http){
    $http.get('js/escuela.json')
      .success(function(data){
        $scope.escuelas=data;
      })
      .error(function(error){
        console.log("ERROR " + error);
      });
    $scope.verCarrera = function(){
      document.getElementById("carrera").disabled = false;
      $http.get('index.php?metodo=carreras&esc='+$scope.otro)
        .success(function(data){
          $scope.carreras=data;
        })
        .error(function(error){
          console.log("ERROR " + error);
        });
    };
    $scope.enviar = function(){
      $http.get('index.php?metodo=nuevo&id='+$scope.id+'&name='+$scope.name+'&esc='+$scope.otro+'&carr='+$scope.otro2+'&sem='+$scope.sem)
        .success(function(data){
          if (data==1){
            alert("Gracias por registrarte, Ahora ingresa tu ID y checa Entrada");
            window.close();
          }
          else alert("Algo ocurrió mal, intenta más tarde");
        })
        .error(function(error){
          console.log("ERROR " + error);
        });
    };
  });
</script>
</body>
</html>