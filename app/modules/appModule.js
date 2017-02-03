'use strict';
var appinit = true; //This variable will protect your views
/*
*Instead of use a bad practice declaring our app module in a variable, we can use a custom variable like that
*/
angular.module("loginApp", [
	"ngRoute",
	"blockUI"]);
