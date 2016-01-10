app.controller('ContactCtrl', ['$scope', '$http', '$filter', 'toaster', function($scope, $http, $filter, toaster) {

function getGroups(){
  $http.get('groups').then(function (resp) {
    $scope.groups = resp.data.groups;
    $scope.group = $filter('orderBy')($scope.groups, 'type')[0];
  });
}

function getMembers(){
  $http.get('members').then(function (resp) {
    $scope.items = resp.data.items;
    $scope.item = $filter('orderBy')($scope.items, 'first')[0];
    $scope.item.selected = true;
  });
}
  getMembers();
  getGroups();


  $scope.filter = '';





  $scope.createGroup = function(){

bootbox.dialog({
                title: "This is a form in a modal.",
                message: '<div class="row">  ' +
                    '<div class="col-md-12"> ' +
                    '<form class="form-horizontal"> ' +
                    '<div class="form-group"> ' +
                    '<label class="col-md-4 control-label" for="name">Nombre</label> ' +
                    '<div class="col-md-4"> ' +
                    '<input id="name" name="name" type="text" placeholder="Nombre del grupo" class="form-control input-md" required> ' +
                    '</div> ' +
                    '</div> ' +
                    '<div class="form-group"> ' +
                    '<label class="col-md-4 control-label" for="awesomeness">¿Qué tipo de grupo va a crear?</label> ' +
                    '<div class="col-md-4"> <div class="radio"> <label for="awesomeness-0"> ' +
                    '<input type="radio" name="awesomeness" id="awesomeness-0" value="0" checked="checked"> ' +
                    '<i class="icon-moustache"></i> Departamento </label> ' +
                    '</div><div class="radio"> <label for="awesomeness-1"> ' +
                    '<input type="radio" name="awesomeness" id="awesomeness-1" value="1">'+
    				'<i class="fa fa-child"></i> Grupo escuela dominical </label> ' +
                    '</div> ' +
                    '</div> </div>' +
                    '</form> </div>  </div>',
                buttons: {
                    success: {
                        label: "Save",
                        className: "btn-success",
                        callback: function () {
                            var name = $('#name').val();
                            var answer = $("input[name='awesomeness']:checked").val()
				    		var group = {name: name, type: answer};
						    group.name = $scope.checkItem(group, $scope.groups, 'name');
							$http.post('groups?name='+group.name+'&type='+group.type).then(function (resp) {
								if (resp.data.msg=='Success'){
  									getGroups();
				          			toaster.pop('success','Grupo creado correctamente');
						    		$scope.groups.push(group);
								}else{
				          			toaster.pop('error','Error al actualizar, por favor vuelva a intentarlo');
								}
							},function(resp){
								toaster.pop('error','Error',"Falla en la comunicación con el servidor");
							});
                        }
                    }
                }
            }
        );
	/*bootbox.prompt("Introduce el nombre del grupo", function(result) {
		if(result!==null) {
    		var group = {name: result};
		    group.name = $scope.checkItem(group, $scope.groups, 'name');
			$http.post('groups?name='+group.name).then(function (resp) {
				if (resp.data.msg=='Success'){
          			toaster.pop('success','Grupo creado correctamente');
		    		$scope.groups.push(group);
				}else{
          			toaster.pop('error','Error al actualizar, por favor vuelva a intentarlo');
				}
			},function(resp){
			toaster.pop('error','Error',"Falla en la comunicación con el servidor");
		});
		}
	});*/
  };

  $scope.editGroup = function(item){
  	  var a,b;
  	if (item.type==0){
  		a='checked="checked"';
  	}else{
  		b='checked="checked"';
  	}
bootbox.dialog({
		title: "Edición de grupo: <b>"+item.name+"</b>",
                message: '<div class="row">  ' +
                    '<div class="col-md-12"> ' +
                    '<form class="form-horizontal"> ' +
                    '<div class="form-group"> ' +
                    '<label class="col-md-4 control-label" for="name">Nombre</label> ' +
                    '<div class="col-md-4"> ' +
                    '<input id="nameG" name="name" type="text" placeholder="Nombre del grupo" class="form-control input-md" value="'+item.name+'"> ' +
                    '</div> ' +
                    '</div> ' +
                    '<div class="form-group"> ' +
                    '<label class="col-md-4 control-label" for="awesomeness">¿Qué tipo de grupo va a crear?</label> ' +
                    '<div class="col-md-4"> <div class="radio"> <label for="awesomeness-0"> ' +
                    '<input type="radio" name="awesomeness" id="awesomeness-0" value="0 "'+a+'> ' +
                    '<i class="icon-moustache"></i> Departamento </label> ' +
                    '</div><div class="radio"> <label for="awesomeness-1"> ' +
                    '<input type="radio" name="awesomeness" id="awesomeness-1" value="1 "'+b+'>'+
    				'<i class="fa fa-child"></i> Grupo escuela dominical </label> ' +
                    '</div> ' +
                    '</div> </div>' +
                    '</form> </div>  </div>',
                buttons: {
                    success: {
                        label: "Guardar",
                        className: "btn-success",
                        callback: function () {
                            var name = $('#nameG').val();
                            var type = $("input[name='awesomeness']:checked").val()
							$http.put('groups/'+item.id+'?name='+name+'&type='+type).then(function (resp) {
								if (resp.data.msg=='Success'){
				          			toaster.pop('success','Grupo creado correctamente');
									getMembers();
                                    getGroups();
								}else{
				          			toaster.pop('error','Error al actualizar, por favor vuelva a intentarlo');
								}
							},function(resp){
								toaster.pop('error','Error',"Falla en la comunicación con el servidor");
							});
                        }
                    }
                }
            }
		);
  };

  $scope.checkItem = function(obj, arr, key){
    var i=0;
    angular.forEach(arr, function(item) {
      if(item[key].indexOf( obj[key] ) == 0){
        var j = item[key].replace(obj[key], '').trim();
        if(j){
          i = Math.max(i, parseInt(j)+1);
        }else{
          i = 1;
        }
      }
    });
    return obj[key] + (i ? ' '+i : '');
  };

  $scope.deleteGroup = function(item){
	bootbox.dialog({
	  title: "Confirme:",
	  message: "¿Está seguro de eliminar el grupo <b>"+item.name+"</b>?",
	  buttons: {
	    success: {
	      label: "Cancelar",
	      className: "btn-default",
	      callback: function() {return}
	    },
	    danger: {
	      label: "Borrar",
	      className: "btn-danger",
	      callback: function() {
			$http.delete('groups/'+item.id).then(function (resp) {
				if (resp.data.msg=='!empty'){
					toaster.pop('info','El grupo debe de estár vacío para ser eliminado');
				}else if(resp.data.msg=='Success'){
	    			$scope.groups.splice($scope.groups.indexOf(item), 1);
					toaster.pop('success','Eliminado correctamente');
				}else{
					toaster.pop('error','Error',"Hubo un problema en la acción");
				}
			});
	      }
	    }
	  }
	});
  };

  $scope.selectGroup = function(item){    
    angular.forEach($scope.groups, function(item) {
      item.selected = false;
    });
    $scope.group = item;
    $scope.group.selected = true;
    $scope.filter = item.name;
  };

  $scope.selectItem = function(item){    
    angular.forEach($scope.items, function(item) {
      item.selected = false;
      item.editing = false;
    });
    $scope.item = item;
    $scope.item.selected = true;
  };

  $scope.deleteItem = function(item){
	bootbox.dialog({
	  title: "Confirme:",
	  message: "¿Seguro desea eliminar el miembro <b>"+item.first+' '+item.last+"</b>?",
	  buttons: {
	    success: {
	      label: "Cancelar",
	      className: "btn-default",
	      callback: function() {return}
	    },
	    danger: {
	      label: "Borrar",
	      className: "btn-danger",
	      callback: function() {
			$http.delete('members/'+item.id).then(function (resp) {
				if(resp.data.msg=='Success'){
				    $scope.items.splice($scope.items.indexOf(item), 1);
				    $scope.item = $filter('orderBy')($scope.items, 'first')[0];
				    if($scope.item) $scope.item.selected = true;
					toaster.pop('success','¡Bien!',"Eliminado con éxito");
				}else{
					toaster.pop('error','Error',"Hubo un problema en la acción");
				}
			});
	      }
	    }
	  }
	});
  };

  $scope.createItem = function(){
    var item = {
      group: 'Friends',
      avatar:'img/a0.jpg'
    };
    $scope.items.push(item);
    $scope.selectItem(item);
    $scope.item.editing = true;
  };

  $scope.editItem = function(item){
	$scope.valItemA=item.name;
    if(item && item.selected){
      item.editing = true;
    }
  };

  $scope.doneEditing = function(item){
  	item.group=item.group_id;
  	if (item.id==null){
		$http.post('members',item).then(function (resp) {
			if (resp.data.msg=='Success'){
	    		item.editing = false;
	    		item.group=resp.data.member.group;
				toaster.pop('success','¡Bien!',"El nuevo miembro ha sido registrado");
			}else{
				toaster.pop('error','Error',"Hubo un problema en la acción");
			}
		},function(resp){
			toaster.pop('error','Error',"Falla en la comunicación con el servidor");
		});
  	}else{
		$http.put('members/'+item.id,item).then(function (resp) {
			if (resp.data.msg=='Success'){
	    		item.editing = false;
	    		item.group=resp.data.member.group;
				toaster.pop('success','¡Bien!',"Los cambios han sido guardados");
			}else{
				toaster.pop('error','Error',"Hubo un problema en la acción");
			}
		},function(resp){
			toaster.pop('error','Error',"Falla en la comunicación con el servidor");
		});
	}
  };
}]);

