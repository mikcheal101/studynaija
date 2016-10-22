angular.module ('app.route', [])

.config (function ($routeProvider, $locationProvider) {

	$routeProvider

	.when ('/', {
		templateUrl		: '../templates/index.html',
		controller 		: 'AppController'
	})

	.when ('/states', {
		templateUrl		: '../templates/states.html',
		controller 		: 'AppController'
	})

	.when ('/state/:id/:name', {
		templateUrl		: '../templates/state.html',
		controller 		: 'AppController'
	})

	.when ('/institutions', {
		templateUrl 	: '../templates/institutions.html',
		controller 		: 'AppController'
	})

	.when ('/institution/:id/:name', {
		templateUrl 	: '../templates/institution.html',
		controller 		: 'AppController'
	})

	.when ('/disciplines', {
		templateUrl 	: '../templates/disciplines.html',
		controller 		: 'AppController'
	})

	.when ('/register', {
		templateUrl		: '../templates/register.html',
		controller 		: 'AppController'
	})

	.when ('/login', {
		templateUrl		: '../templates/login.html',
		controller 		: 'AppController'
	})

	.when ('/discipline/:id/:name', {
		templateUrl 	: '../templates/discipline.html', 
		controller 		: 'AppController'
	})

	.when ('/news', {
		templateUrl 	: '../templates/news.html',
		controller 		: 'AppController'
	})

	.when ('/news/:id/:name', {
		templateUrl 	: '../templates/news_item.html',
		controller 		: 'AppController'
	})

	.when ('/scholarships', {
		templateUrl 	: '../templates/scholarships.html',
		controller 		: 'AppController'
	})

	.when ('/scholarship/:id/:name', {
		templateUrl 	: '../templates/scholarship.html',
		controller 		: 'AppController'
	})


	// applicant protected urls
	.when ('/app/profile', {
		templateUrl 	: '../templates/applicant/profile.html',
		controller 		: 'ApplicantController'
	})

	//school protected urls
	.when ('/sch/profile', {
		templateUrl 	: '../templates/sch/profile.html',
		controller 		: 'InstitutionController'
	})

	.when ('/schsub/profile', {
		templateUrl 	: '../templates/schadmin/profile.html',
		controller 		: 'InstitutionController'
	})


	.when ('/404', {
		template : `
			error no such page`
	})

	.otherwise ('/404');

	$locationProvider.html5Mode(true);
});