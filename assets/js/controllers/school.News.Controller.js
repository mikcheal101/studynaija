var app = app || angular.module('schoolApp', ['ngAnimate', 'ngSanitize', 'angularUtils.directives.dirPagination', 'ngFileUpload']);
app.controller('schoolCntrl.news', function ($scope, Upload) {
	/** news section **/
	
	$scope.news = [];
	$scope.scope = $scope;
	
	$scope.init = function () {
		console.log ('initializing app');
	};
	
	$scope.newsuploadImage = function ($files) {
		$scope.newsDetails.files = $files;
	};
	
	$scope.clearNews = function () {
		$scope.newsDetails 	= {
			files : [],
			details : "",
			subject	: "",
			id		: 0
		};
	};
	
	$scope.loadNews = function () {
		$scope.clearNews ();
		$.getJSON ('loadNews')
		.then (
			function (news) {
				console.log (news);
				$scope.news = news.news;
				$scope.$digest ();
			},
			function (err) {}
		);
	};
	
	$scope.editNews = function ($index) {
		$scope.newsDetails = $scope.news[$index];
	}
	
	$scope.commitNews = function (form) {
		if (form.$valid) {
			Upload.upload ({
				url: 'commitNews',
				data : {
					files 	: $scope.newsDetails.files,
					param	: $scope.newsDetails
				}
			})
			.then (
				function (news) {
					news = news.data;
					if (news.type === 'save')
						$scope.news.unshift (news.news);
					$scope.clearNews ();
				},
				function (err) {
					console.error (err);
				}
			);
		}
	};
	
	$scope.dropNews = function ($index) {
		var news = $scope.news[$index];
		$scope.news.splice($index, 1);
		
		$.post ('dropNews', {id:news.id})
		.then (
			function (n) {
				//$scope.news.splice ($scope.news.indexOf (news));
				//$scope.$digest ();
			},
			function (err) {
				console.error (err);
			}
		);
	};

	
});