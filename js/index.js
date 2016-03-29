var app =  angular.module('Prestamo', ['ngMaterial']);

app.controller('Prestar', function($scope, $http, $mdDialog, $mdToast, $document) {
	$scope.prestar = function(ev){

					 $http({
               method: 'POST',
               url: 'index.php?op=valid',
               data: $.param({'id_persona':$scope.id ,'codigo':$scope.codigo}),
               headers: {'Content-Type': 'application/x-www-form-urlencoded'}
           }).success(function(){
					 $http.get('http://localhost/sistema/index.php?op=valid&id_persona='+$scope.id+'&codigo='+$scope.codigo)
					    .success(function(data) {    
					        $scope.holas = data;
					       	console.log( $scope.holas);	
					       	if($scope.holas[1] == null || $scope.holas[0] == null){
							  		if($scope.holas[0] == null){
							  			var confirm = $mdDialog.confirm()
								          .title('Servicios Tecnologicos')
								          .textContent('El ID '+ $scope.id + ' no fue encontrado, ¿Desea Registrarlo?')
								          .targetEvent(ev)
								          .ok('Registrar')
								          .cancel('Cancelar');
								        $mdDialog.show(confirm).then(function() {
							          		 	console.log("error del ID");
									    }, function(){
									    	console.log("cancelado");
									    });
							  		}
							  		if($scope.holas[1] == null){
							  			var confirm = $mdDialog.confirm()
								          .title('Servicios Tecnologicos')
								          .textContent('El Codigo '+ $scope.codigo + ' no existe, ¿Desea Registrarlo?')
								          .targetEvent(ev)
								          .ok('Registrar')
								          .cancel('Cancelar');
								        $mdDialog.show(confirm).then(function() {
							          		 	console.log("Error del codigo");
									    }, function(){
									    	console.log("cancelado");
									    });
							  		}
					       	
						     	}else{
						     		var confirm = $mdDialog.confirm()
							          .title('Servicios Tecnologicos')
							          .textContent('Se presta el articulo '+$scope.holas[1].nombre_articulo+ ' a '+ $scope.holas[0].nombre)
							          .targetEvent(ev)
							          .ok('Prestar')
							          .cancel('Cancelar');
							        $mdDialog.show(confirm).then(function() {
						          		 	$http({
								              method: 'POST',
								              url: 'index.php?op=nuevo',
								              data: $.param({'id_persona':$scope.id ,'codigo':$scope.codigo}),
								              headers: {'Content-Type': 'application/x-www-form-urlencoded'}
							          		}).success(function(res){
							          		 	console.log(res);
							          		 	console.log("hola");
							          		  })
								    }, function(){
								    	console.log("cancelado");
								    });
						     	}

 			 		 });
				

					$scope.id = undefined;
					$scope.codigo = undefined;	

				}).error(function (){
					console.log ("error");
				});





           
        /*  	var popUp = $mdDialog.confirm()
		          .title('Servicios Tecnologicos')
		          .textContent('Se presta el articulo x a x')
		          .ariaLabel('')
		          .targetEvent(ev)
		          .ok('Prestar')
		          .cancel('Cancelar');

		    $mdDialog.show(confirm).then(function() {
			    $http({
	              method: 'POST',
	              url: 'index.php?op=new',
	              data: $.param({'id_persona':$scope.id ,'codigo':$scope.codigo}),
	              headers: {'Content-Type': 'application/x-www-form-urlencoded'}
          		 }).success(function(res){
          		 	console.log(res);
          		 	console.log("hola");
          		 })

		    }); */
	}		
});

app.controller('Validar', function ($scope, $http, $mdDialog, $document){
	$http({
               method: 'POST',
               url: 'index.php?op=valid',
               data: $.param({'id_persona':$scope.id ,'codigo':$scope.codigo}),
               headers: {'Content-Type': 'application/x-www-form-urlencoded'}
           })

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
					 $http.get('http://localhost/sistema/index.php?op=valid&id_persona='+$scope.id+'&codigo='+$scope.codigo)
					    .success(function(data) {    
					        $scope.holas = data;
					       	console.log($scope.holas);	
  			 		 });
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
});
app.controller('Lista', ['$scope', '$http', function ($scope, $http) {
    $http.get('http://localhost/sistema/?op=list')
    .success(function(data) {    
        $scope.items = data;
       	console.log($scope.items);	
    });



    $scope.change=function(a, b){


    };

}]);