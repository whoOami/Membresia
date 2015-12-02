'use strict';

/* Controllers */
  // signin controller
app.controller('SigninFormController', function($scope, $location, $auth, toaster) {
    $scope.login = function() {
      toaster.pop('wait','Iniciando sesión');
      $auth.login($scope.user)
        .then(function() {
          toaster.pop('success','Acceso autorizado');
          $location.path('/');
        })
        .catch(function(response) {
        	toaster.pop('error','Datos erroneos','Nombre de usuario o contraseña inválidos');
        });
    };
    $scope.authenticate = function(provider) {
      $auth.authenticate(provider)
        .then(function() {
          toaster.pop('success','You have successfully signed in with ' + provider);
          $location.path('/');
        })
        .catch(function(response) {
          toaster.pop('error',response.data.message);
        });
    };
  });
