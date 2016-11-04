angular.module ('app', ['ngRoute', 'ngAnimate', 'angular-loading-bar', 'checklist-model', 'ngFileUpload', 'angularUtils.directives.dirPagination', 'ngSanitize',
	'app.controller', 'admin.controller', 'applicant.controller', 'institution.controller', 
	'admin.route', 'applicant.route', 'app.route', 'institution.route', 'webadmin.route', 	
	'admin.service', 'applicant.service', 'app.service', 'institution.service',
	'app.directives'
	])

.run (function ($rootScope, AppService) {
	
	$rootScope.api = {};
	$rootScope.sessions = {};

	// general routes
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
	$rootScope.api.institutionTypes	= '/api/institution_types';
	$rootScope.api.excel_to_json	= '/api/excel_to_json';

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

	// admin routes
	$rootScope.admin = {
		updateProfile 	: '/api/admin/updateAdminProfile',
		updateDocType	: '/api/admin/updateDocumentType',

		loadApplicants	: '/api/admin/loadApplicants',
		loadWebAdmins	: '/api/admin/webAdmins',
		loadSchAdmins	: '/api/admin/schoolAdmins',
		loadDocTypes	: '/api/admin/document_types',
		
		dropDocType		: '/api/admin/dropDocumentType',
		dropWebAdmin	: '/api/admin/dropWebAdmin',
		dropSchAdmin	: '/api/admin/dropSchoolAdmin',
		dropScholarship	: '/api/admin/dropScholarship',
		dropNews		: '/api/admin/dropNews',
		dropFaculty		: '/api/admin/dropFaculty',
		dropInstType	: '/api/admin/dropInstitutionType',
		dropInst 		: '/api/admin/dropInstitution',
		
		createDocType	: '/api/admin/createDocumentType',
		createWebAdmin	: '/api/admin/createWebAdmin',
		createSchAdmin	: '/api/admin/createSchoolAdmin',
		createNews		: '/api/admin/createNews',
		createFaculty	: '/api/admin/createFaculty',
		createInstType	: '/api/admin/createInstitutionType',
		createInst 		: '/api/admin/createInstitution',
		createScholarship:'/api/admin/createScholarship',
		asignSchDesci	: '/api/admin/asignCourseInstitution',

		editWebAdmin	: '/api/admin/editWebAdmin',
		editSchAdmin	: '/api/admin/editSchoolAdmin',
		editScholarship	: '/api/admin/editScholarship',
		editFaculty		: '/api/admin/editFaculty',
		editInstType	: '/api/admin/editInstitutionType',
		editInst 		: '/api/admin/editInstitution',

		verifyInstName 	: '/api/admin/verifyInstitutionName',
		verifyFacName	: '/api/admin/verifyfacultyName'
	};

	// institution routes
	$rootScope.inst = {
		getSubadmin 		: '/api/inst/subadmins',
		getScholarships		: '/api/inst/scholarships',
		recvApplications	: '/api/inst/recieved_applications',
		createScholarship	: '/api/inst/create_scholarship',
		editScholarship 	: '/api/inst/edit_scholarship',
		dropScholarship		: '/api/inst/drop_scholarship',
		createApplication	: '/api/inst/create_application',
		closeApplication	: '/api/inst/close_application',
		dropApplication		: '/api/inst/drop_application',
		editApplication		: '/api/inst/edit_application',
		viewApplicants		: '/api/inst/view_applicants',
		reviewApplicant		: '/api/inst/review_applicant',
		viewApplicant 		: '/api/inst/view_applicant',
		listNews			: '/api/inst/news',
		addNews				: '/api/inst/add_news',
		dropNews			: '/api/inst/drop_news',
		updateProfile 		: '/api/inst/update_profile',
		assignCourses 		: '/api/inst/assign_courses',
		ourCourses			: '/api/inst/our_courses',
		getOurCourse		: '/api/inst/get_course',
		updateCourse 		: '/api/inst/update_course',
		dropCourse			: '/api/inst/drop_course'
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

.filter('htmlToPlaintextTruncate', function() {
	return function(text, length, end) {
		var htmlToPlaintext;
		if (isNaN(length))
			length = 10;
 
		if (end === undefined)
			end = "  ...";
 
		if (text.length <= length || text.length - end.length <= length) {
			return String(text).replace(/<[^>]+>/gm, '');
		} else {
			htmlToPlaintext = String(text).replace(/<[^>]+>/gm, '');
			return String(htmlToPlaintext).substring(0, length-end.length) + end;
		}
	};
})

.filter ('textarea', function () {
	return function (text, length, end) {
		return String (text).replace(/\r?\n/g, '<br />');
	}
})
