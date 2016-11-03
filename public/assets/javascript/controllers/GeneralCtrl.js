angular.module ('app.controller', [])

.controller ('AppController', function ($rootScope, $scope, $routeParams, $route, $filter, AppService, $location) {
	
	$scope.sessions 	= $rootScope.sessions || { authenticated: false, user: {} };
	$scope.templates 	= $rootScope.templates;

	$scope.breadcrumbs = [];
	$scope.setCrumbs = function (crumbs) {
		angular.copy (crumbs, $scope.breadcrumbs);
	};

	$scope.login 			= {};
	$scope.login.username 	= '';
	$scope.login.password 	= '';
	$scope.login.error 		= '';
	$scope.login.clear 		= function () {
		$scope.login.username = '';
		$scope.login.password = '';
	};
	$scope.login.authenticate = function () {
		AppService
		.authenticate ({user: {
			username : $scope.login.username,
			password : $scope.login.password
		}})
		.then (function (data) {
			$rootScope.sessions = $scope.sessions = { authenticated: data.auth, user: data.data };
			$scope.redirectToProfile (data);
		});
		$scope.login.clear ();
	}; 
	

	// redirection to the coorect profile page
	$scope.redirectToProfile = function (data) {
		data.auth = data.auth || data.authenticated;
		data.data = data.data || data.user;

		if (data.auth) {
			// switch through usertypes
			if (data.data.usertype === 1) {
				// Super Admin
				$location.path ('/sadmin/profile');

			} else if (data.data.usertype === 2) {
				//web admin
				$location.path ('/admin/profile');	

			} else if (data.data.usertype === 3) {
				// school admin
				$location.path ('/sch/profile');

			} else if (data.data.usertype === 4) {
				// applicant
				$location.path ('/app/profile');

			} else if (data.data.usertype === 5) {
				// school sub admin
				$location.path ('/schsub/profile');

			} else {
				$location.path ('/');
			}
		} else {
			$scope.login.error = 'Invalid username / password entered!';
		}
	};

	// global scope
	$rootScope.app 						= {};
	$rootScope.app.news_item 			= {};
	$rootScope.app.scholarship 			= {};
	$rootScope.app.state				= {};

	$rootScope.app.institutions 		= [];
	$rootScope.app.news 				= [];
	$rootScope.app.scholarships 		= [];
	$rootScope.app.states				= [];
	$rootScope.app.disciplines			= [];
	$rootScope.app.faculties 			= [];
	$rootScope.app.qualifications 		= [];
	$rootScope.app.educational_variants	= [];
	$rootScope.app.countries 			= [];
	$rootScope.app.english 				= [];
	$rootScope.app.funding 				= [];
	$rootScope.app.semesters 			= [];
	$rootScope.app.inst_types			= [];
	

	
	$rootScope.app.loadCountries  = function () {
		AppService
		.loadCountries ()
		.then (data => { angular.copy (data, $rootScope.app.countries); })
	};

	$rootScope.app.loadInstitutions = function () {
		AppService
		.loadInstitutions ()
		.then (data => { angular.copy (data, $rootScope.app.institutions); });
	};

	$rootScope.app.loadNews = function () {
		AppService
		.loadNews ()
		.then (data => { angular.copy (data, $rootScope.app.news); });
	};

	$rootScope.app.getNews = function () {
		AppService
		.getNews ($routeParams.id)
		.then (data => { angular.copy (data, $rootScope.app.news_item); });
	};	

	$rootScope.app.loadScholarships = function () {
		AppService
		.loadScholarships ()
		.then (data => { 
			angular.forEach(data, function(value){ value.details = value.details.replace(/\r?\n/g, '<br />'); });
			angular.copy (data, $rootScope.app.scholarships); 
		});
	};

	$rootScope.app.getScholarship = function () {
		AppService
		.getScholarship ($routeParams.id)
		.then (data => { data.details = data.details.replace(/\r?\n/g, '<br />'); angular.copy (data, $rootScope.app.scholarship); });
	};
	
	$rootScope.app.loadStates = function () {
		AppService
		.loadStates ()
		.then (data => { angular.copy (data, $rootScope.app.states); });
	};

	$rootScope.app.getState = function () {
		AppService
		.getState ($routeParams.id)
		.then (data => { angular.copy (data, $rootScope.app.state); });
	};

	$rootScope.app.loadDisciplines = function () {
		AppService
		.loadDisciplines ()
		.then (data => { angular.copy (data, $rootScope.app.disciplines); });
	};

	$rootScope.app.loadHighestQualifications = function () {
		AppService
		.loadHighestQualifications ()
		.then (data => { angular.copy (data, $rootScope.app.qualifications); });
	};

	$rootScope.app.loadFaculties = function () {
		AppService
		.loadFaculties ()
		.then (data => {
			angular.copy (data, $rootScope.app.faculties);
		});
	};

	$rootScope.app.loadEducationalVariants = function () {
		AppService
		.loadEducationalVariants ()
		.then (data => {
			angular.copy (data, $rootScope.app.educational_variants);
		});
	};
	
	$rootScope.app.loadEnglishLevels = function () {
		AppService
		.loadEnglishLevels ()
		.then (
			english => {
				angular.copy (english, $rootScope.app.english);
			}
		);
	};

	$rootScope.app.loadPaymentOptions = function () {
		AppService
		.loadPaymentOptions ()
		.then (
			funding => {
				angular.copy (funding, $rootScope.app.funding);
			}
		);
	};

	$rootScope.app.loadSemesters = function () {
		AppService
		.loadSemesters ()
		.then (
			semesters => {
				angular.copy (semesters, $rootScope.app.semesters);
			}
		);
	};

	$rootScope.app.loadInstitutionTypes = function () {
		AppService
		.loadInstitutionTypes ()
		.then (types => {
			angular.copy(types, $rootScope.app.inst_types);
		});
	};

	$rootScope.app.logout = function () {
		AppService
		.logout ()
		.then (out => { 
			$scope.sessions = $rootScope.sessions = { authenticated: false, user: {} };
			$location.path ('/login'); 
		});
	};

	$scope.app = $rootScope.app;

	$scope.search = {};

	$scope.search.count_states 		= 5;
	$scope.search.text 				= $rootScope.search_text || '';
	$scope.search.pricing 			= {};
	$scope.search.pricing.minimum 	= 0;
	$scope.search.pricing.maximum 	= 1000000;

	$scope.search.faculties 	= [];
	$scope.search.states 		= [];
	$scope.search.disciplines 	= [];
	$scope.search.awards		= [];
	$scope.search.educational_variants	= [];

	$scope.search.run = function () {
		// set the search string and move to the disciplines page
		$rootScope.search_text = $scope.search.text;
		if ($location.path() !== '/disciplines')
			$location.path ('/disciplines');
	};


	$scope.search.start = function () {
		$rootScope.app.loadFaculties ();
		$rootScope.app.loadStates ();
		$rootScope.app.loadInstitutions ();
		$rootScope.app.loadHighestQualifications ();
		$rootScope.app.loadDisciplines ();
		$rootScope.app.loadEducationalVariants ();
		$rootScope.app.loadSemesters ();
		$rootScope.app.loadPaymentOptions ();
		$rootScope.app.loadEnglishLevels ();
	};

	$scope.institutions_init = function () {
		$rootScope.app.loadInstitutions ();
	};

	$scope.news_init = function () {
		$rootScope.app.loadNews ();
	};

	$scope.init_scholarships = function () {
		$rootScope.app.loadScholarships ();
	};

	$scope.init_states = function () {
		$rootScope.app.loadStates ();
	}; 

	$scope.search.show_states = function () {
		$scope.search.count_states = $scope.app.states.length;
	};

	$scope.search.hide_states = function () {
		$scope.search.count_states = 5;	
	};

	$scope.search.pricing.minimum_change = function () {
		$scope.search.pricing.minimum = ($scope.search.pricing.minimum < 0) ? 0:$scope.search.pricing.minimum;

		if ($scope.search.pricing.maximum <= $scope.search.pricing.minimum) {
			$scope.search.pricing.maximum = $scope.search.pricing.minimum + 1;
		}
	};

	$scope.search.pricing.maximum_change = function () {
		$scope.search.pricing.maximum = ($scope.search.pricing.minimum < 1) ? 1:$scope.search.pricing.maximum;

		if ($scope.search.pricing.minimum >= $scope.search.pricing.maximum) {
			$scope.search.pricing.minimum = $scope.search.pricing.maximum - 1;
		}
	};

	$scope.getSingleNews = function () {
		$rootScope.app.getNews ();
	};

	$scope.getScholarship = function () {
		$rootScope.app.getScholarship ();
	};

	$scope.getState = function () {
		$rootScope.app.getState ();
	}


	// registration portal part
	$scope.register 		= {};
	$scope.register.user 	= { gender: 1 };
	$scope.register.error 	= '';

	$scope.app.register = function (form) {
		if (form.$valid) {
			$scope.register.user.dob	= $filter ('date')($scope.register.user.dob, 'yyyy-MM-dd');
			
			// send data to the server
			AppService
			.register ($scope.register.user)
			.then (
				saved => {
					if (saved.data) {
						// send mail
						$scope.register.info 	= 'Account Created!, A verification mail was sent to \''+$scope.register.user.email +'\'';
						$scope.register.user 	= { gender: 1 };
					} else {
						// display error
						$scope.register.error = 'Error registering account, Please try again later';
					}
				}, err => {
					$scope.register.error = 'Error registering account, Please try again later';
				}
			);
		}
	};
});