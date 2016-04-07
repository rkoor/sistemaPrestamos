var app =  angular.module('Prestamo', ['ngMaterial']);

app.controller('Prestar', function($scope, $http, $mdDialog, $mdToast, $document) {

	$scope.newPopup = function(url) {
              popupWindow = window.open(
                url,'popUpWindow','height=300,width=400,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
            }
            
	$scope.save= function(a,b,d,e){
						     		var confirm = $mdDialog.confirm()
							          .title('Servicios Tecnologicos')
							          .textContent('Se presta el articulo '+a+ ' a '+ b)
							          .targetEvent()
							          .ok('Prestar')
							          .cancel('Cancelar');
							        $mdDialog.show(confirm).then(function() {
							        	console.log("ACEPTAR");
						          		 	$http.get('index.php?op=nuevo&id_persona='+d+'&codigo='+e).success(function(res){
							          			console.log(res);
							          			console.log("Se guardó");
							          		  })
								    }, function(){
								    	console.log("cancelado");
								    });
	}

	$scope.fprestar = function(idpersona,codigoart, ev){
							 $http.get('index.php?op=valid&id_persona='+idpersona+'&codigo='+codigoart)
					    .success(function(data) {  
					        $scope.holas = data;
					        if($scope.holas[1] == null && $scope.holas[0] == null){
					        	var confirm = $mdDialog.confirm()
								          .title('Servicios Tecnologicos')
								          .textContent('Ingresa tu ID y el Codigo del producto')
								          .targetEvent(ev)
								          .ok('ACEPTAR')
								        $mdDialog.show(confirm).then(function(){
									    }, function(){
									    	console.log("cancelado");
									    });
					        } else if($scope.holas[1] == null || $scope.holas[0] == null){
							  		if($scope.holas[0] == null){
							  			var confirm = $mdDialog.confirm()
								          .title('Servicios Tecnologicos')
								          .textContent('El ID no fue encontrado, ¿Desea Registrarlo?')
								          .targetEvent(ev)
								          .ok('Registrar')
								          .cancel('Cancelar');
								        $mdDialog.show(confirm).then(function() {
							          		 	$mdDialog.show({
												        templateUrl: '172.23.14.31/biblioteca/form.php',
												        parent: angular.element(document.body),
												        
												        clickOutsideToClose:true
												      })

									    }, function(){
									    	console.log("cancelado");
									    });
							  		}
							  		if($scope.holas[1] == null){
							  			var confirm = $mdDialog.confirm()
								          .title('Servicios Tecnologicos')
								          .textContent('El Codigo no existe, ¿Desea Registrarlo?')
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
						     		console.log("-----"+idpersona+"-------");
									$scope.save($scope.holas[1].nombre_articulo, $scope.holas[0].nombre,idpersona,codigoart);

						     	}


 			 		 });
				

						
	}
	$scope.prestar = function(ev){
					 $http({
               method: 'POST',
               url: 'index.php?op=valid',
               data: $.param({'id_persona':$scope.id ,'codigo':$scope.codigo}),
               headers: {'Content-Type': 'application/x-www-form-urlencoded'}
           }).success(function(){
           		$scope.fprestar($scope.id,$scope.codigo,ev);
           		$scope.id = undefined;
							$scope.codigo = undefined;
				}).error(function (){
					console.log ("error");
				});
	}		
});

app.controller('Entregar', function($scope, $http, $mdDialog, $document){
	
	$scope.pentregar = function (){
			if( $scope.codigo == undefined){
				$mdDialog.show(
			      $mdDialog.alert()
			        .clickOutsideToClose(true)
			        .title('¡Error!')
			        .textContent('Ingresar articulo')
			        .ariaLabel('Alert Dialog')
			        .ok('Aceptar')
			    );
			}else{ 
				$scope.entregaexiste($scope.codigo);
			}
			
	}
	$scope.entregaexiste = function (codigoart){
		console.log(codigoart);
		$http.get('index.php?op=articuloexists&codigo='+codigoart)
		.success(function(data){
			$scope.estado = data;
			if($scope.estado.codigo != null){
				$scope.entregar(codigoart);
			}else {
				$mdDialog.show(
			      $mdDialog.alert()
			        .clickOutsideToClose(true)
			        .title('¡Error!')
			        .textContent('El articulo no existe')
			        .ariaLabel('Alert Dialog')
			        .ok('Aceptar')
			        .targetEvent($scope.entrega(codigoart))
			        );
			}
			
		})
	}

	$scope.entregar = function(codigoart, ev){
		$http.get('index.php?op=updatevalid&codigo='+codigoart)
			.success(function(data){
			$scope.estado = data;
			console.log( $scope.estado[0].Estado + " estado");
			console.log($scope.estado[1].valormulta + " multa");
				if($scope.estado[0].Estado == 0){
					if($scope.estado[1].valormulta >= 6){
						$mdDialog.show(
			      $mdDialog.alert()
			        .clickOutsideToClose(true)
			        .title('¡Alerta!')
			        .textContent('EL PRESTAMO TIENE MULTA')
			        .ariaLabel('Alert Dialog')
			        .ok('Aceptar')
			        .targetEvent($scope.entrega(codigoart))
			        );
					}
					$mdDialog.show(
			      $mdDialog.alert()
			        .clickOutsideToClose(true)
			        .title('Listo!')
			        .textContent('El articulo: '+ $scope.estado[0].nombre_articulo+' fue entregado satisfactoriamente')
			        .ariaLabel('Alert Dialog')
			        .ok('Aceptar')
			        .targetEvent($scope.entrega(codigoart))
			    );
				} else {
					console.log("El articulo no se encuentra en prestamo");
					$mdDialog.show(
				      $mdDialog.alert()
				        .clickOutsideToClose(true)
				        .title('¡Error!')
				        .textContent('El articulo no se encuentra en prestamo')
				        .ariaLabel('Alert Dialog')
				        .ok('Aceptar')
			    );
				}
				$scope.codigo= undefined;
			});
		}
	$scope.entrega = function(codigoart){
		$http.get('index.php?op=update&codigo='+codigoart)
		.success(function(data){
			console.log("Codigo en entrega ******** " + codigoart);
			})
	}
});

app.controller('Lista', ['$scope', '$http', function ($scope, $http) {
    $http.get('index.php?op=list')
    .success(function(data) {    
        $scope.items = data;
        console.log($scope.items);
    });
    $scope.change=function(multa_hora){
    	$http.get('index.php?op=updatemulta&multa_hora='+multa_hora).success(function(res){
			console.log(multa_hora);
			})
    };
}]);

app.controller('Consulta', function ($scope, $http, $mdDialog, $document){
	$scope.consultar = function (){
		$http.get('index.php?op=cons&nombre='+$scope.nombre).success(function(data){
			$scope.personas = data;
						
		});
			
		
	}
});