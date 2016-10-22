angular.module ('applicant.controller', [])

.controller ('ApplicantController', function ($scope, $rootScope, $location, $filter, ApplicantService) {
	$scope.sessions 	= $rootScope.sessions;
	$scope.templates 	= $rootScope.templates;
	$scope.app 			= $rootScope.app;

	$scope.applicant 	= {};
	$scope.profile 		= {};
	$scope.documents	= {};

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
			// get the Applicant's details
			ApplicantService
			.profile ($scope.sessions.user.id)
			.then (
				details => {
					$scope.applicant = details;
					$scope.applicant.dob = new Date ($scope.applicant.dob);
				}
			);
		}
	}();

	$scope.breadcrumbs = [];
	$scope.setCrumbs = function (crumbs) {
		angular.copy (crumbs, $scope.breadcrumbs);
	};
	
	$scope.profile.updateProfile = function (form) {
		if (form.$valid) {
			$scope.applicant.oldpassword 	= $scope.sessions.user.password;
			$scope.applicant.profile_image 	= form.passport;
			
			console.log ('images: ', $scope.applicant.profile_image);

			ApplicantService
			.updateProfile ($scope.applicant, $scope.documents)
			.then (
				updated => {
					console.info ('updated: ', updated);
				}, err => {
					console.error ('error: ', err);
				}
			);
		}
	};

	$scope.profile.getImage = function (files) {
		$scope.documents.profile_image = files[0];
	};

});