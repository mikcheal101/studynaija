var app = app || angular.module('adminApp', ['angularUtils.directives.dirPagination', 'ngFileUpload', 'ngSanitize', 'ngAnimate', 'checklist-model']);

app.controller ('ts', ['$scope', '$http', function ($scope, $http) {
	
	$scope.schools = [
		{
			id: 1,
			name : 'uni jos'
			
		},
		{
			id: 2,
			name : 'uni lag'
			
		},
		{
			id: 3,
			name : 'uni gwags'
		}
	];
	
	$scope.courses = [
		{
			id : 1,
			name : 'geography',
			schools : []
		},
		{
			id : 2,
			name : 'medicine',
			schools : [
				{
					id : 2,
					name : 'uni lag'
				}
			]
		},
		{
			id : 3,
			name : 'physics',
			schools : []
		},
		{
			id : 4,
			name : 'botany',
			schools : []
		}
	];

	$scope.specialValue = "hello";
	
	$scope.coursesDisplay = {};
	$scope.disciplineDisplay = {};
	
	$scope.displayCourse = function (x) {
		$scope.disciplineDisplay = x;
		$scope.displayDiscipline = x.schools;
	}
	
	$scope.displayDiscipline = function (x) {
		$scope.coursesDisplay = x;
	}
	
	$scope.formData = {};
	
}]);