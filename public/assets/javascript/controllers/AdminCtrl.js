angular.module ('admin.controller', [])

.controller ('AdminController', function ($scope, $rootScope, $location, $filter, $route, AdminService) {
	$scope.sessions 	= $rootScope.sessions;
	$scope.templates 	= $rootScope.templates;
	$scope.app 			= $rootScope.app;
	$scope.admin 		= {};

	$scope.app.applicants 		= [];
	$scope.app.webadmins 		= [];
	$scope.app.schAdmins		= [];
	
	$scope.app.news 			= [];
	
	$scope.app.inst_types		= [];
	//$scope.app.institutions 	= [];

	$scope.applicant 			= {id:0};
	$scope.webadmin 			= {};
	$scope.schAdmin				= {};
	$scope.scholarship 			= {};
	$scope.news					= {};
	$scope.faculty 				= {};
	$scope.inst_type			= {};
	$scope.institution 			= {};

	$scope.selectApplicant 		= function (applicant) {
		$scope.applicant 		= applicant;
	};
	$scope.selectWebAdmin		= function (param) {
		$scope.webadmin 		= param;
	};
	$scope.selectSchAdmin 		= function (param) {
		$scope.schAdmin 		= param;
	};
	$scope.selectScholarship 	= function (param) {
		$scope.scholarship 		= param;
	};
	$scope.selectNews 			= function (param) {
		$scope.news 			= param;
	};
	$scope.selectFaculty 		= function (param) {
		$scope.faculty 			= param;
	};
	$scope.selectInstitutionType= function (param) {
		$scope.inst_type 		= param;
	};
	$scope.selectInstitution 	= function (param) {
		$scope.institution 		= param;
	};
	$scope.selectSchAdminImage 	= function (param) {} 

	// save scholarship
	$scope.commitScholarship = function (form) {
		if (form.$valid) {
			//var details = $scope.scholarship.details.replace(/\r?\n/g, '\\r');	
			details = $scope.scholarship.details;
			if ($scope.scholarship.id) {
				AdminService.editScholarship ({
					file:null,
					name:$scope.scholarship.name,
					details: details,
					poster: $scope.sessions.user.id,
					id: $scope.scholarship.id
				})
				.then (
					done => {
						var set = $scope.app.scholarships [$scope.app.scholarships.indexOf ($scope.scholarship)];
						set.image = done.image;
						$scope.scholarship = {};
						form.$setPristine();
      					form.$setUntouched();
					}
				);
			} else {
				AdminService.createScholarship ({
					file: null,
					name: $scope.scholarship.name,
					details: details,
					poster: $scope.sessions.user.id
				}).then (
					done => {
						if (done.done) {
							$scope.scholarship.poster 	= $scope.sessions.user.id;
							$scope.scholarship.image 	= done.data.image;
							$scope.scholarship.id 		= done.data.id;
							$scope.app.scholarships.unshift ($scope.scholarship);
							$scope.scholarship = {};
							form.$setPristine();
      						form.$setUntouched();
						}
					}
				);	
			}
		} 
	};
	$scope.clearScholarship  = function () {
		$scope.scholarship = {};
	};
	$scope.deleteScholarship = function (param) {
		AdminService.dropScholarship (param)
		.then (
			done => {
				console.log (done);
				$scope.app.scholarships.splice ($scope.app.scholarships.indexOf (param), 1);
			}
		);
	};


	// news section
	$scope.clearNews = function () {
		$scope.news = {};
	}
	$scope.selectNews = function (param) {
		$scope.news = param;
	};
	$scope.dropNews = function (param) {
		AdminService.dropNews (param)
		.then (done => {
			$scope.app.news.splice ($scope.app.news.indexOf (param), 1);
		});
	};
	$scope.uploadNewsResources = function (param) {
		$scope.news.files = param;
	};
	$scope.commitNews = function (form) {
		if (form.$valid) {
			var param = $scope.news;
			if (!$scope.news.id) {
				//save
				AdminService.createNews ({
					files: param.files,
					subject: param.subject,
					details: param.details,
					poster: $scope.sessions.user.id
				})
				.then (done => {
					if (done.done) {
						$scope.news.id = done.news.id;
						if (done.news.resources) $scope.news.resources = [];
						angular.forEach(done.news.resources, function(v, k){
							$scope.news.resources.push (v[0]);
						});
						$scope.app.news.unshift ($scope.news);
					}
					$scope.news = {};
					form.$setPristine();
					form.$setUntouched();
				});
			} else {
				// update
				AdminService.editNews ({
					id: param.id,
					files: param.files,
					subject: param.subject,
					details: param.details,
					poster: $scope.sessions.user.id
				})
				.then (done => {
					console.log (done);
				});
			}
		}
	};


	// faculties section 
	$scope.clearFaculty = function () {
		$scope.faculty = {};
	};
	$scope.dropFaculty = function (param) {
		AdminService.dropFaculty (param)
		.then (done => {
			$scope.app.faculties.splice ($scope.app.faculties.indexOf (param), 1);
		});
	};
	$scope.commitFaculty = function (form) {
		if (form.$valid) {
			if ($scope.faculty.id) {
				// update
				AdminService.editFaculty ($scope.faculty)
				.then (done => {
					$scope.faculty = {};
				});
			} else {
				//save
				AdminService.createFaculty ($scope.faculty) 
				.then (d => {
					$scope.faculty.id = d.id;
					$scope.app.faculties.unshift ($scope.faculty);
					$scope.faculty = {};
				});	
			}
			form.$setPristine();
			form.$setUntouched();	
		}
	};

	// institution types
	$scope.clearInstype = function () {
		$scope.inst_type = {};
	};
	$scope.dropInstype = function (param) {
		AdminService.dropInstType (param)
		.then (done => {
			$scope.app.inst_types.splice ($scope.app.inst_types.indexOf (param), 1);
		});
	};
	$scope.commitInstype = function (form) {
		if (form.$valid) {
			if ($scope.inst_type.id) {
				// update
				AdminService.editInstType ($scope.inst_type)
				.then (done => {
					$scope.inst_type = {};
				});
			} else {
				//save
				AdminService.createInstType ($scope.inst_type) 
				.then (d => {
					$scope.inst_type.id = d.id;
					$scope.app.inst_types.unshift ($scope.inst_type);
					$scope.inst_type = {};
				});	
			}
			form.$setPristine();
			form.$setUntouched();	
		}
	};

	// institution part
	$scope.clearInst = function () {
		$scope.institution = {};
	};
	$scope.dropInst = function (param) {
		AdminService.dropInst ({
			id: param.id,
			logo: param.logo || '',
			cover_photo: param.cover_photo || ''
		}).then (done => {
			$scope.app.institutions.splice ($scope.app.institutions.indexOf (param), 1);
		});
	};
	$scope.commitInst = function (form) {
		if (form.$valid) {
			if ($scope.institution.id) {
				//edit
				AdminService.editInst ({
					id 				: $scope.institution.id,
					files 			: {
						_logo 			: $scope.institution._logo || '',
						_cover_photo 	: $scope.institution._cover_photo || ''
					},
					_logo 			:$scope.institution._logo || '',
					_cover_photo 	:$scope.institution._cover_photo || '',
					logo 			:$scope.institution.logo || '',
					cover_photo 	:$scope.institution.cover_photo || '',
					name 			:$scope.institution.name,
					year_of_est 	:$scope.institution.year_of_est || null,
					url 			:$scope.institution.url || '',
					state 			:$scope.institution.state,
					email 			:$scope.institution.email || '',
					address 		:$scope.institution.address || '',
					history	 		:$scope.institution.history || '',
					type 			:$scope.institution.type,
					tel 			:$scope.institution.tel || 0,
					mail 			:$scope.institution.mail || ''
				}).then (done => {
					console.log (done);
				});
			} else {
				//save
				AdminService.createInst ({
					files 			: {
						_logo 			: $scope.institution._logo || '',
						_cover_photo 	: $scope.institution._cover_photo || ''
					},
					_logo 			:$scope.institution._logo || '',
					_cover_photo 	:$scope.institution._cover_photo || '',
					logo 			:$scope.institution.logo || '',
					cover_photo 	:$scope.institution.cover_photo || '',
					name 			:$scope.institution.name,
					year_of_est 	:$scope.institution.year_of_est || null,
					url 			:$scope.institution.url || '',
					state 			:$scope.institution.state,
					email 			:$scope.institution.email || '',
					address 		:$scope.institution.address || '',
					history	 		:$scope.institution.history || '',
					type 			:$scope.institution.type,
					tel 			:$scope.institution.tel || 0,
					mail 			:$scope.institution.mail || ''
				}).then (done => {
					
					if (done.done) {
						$scope.institution.id = done.id;	
						$scope.institution.logo = done.logo;
						$scope.app.institutions.unshift ($scope.institution);
						$scope.clearInst ();
					}
				});
			}
		} else {
			console.log ('form aint valid');
		}
	};
	$scope.getInstituitionLogo = function (param) {
		$scope.institution._logo = param;
	};

	// school admin
	$scope.clearSchAdmin = function () {
		$scope.schAdmin = {id:0};
	};
	$scope.commitSchAdmin = function (form) {
		if (form.$valid) {

			if ($scope.schAdmin.__id) {
				AdminService.editSchAdmin ({
					username		: $scope.schAdmin.username,
					pwd 			: $scope.schAdmin.pwd || '',
					password 		: $scope.schAdmin.password,
					file 			: $scope.schAdmin.image || null,
					email 			: $scope.schAdmin.email,
					school 			: $scope.schAdmin.school,
					usertype		: $scope.schAdmin.usertype,
					status 			: $scope.schAdmin.status,
					id 				: $scope.schAdmin.__id,
					profile_image	: $scope.schAdmin.profile_image
				})
				.then (done=> {
					console.log ('done:', done);
					var y = $scope.app.schAdmins [$scope.app.schAdmins.indexOf ($scope.schAdmin)];
					y.profile_image = done.image + '?decache=' + Math.random();

					$scope.clearSchAdmin ();
					form.$setPristine();
					form.$setUntouched();	
				});
			} else {

				AdminService.createSchAdmin ({
					username		: $scope.schAdmin.username,
					password 		: $scope.schAdmin.pwd,
					profile_image	: $scope.schAdmin.image,
					email 			: $scope.schAdmin.email,
					school 			: $scope.schAdmin.school,
					usertype		: $scope.schAdmin.usertype
				})
				.then (done => {
					$scope.app.schAdmins.push ($scope.schAdmin);

					$scope.schAdmin.id = done.id;
					$scope.schAdmin.profile_image = done.image;
					$scope.clearSchAdmin ();
					form.$setPristine();
					form.$setUntouched();	
				});
			}
		}
	};
	$scope.dropSchAdmin = function () {
		//dropSchAdmin
	};
	$scope.setSchAdmin = function (param) {
		$scope.schAdmin = param;
	};


	// save webadmin
	$scope.commitChangesWebAdmin = function () {
		// check to see if the web admin has an id
		if ($scope.webadmin.id) {
			// update
			var x = {
				file: $scope.webadmin.image || null,
				profile_image: $scope.webadmin.profile_image,
				username:$scope.webadmin.username,
				password:$scope.webadmin.password,
				pwd:$scope.webadmin.pwd,
				id:$scope.webadmin.id,
				email:$scope.webadmin.email,
				status:$scope.webadmin.status,
				usertype:2
			};
			
			AdminService.editWebAdmin (x)
			.then (
				done => {
					console.log ('updated: ', done);
					if (done.done) {
						var y = $scope.app.webadmins [$scope.app.webadmins.indexOf ($scope.webadmin)];
						y.password = done.password;
						y.profile_image = done.profile_image;
						$scope.webadmin = {id:0};				
					}
				}
			);

		} else {
			// save
			var x = {
				profile_image:$scope.webadmin.image,
				username: $scope.webadmin.username,
				password: $scope.webadmin.pwd,
				email: $scope.webadmin.email
			};
			AdminService.createWebAdmin (x).then (
				// push this admin into the array of admins
				admin => {
					x.id = admin.id;
					x.profile_image = admin.image;

					$scope.webadmin = {id:0};
					$scope.app.webadmins.push (x);
				}
			);
		}
	};
	$scope.deleteWebAdmin = function () {
		AdminService
		.dropWebAdmin ({id:$scope.webadmin.id, profile_image:$scope.webadmin.profile_image})
		.then (
			done => {
				// remove the webadmin from the array of admins
				if (done) {
					$scope.app.webadmins.splice ($scope.app.webadmins.indexOf ($scope.webadmin), 1);
					$scope.webadmin = {id:0};
				}
			}
		);
	};
	$scope.getImage = function (img, var_) {
		var_ = img;
	};

	$scope.userstatus = [
		{id: 1, name: 'Suspended'},
		{id: 2, name: 'Deactivated'},
		{id: 3, name: 'Activated'},
		{id: 4, name: 'Pending'},
	];

	$scope.schoolusertypes = [
		{id: 3, name: 'Main School Admin'},
		{id: 5, name: 'Sub School Admin'}
	];

	$scope.app.loadApplicants 	= function () {
		AdminService
		.loadApplicants ()
		.then (
			applicants => {
				angular.copy (applicants.applicants, $scope.app.applicants);
			}, err => {
				console.warn ('applicants: ', err);
			}
		);
	};
	$scope.app.loadWebAdmins 	= function () {
		AdminService
		.loadWebAdmins ()
		.then (
			a => {
				$scope.app.webadmins = a.data;
			}
		);
	};
	$scope.app.loadSchAdmins 	= function () {
		AdminService.loadSchAdmins ()
		.then (a => { $scope.app.schAdmins = a.admins; });
	};
	

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
		$scope.app.loadApplicants ();
		$scope.app.loadScholarships ();
		$scope.app.loadNews ();
		$scope.app.loadWebAdmins ();
		$scope.app.loadSchAdmins ();
		$scope.app.loadInstitutionTypes ();

		// admin reserved calls

		if ($scope.sessions.authenticated === false) {
			$location.path ('/login');
		} else {
			// get the Admin's details

			$scope.admin 		= $scope.sessions.user;
			$scope.admin.oldpwd = $scope.sessions.user.password;
		}
	}();

	$scope.wh_2 = {
		width	: '25px',
		height	: '25px'
	}

	$scope.updateProfile = function (form) {
		if (form.$valid) {
			
			AdminService
			.updateProfile ($scope.admin)
			.then (
				suc => {
				}, err => {
					console.log ('err: ', err);
				}
			);
		}
	};

	$scope.getProfileImage = function (files) {
		$scope.admin.profile_image = files;
	};

	$scope.institutionUpload 			= {};
	$scope.institutionUpload.error 		= "";
	$scope.institutionUpload.success 	= "";
	$scope.institutionUpload.status 	= 0;
	$scope.institutionUpload.file 		= {name:''};
	$scope.institutionUpload.file_size 	= 0;
	$scope.institutionUpload.upload 	= function ($file) {
		if ($file) {
			$scope.institutionUpload.file 		= $file;
			$scope.institutionUpload.file_size 	= Math.round ($scope.institutionUpload.file.size / 1000);
			
			AdminService.excel_to_json ({file:$file, type:1})
			.then (
				result => {
					var data = result.data;
					$scope.institutionUpload.status = 100;

					if (data) 
						$scope.institutionUpload.success = 'upload complete';
					else 
						$scope.institutionUpload.error = 'Error uploading files, Contact system admin';
				}, 
				error => {
					$scope.institutionUpload.status = 100;
					$scope.institutionUpload.error 	=  'Compilation Error, Please conact Administrator!';
				}, 
				progress => {
					$scope.institutionUpload.status = Math.round ((progress.loaded / progress.total) * 100) - 10;
				}
			);		
		}
	};
	$scope.institutionUpload.clear = function () {
		$scope.institutionUpload.error 		= "";
		$scope.institutionUpload.success 	= "";
		$scope.institutionUpload.status 	= 0;
		$scope.institutionUpload.file 		= {name:''};
	};

	$scope.uploadDisciplines = function () {};


});