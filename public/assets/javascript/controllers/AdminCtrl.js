angular.module ('admin.controller', [])

.controller ('AdminController', function ($scope, $rootScope, $location, $filter) {
	$scope.sessions 	= $rootScope.sessions;
	$scope.templates 	= $rootScope.templates;
	$scope.app 			= $rootScope.app;
	$scope.admin 		= {};

	// verify if the user is logged in
	$scope.constructor = function () {
		$scope.sessions = $rootScope.sessions;
		$scope.app.loadCountries ();
		$scope.app.loadFaculties ();
		$scope.app.loadStates ();
		$scope.app.loadInstitutions ();
		$scope.app.loadHighestQualifications ();
		$scope.app.loadDisciplines ();
		$scope.app.loadEducationalVariants ();
		$scope.app.loadSemesters ();
		$scope.app.loadPaymentOptions ();
		$scope.app.loadEnglishLevels ();

		if ($scope.sessions.authenticated === false) {
			$location.path ('/login');
		} else {
			// get the Admin's details
			$scope.admin = $scope.sessions.user;
		}
	}();

	$scope.updateProfile = function (form) {
		console.log ('submitted form ', form);
		if (form.$valid) {
			console.log (form);
		}
	};

});