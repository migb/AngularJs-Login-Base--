'use strict';

angular.module("loginApp")
	.config(["$routeProvider", function($routeProvider){
		var baseUrl = "app/views/";
		var appBase = baseUrl + "app/";
		$routeProvider
			.when("/", {
				templateUrl: baseUrl + "login.html",
				controller: "loginController"
			})
			.when("/panel", {
				templateUrl: appBase + "panel.html",
				controller: "panelController"
			})
			.when("/somepage", {
				templateUrl: appBase + "somepage.html",
				controller: "somepageController"
			})
			.otherwise({
				redirectTo: "/"
			});

	}]);
