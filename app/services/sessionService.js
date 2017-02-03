'use strinc';
angular.module("loginApp")
	.factory("sessionService", ["$http", "$location", "blockUI", function($http, $location, blockUI){
		return{
			login: function(user){
				blockUI.start();
				var response = {};
			  $http.post("app/models/xhr_handler.php?r=login", user)
					.success(function(res){
						if(res.status == 200 && res.message == "OK"){
							var userToken = res.token;
							sessionStorage.setItem("authToken", userToken);
							$location.path('/panel');
							response.error = false;
							response.message = "";
						}
						else if(res.status == 200 && res.message == "WRONG DATA"){

							response.error = true;
							response.message = "Wrong username or password";
						}
						else {
							response.error = true;
							response.message = "Database error, try again later";
						}
						blockUI.stop();
					})
					.error(function(err){
						console.error(err);
					});
					return response;

			},
			validate: function(requested_url){
				if(sessionStorage.authToken){
					var localToken = {};
					localToken.token = sessionStorage.getItem("authToken");
					$http.post("app/models/xhr_handler.php?r=validate-session", localToken)
						.success(function(res){
							var result = res.state;

							if(result){
								if(requested_url == "login"){
									$location.path('/panel');
								}else{
									$location.path('/' + requested_url);
								}
							}else{
								$location.path('/');
							}
						})
						.error(function(err){
							console.error(err);
						})
				}
				else if(!sessionStorage.authToken){
					$location.path('/');
				}
			},
			get: function(){
				var response = {};
				if(sessionStorage.authToken){
					var localToken = {
						token: sessionStorage.authToken
					};
					$http.post("app/models/xhr_handler.php?r=get-username", localToken)
						.success(function(res){

							response.username = res.username;
							response.status = res.status;

						})
						.error(function(err){
							console.error(err);
						});
				}
				return response;
			},
			logout: function(){
				var localToken = {
					token: sessionStorage.authToken
				};
				$http.post("app/models/xhr_handler.php?r=logout", localToken)
					.success(function(data){
						if(data){
							sessionStorage.removeItem("authToken");
							$location.path("/");
						}else{
							console.error("Database trouble while ending a session");
						}
					})
					.error(function(err){
						console.error(err);
					})
			}
		};
	}]);
