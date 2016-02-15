var app =  angular.module('Prestamo', ['ngMaterial']);

app.controller('Prestar', function($scope, $http) {
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
          });
	}
});

app.controller('Entregar', function($scope, $http){
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
		});
	}
})
