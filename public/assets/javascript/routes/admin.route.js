angular.module ('admin.route', [])

.config (function ($routeProvider, $locationProvider) {
	$routeProvider
	
	// super admin urls
	.when ('/sadmin/profile', {
		templateUrl: '../templates/sadmin/profile.html',
		controller : 'AdminController'
	})

	.when ('/sadmin/messages', {
		templateUrl: '../templates/sadmin/messages.html',
		controller : 'AdminController'
	})

	// normal admin urls
	.when ('/admin/profile', {
		templateUrl: '../templates/admin/profile.html',
		controller : 'AdminController'
	})

	// general admin pages
	.when ('/admin/applicants', {
		templateUrl 	: '../templates/admin/applicants.html',
		controller 		: 'AdminController'
	})

	.when ('/sadmin/web_admins', {
		templateUrl 	: '../templates/sadmin/web_admins.html',
		controller 		: 'AdminController'
	})

	.when ('/admin/sch_admins', {
		templateUrl 	: '../templates/admin/sch_admins.html',
		controller 		: 'AdminController'
	})

	.when ('/admin/scholarships', {
		templateUrl 	: '../templates/admin/scholarships.html',
		controller 		: 'AdminController'
	})

	.when ('/admin/course_institution', {
		templateUrl 	: '../templates/admin/course_institution.html',
		controller 		: 'AdminController'
	})

	.when ('/admin/news', {
		templateUrl 	: '../templates/admin/news.html',
		controller 		: 'AdminController'
	})

	.when ('/admin/faculties', {
		templateUrl 	: '../templates/admin/faculties.html',
		controller 		: 'AdminController'
	})

	.when ('/admin/institutions_types', {
		templateUrl 	: '../templates/admin/institutions_types.html',
		controller 		: 'AdminController'
	})

	.when ('/admin/institutions', {
		templateUrl		: '../templates/admin/institutions.html',
		controller 		: 'AdminController'
	})

	// messages url
	.when ('/mail/compose', {
		templateUrl		: '../templates/mail/compose.html',
		controller 		: 'AdminController'
	})

	.when ('/mail/inbox', {
		templateUrl		: '../templates/mail/inbox.html',
		controller 		: 'AdminController'
	})

	.when ('/mail/sent', {
		templateUrl		: '../templates/mail/sent.html',
		controller 		: 'AdminController'
	})

	

	
});