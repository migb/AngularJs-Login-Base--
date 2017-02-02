'use strict';
angular.module("loginApp")
	.controller("loginController", ["$scope", "sessionService", function($scope, sessionService){
		/*==============variables and objects===============*/
		//Define the object that contains the user information [username and password]
		$scope.authData = {
			username: undefined,
			password: undefined
		};

		/*==============functions===============*/
		//Validate user session and generate a token
		$scope.login = function(){
				//Call the session service to validate the user
				$scope.loginStatus = sessionService.login($scope.authData);
		};

		//Check if the user is already logged in and if its true recolate the user to the main app page
		$scope.userIsLogged = function(){
			sessionService.validate("login");
		};

		/*==============Inits===============*/
		$scope.userIsLogged();

	}]);
