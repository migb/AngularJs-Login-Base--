'use strict';
angular.module("loginApp")
	   .controller("somepageController", ["$scope", "sessionService", function($scope, sessionService){
  		/*==============variables and objects===============*/
  		$scope.navigation = true; //show the menu bar, necessary in every view controller
  		/*==============functions===============*/
      $scope.loggedInValidation = function(){
  			sessionService.validate("somepage"); //it needs the requested url
  		};

      $scope.getUser = function(){
        $scope.userInfo =  sessionService.get();
      };
  		/*==============Inits===============*/
      //those functions are required in every controller of your app
      $scope.loggedInValidation();
      //this gets the username for logged user. use it in the views that you want to show it
      $scope.getUser();


	}]);
