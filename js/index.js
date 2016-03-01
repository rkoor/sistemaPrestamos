var app =  angular.module('Prestamo', ['ngMaterial']);

app.controller('Prestar', function($scope, $http, $mdToast, $document) {
	$scope.prestar = function(){
		console.log($scope.id, $scope.codigo);
		$http({
               method: 'POST',
               url: 'index.php?op=new',
               data: $.param({'id_persona':$scope.id ,'codigo':$scope.codigo}),
               headers: {'Content-Type': 'application/x-www-form-urlencoded'}
           })
           .success(function(res){
           	console.log(res);
           	if (res==1) {	
           	$mdToast.show(
	                    $mdToast.simple()
                        .textContent('Prestamo Guardado')                       
                        .hideDelay(3000)
	                  );
           } else {
           	$mdToast.show(
	                    $mdToast.simple()
                        .textContent('ERROR, Ingrese su ID y el codigo del Prestamo')                       
                        .hideDelay(3000)
	                  );
           }
          });

      	$scope.codigo = undefined;
		$scope.id = undefined;

	}		
});
app.controller('Entregar', function($scope, $http, $mdToast, $document){
	$scope.entregar = function(){
		console.log($scope.codigo);
		$http({
			method: 'POST',
			url: 'index.php?op=update',
			data: $.param({'codigo':$scope.codigo}),
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		})
		.success(function(res){
			console.log(res);
			if (res==1) {	
           	$mdToast.show(
	                    $mdToast.simple()
                        .textContent('Entregado')                       
                        .hideDelay(3000)
	                  );
           } else {
           	$mdToast.show(
	                    $mdToast.simple()
                        .textContent('No se encontro el prestamo')                       
                        .hideDelay(3000)
	                  );
           }
		});
		$scope.codigo= undefined;
	}
})
