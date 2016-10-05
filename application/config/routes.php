<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

#	user routes

$route['test']	= 'usersController/test';
$route['admin/getProfile'] 			= 'usersController/getProfile';
$route['admin/checkUsername'] 		= 'usersController/checkUsername';
$route['admin/checkEmail'] 			= 'usersController/checkEmail';
$route['school/getProfile'] 		= 'usersController/getProfile';
$route['users/getProfile'] 			= 'usersController/getProfile';
$route['users/loadNews']			= 'usersController/loadNews'; 

$route['payment/confirmation']		= 'usersController/verifyPaystackPayment'; 
$route['users'] 					= 'usersController/index';
$route['users/myApplications'] 		= 'usersController/my_application';
$route['users/loginFacebook'] 		= 'usersController/loginFacebook';
$route['users/addCartCallback'] 	= 'usersController/addCartCallback';

$route['users/changeToCaller'] 		= 'usersController/changeToCaller';
$route['users/authorizeFacebook'] 	= 'usersController/authorizeFacebook';
$route['users/deAuthorizeFacebook'] = 'usersController/deAuthorizeFacebook';


$route['users/checkout'] 			= 'usersController/checkout';
$route['users/addToCart'] 			= 'usersController/add_to_cart';
$route['users/myDashboard'] 		= 'usersController/my_dashboard';
$route['users/applicantpassport'] 	= 'usersController/applicantpassport';
$route['users/changePassword'] 		= 'usersController/change_password';
$route['users/forgotPassword'] 		= 'usersController/forgot_password';
$route['users/signUp'] 				= 'usersController/sign_up';
$route['users/signIn'] 				= 'usersController/sign_in';
$route['users/signOut'] 			= 'usersController/sign_out';
$route['users/schools'] 			= 'usersController/schools';
$route['users/schools/(:any)'] 		= 'usersController/schools/$1';
$route['users/disciplines'] 		= 'usersController/disciplines';
$route['users/disciplines/(:any)']	= 'usersController/disciplines/$1';
$route['users/discipline/(:num)'] 	= 'usersController/discipline/$1';
$route['users/courses'] 			= 'usersController/courses';
$route['users/states'] 				= 'usersController/states';
$route['users/states/(:any)'] 		= 'usersController/states/$1';
$route['users/scholarships'] 		= 'usersController/scholarships';
$route['users/scholarship/(:num)'] 	= 'usersController/scholarship/$1';
$route['users/deleteDocument/(:num)'] 		= 'usersController/deleteDocument/$1';


#	schools routes
$route['school'] 					= 'schoolsController/index';
$route['school/applications'] 		= 'schoolsController/applications';
$route['school/news'] 				= 'schoolsController/news';
$route['school/disciplines'] 		= 'schoolsController/disciplines';
$route['school/compose'] 			= 'schoolsController/compose';
$route['school/profile'] 			= 'schoolsController/my_profile';
$route['school/discipline/(:num)'] 	= 'schoolsController/discipline/$1';
$route['school/scholarships'] 		= 'schoolsController/scholarships';
$route['school/applicant/(:num)']	= 'schoolsController/applicant/$1';
$route['school/getCourses']			= 'schoolsController/getCourses';
$route['school/disciplineSchool']	= 'schoolsController/assignDisciplineSchool';
$route['school/disciplineSchoolUpdate']	= 'schoolsController/assignDisciplineSchoolUpdate';

$route['school/loadNews']			= 'schoolsController/getNews'; 
$route['school/commitNews']			= 'schoolsController/commitNews'; 
$route['school/dropNews']			= 'schoolsController/dropNews';

$route['school/loadScholarships']	= 'schoolsController/getScholarships'; 
$route['school/commitScholarship']	= 'schoolsController/commitScholarship'; 
$route['school/dropScholarship']	= 'schoolsController/dropScholarship'; 



$route['school/inbox'] 				= 'schoolsController/inbox';
$route['school/outbox'] 			= 'schoolsController/outbox';
$route['school/trash'] 				= 'schoolsController/trash';
$route['school/compose'] 			= 'schoolsController/compose';
$route['school/saved'] 				= 'schoolsController/saved';

#	admin routes
$route['admin'] 					= 'adminController/index';
$route['admin/updateProfile'] 		= 'adminController/updateProfile';
$route['admin/removeDiscipline'] 	= 'adminController/removeDiscipline';
$route['admin/instituitions'] 		= 'adminController/instituitions';
$route['admin/uploadPix'] 			= 'adminController/uploadPix';
$route['admin/assign'] 				= 'adminController/assign';
$route['admin/checkDisciplineName'] = 'adminController/checkDisciplineName';

$route['admin/loadNews']			= 'adminController/loadNews';
$route['admin/news'] 				= 'adminController/news';
$route['admin/commitNews'] 			= 'adminController/commitNews';
$route['admin/dropNews'] 			= 'adminController/dropNews';
$route['admin/faculties'] 			= 'adminController/faculties';
$route['admin/commitFaculty'] 		= 'adminController/commitFaculty';
$route['admin/dropFaculty'] 		= 'adminController/dropFaculty';
$route['admin/loadFaculties'] 		= 'adminController/loadFaculties';
$route['admin/checkfacultyname'] 	= 'adminController/checkfacultyname';
$route['admin/instituition_types'] 	= 'adminController/instituition_types';
$route['admin/load_instituition_types'] 	= 'adminController/load_instituition_types';
$route['admin/check_inst_type'] 	= 'adminController/check_inst_type';
$route['admin/commit_inst_type'] 	= 'adminController/commit_inst_type';
$route['admin/drop_inst_type'] 		= 'adminController/drop_inst_type';
$route['admin/checkinstname'] 		= 'adminController/checkinstname';

$route['admin/uploadExcelInstituitions'] 	= 'adminController/uploadExcelInstituitions';
$route['admin/uploadExcelDisciplines'] 		= 'adminController/uploadExcelDisciplines';

$route['admin/ajaxgetDisciplines'] 	= 'adminController/ajaxgetDisciplines';
$route['admin/ajaxSaveDiscipline'] 	= 'adminController/ajaxSaveDiscipline';
$route['admin/ajaxUpdateDiscipline']= 'adminController/ajaxUpdateDiscipline';
$route['admin/ajaxSaveInstituition']= 'adminController/ajaxSaveInstituition';
$route['admin/loadStates']			= 'adminController/loadStates';
$route['admin/ajaxLoadInstituitions']= 'adminController/ajaxLoadInstituitions';
$route['admin/ajaxDeleteInstituition']= 'adminController/ajaxDeleteInstituition';

$route['admin/disciplineTypes'] 	= 'adminController/disciplineTypes';
$route['admin/ajaxUsers'] 			= 'adminController/ajaxUsers';
$route['admin/ajaxWebAdmins'] 		= 'adminController/ajaxWebAdmins';
$route['admin/ajaxSchAdmins'] 		= 'adminController/ajaxSchAdmins';
$route['admin/ajaxScholarships'] 	= 'adminController/ajaxScholarships';

$route['admin/commitWebAdmin'] 		= 'adminController/commitWebAdmin';
$route['admin/deleteWebAdmin'] 		= 'adminController/deleteWebAdmin';

$route['admin/commitScholarship']	= 'adminController/commitScholarship'; 
$route['admin/dropScholarship']		= 'adminController/dropScholarship'; 

$route['admin/applications'] 		= 'adminController/applications';
$route['admin/disciplines'] 		= 'adminController/disciplines';
$route['admin/profile'] 			= 'adminController/my_profile';
$route['admin/users'] 				= 'adminController/users';
$route['admin/webAdmins'] 			= 'adminController/webadmins';
$route['admin/schAdmins'] 			= 'adminController/schAdmins';
$route['admin/scholarships'] 		= 'adminController/scholarships';

/*
$route['admin/applicant/(:num)'] 	= 'adminController/applicant/$1';
$route['admin/updateApplicant'] 	= 'adminController/updateApplicant';
*/


# messages part
$route['messages/inbox'] 			= 'messagesController/my_messages';
$route['messages/sent'] 			= 'messagesController/out_messages';
$route['messages/trash'] 			= 'messagesController/deleted_messages';
$route['messages/compose'] 			= 'messagesController/compose';
$route['messages/saved'] 			= 'messagesController/drafts';

$route['messages/getInbox'] 		= 'messagesController/getInbox';
$route['messages/getSent'] 			= 'messagesController/getSent';
$route['messages/getTrash'] 		= 'messagesController/getTrash';
$route['messages/getSaved'] 		= 'messagesController/getSaved';
$route['messages/my_recipients'] 	= 'messagesController/my_recipients';
$route['messages/postMessage'] 		= 'messagesController/postMessage';
$route['messages/saveMessage'] 		= 'messagesController/saveMessage';
$route['messages/trashMessage'] 	= 'messagesController/trashMessage';
$route['messages/restoreMessage'] 	= 'messagesController/restoreMessage';
$route['messages/replyMessage'] 	= 'messagesController/replyMessage';
$route['messages/junkMessage'] 		= 'messagesController/junkMessage';





# search results part
$route['users/searchResults'] 		= 'usersController/search_results';
$route['users/searchResults/(:any)']		= 'usersController/search_results/$1';
$route['users/searchResults/(:any)/(:any)']		= 'usersController/search_results/$1/$2';
$route['users/searchResults/(:any)/(:any)/(:any)']= 'usersController/search_results/$1/$2/$3';
$route['users/searchResults/(:any)/(:any)/(:any)/(:any)']= 'usersController/search_results/$1/$2/$3/$4';
$route['users/searchResults/(:any)/(:any)/(:any)/(:any)/(:any)']= 'usersController/search_results/$1/$2/$3/$4/$5';
$route['users/searchResults/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)']= 'usersController/search_results/$1/$2/$3/$4/$5/$6';
$route['users/searchResults/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)']= 'usersController/search_results/$1/$2/$3/$4/$5/$6/$7';
$route['users/searchResults/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)']= 'usersController/search_results/$/$2/$3/$4/$5/$6/$7/$81';
$route['users/searchResults/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)']= 'usersController/search_results/$1/$2/$3/$4/$5/$6/$7/$8/$9';



$route['admin/inbox'] 				= 'adminController/inbox';
$route['admin/outbox'] 				= 'adminController/outbox';
$route['admin/trash'] 				= 'adminController/trash';
$route['admin/compose'] 			= 'adminController/compose';
$route['admin/saved'] 				= 'adminController/saved';

$route['home2']		= 'usersController/home2';
$route['home3']		= 'usersController/home3';
$route['home4']		= 'usersController/home4';

$route['default_controller'] 		= 'usersController/index';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
