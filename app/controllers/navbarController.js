'use strict';
angular.module("loginApp")
  .controller("navbarController", ["$scope", "sessionService", function($scope, sessionService){
    $scope.logout = function(){
        sessionService.logout();
    };
  }]);
