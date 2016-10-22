angular.module ('app', ['ngRoute', 'ngAnimate', 'angular-loading-bar', 'checklist-model', 'ngFileUpload',
	'app.controller', 'admin.controller', 'applicant.controller', 'institution.controller', 
	'admin.route', 'applicant.route', 'app.route', 'institution.route', 'webadmin.route', 	
	'admin.service', 'applicant.service', 'app.service', 'institution.service',
	'app.directives'
	])

.run (function ($rootScope, AppService) {
	
	$rootScope.api = {};
	$rootScope.sessions = {};

	$rootScope.api.institutions		= '/api/institutions';
	$rootScope.api.states			= '/api/states';
	$rootScope.api.news				= '/api/news';
	$rootScope.api.getNews			= '/api/single_news';
	$rootScope.api.scholarships		= '/api/scholarships';
	$rootScope.api.authenticate		= '/api/authenticate';
	$rootScope.api.disciplines		= '/api/disciplines';
	$rootScope.api.faculties		= '/api/faculties';
	$rootScope.api.register			= '/api/register';
	$rootScope.api.countries		= '/api/countries';
	$rootScope.api.semesters		= '/api/semesters';
	$rootScope.api.funding			= '/api/funding';
	$rootScope.api.english			= '/api/english';

	
	$rootScope.api.login 			= '/api/authenticate';
	$rootScope.api.sessions			= '/api/session';
	$rootScope.api.signout			= '/api/signout';
	$rootScope.api.verifyEmail		= '/api/verifyemail';
	$rootScope.api.verifyUsername	= '/api/verifyusername';

	$rootScope.api.highest_qualifications 	= '/api/highest_qualification';
	$rootScope.api.educational_variants 	= '/api/educational_variants';

	// applicant calls
	$rootScope.user = {
		profile 		: '/api/applicantprofile',
		updateProfile	: '/api/applicantUpdateProfile'
	};

	// admin
	$rootScope.admin = {
		
	};


	// headers
	$rootScope.templates = {
		header  		:'templates/headers/general_header.html',
		search			:'templates/headers/search_bar.html',
		aside_search 	:'templates/headers/aside_search.html',
		applicant_side	:'templates/headers/applicant-side.html',
		admin_side		:'templates/headers/admin-side.html',
		ordinary_bar	:'templates/headers/ordinary_bar.html',
		mail_side		:'templates/headers/mail-side.html',
	};

	// check the user session
	AppService
	.session ()
	.then (data => {
		angular.copy (data, $rootScope.sessions);
	});
})

.filter ('underline', () => {
	return (x, y) => {
		return x.replace (/ /g, '_');
	};
})

.filter ('gender', () => {
	return (x)  => {
		return (x === 1)? 'Male':'Female';
	}
})

