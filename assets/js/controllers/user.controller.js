var user = angular.module ('user.controller', []);

user.controller ('generalCntrl', function ($scope, Upload, Scholarship, $rootScope, News) {
	
	/** scholarships segment **/
	$scope.scholarship 	= {};
	$scope.scholarships = [];
	$scope.loadScholarships = function () {
		Scholarship.fetchAll().then (function (r) {angular.copy(r, $scope.scholarships);});
	};

	/** news section **/
	$scope.news 	= {};
	$scope._news 	= [];
	$scope.loadNews = function () {News.fetchAll().then(function (n) {angular.copy(n, $scope._news);});};

});