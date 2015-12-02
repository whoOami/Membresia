app.controller('LogoutFormController', function($scope, $location, $auth) {
    if (!$auth.isAuthenticated()) {
        $location.path('/access/signin');
        return;
    }
    $auth.logout()
      .then(function() {
        $scope.authError='You have been logged out';
        $location.path('/access/signin');
      });
  });

