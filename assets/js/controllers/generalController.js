var app = angular.module('generalApp', ['ngAnimate', 'ngFileUpload', 'angularUtils.directives.dirPagination', 'user.services', 'user.controller']);

app.run (function ($rootScope) {
	$rootScope.server 				= {};
	$rootScope.server.host 			= 'http://localhost:81/studynaija/usersController/';
	$rootScope.server.scholarships	= $rootScope.server.host + 'loadScholarships';
	$rootScope.server.news			= $rootScope.server.host + 'loadNews';
	
});

//app.controller('generalCntrl', function ($scope, $http, $rootScope) {});
