var app = angular.module('adminApp', ['angularUtils.directives.dirPagination', 'ngFileUpload', 'ngSanitize', 'ngAnimate', 'checklist-model']);

app.filter ('statusFilter', function () {
	return function (status) {
		switch (status) {
			case 1: 
			case '1':
				return "Suspended";
			case 2:
			case '2':
				return "Deactivated";
			case 3:
			case '3':
				return "Activated";
			case 4:
			case '4':
				return "Pending";
		}
	};
});

app.filter ('myDate', function () {
	return function (d) {
		return new Date (d);
	};
});

app.filter('htmlToPlaintextTruncate', function() {
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
});

app.directive ('facultyname',  function ($q, $http) {
	return {
		require : 'ngModel',
		link : function (s, e, a, c) {
			c.$asyncValidators.facultyname = function (mV, vV) {
				if (c.$isEmpty (mV)) return $q.when ();
				var defer = $q.defer ();
				
				if (s.selectedfaculty.id === 0) {
					$.post ('checkfacultyname', {name:mV, id:s.selectedfaculty.id})
					.then (
						function (s) {
							var r = $.parseJSON (s);

							if (r.result) {
								defer.reject ();
							} else {
								defer.resolve ();
							}
						},
						function (e) {console.error (e);}
					);
				} else {
					defer.resolve ();
				}
				return defer.promise;
			};
		}
	};
});

app.directive ('checkusername', function ($q, $http) {
	return {
		require : 'ngModel',
		link	: function (scope, elems, attrs, ctrl) {
			ctrl.$asyncValidators.checkusername = function (modelValue, viewValue) {
				if (ctrl.$isEmpty (modelValue)) return $q.when ();
				
				var def = $q.defer ();
				$.post ('checkUsername', {username: modelValue})
				.then (
					function (s) {
						$.parseJSON (s).return ? def.reject (): def.resolve ();
					},
					function (err) {
						console.error (err);
					}
				);
				return def.promise;
			};
		}
	};
});

app.directive ('checkemail', function ($q, $http) {
	return {
		require : 'ngModel',
		link	: function (scope, ele, attr, ctrl) {
			ctrl.$asyncValidators.checkemail = function (modelValue, viewValue) {
				if (ctrl.$isEmpty (modelValue)) return $q.when ();
				
				var def = $q.defer ();
				
				$.post ('checkEmail', {email:modelValue})
				.then (
					function (s) {
						$.parseJSON (s).return ? def.reject (): def.resolve ();
					},
					function (e) {
						console.error (e);
					}
				);
				return def.promise;
			};
		}
	};
});

app.directive ('disciplinename', function ($q, $http) {
	return {
		require : 'ngModel',
		link : function (s, e, a, c) {
			c.$asyncValidators.disciplinename = function (mV, vV) {
				
				if (c.$isEmpty (mV)) return $q.when ();
				var def = $q.defer ();
				$.getJSON ('checkDisciplineName', {name:mV, id:s.selectedDiscipline.id})
				.then (
					function (data) {
						if (data.return) {
							def.reject ();
						} else {
							def.resolve ();
						}
					},
					function (e) {
						def.reject ();
					}
				);
				return def.promise;
			};
		}
	};
});

app.directive ('checkinstname', function ($q) {
	return {
		require : 'ngModel',
		link : function (s, e, a, c) {
			c.$asyncValidators.checkinstname = function (mV, vV) {
				
				if (c.$isEmpty (mV)) return $q.when ();
				var defer = $q.defer ();
				
				$.post ('check_inst_type', {name:mV, id:s.selectedInstType.id})
				.then (function (r) {
					r = $.parseJSON (r);
					r.data ? defer.reject () : defer.resolve ();
				}, function (err) {console.error (err);});
				
				return defer.promise;
			};
		}
	};
});

app.directive ('checkinstsname', function ($q) {
	return {
		require : 'ngModel',
		link : function (s, e, a, c) {
			c.$asyncValidators.checkinstsname = function (mV, vV) {
				if (c.$isEmpty(mV)) return $q.when ();
				var def = $q.defer ();
				$.post ('checkinstname', {name:mV, id:s.selectedInstituition.id})
				.then (function (r) {
					r = $.parseJSON (r);
					r.available ? def.reject (): def.resolve ();
				}, function (err){console.error (err);});
				return def.promise;
			};
		}
	};
});

app.controller('adminCntrl', function ($scope, $http, Upload, $interval, $window) {
	
	/** Messages **/
	$scope.messages		= [];
	
	/** States **/
	$scope.states = [];
	$scope.loadStates = function () {
		$.getJSON ('loadStates', function (s) {
			$scope.states = s.states;
			$scope.$digest ();
		});
	};
	
	/** Assign Courses to Instrituitions **/
	$scope.assign 		= {};
	$scope.assign.commitChanges = function () {
		
	};
	
	/** Users **/
	$scope.users		= [];
	$scope.schoolusertypes = [
		{
			id:3, 
			name:'Institution Super Administrator'
		}, {
			id:5, 
			name:'Institution Sub Administrator'
		}
	];
	$scope.loadUsers = function () {
		$.getJSON ('ajaxUsers', function (data) {
			$scope.users = data.object;
			angular.forEach ($scope.users, function (user) {
				user.fullname = user.firstname + ' ' + (user.middlename.length > 0 ? user.middlename + ' ' : '') + user.lastname;
				user.profile_image = '../'+user.profile_image;
			});
			$scope.$digest ();
		});
	};
	
	
	/** Scholarships **/
	$scope.scholarships 		= [];
	$scope.scholarship 			= {
		id : 0,
		name : '',
		details : '',
		image : {},
		poster : {},
		ts : ''
	};
	$scope.selectedScholarship	= {
		id: 0, 
		name: '', 
		details : '', 
		ts: new Date ()
	};
	$scope.clearScholarship 	= function () {
		$scope.selectedScholarship = {
			id : 0,
			name : '',
			details : '',
			image : {},
			poster : {},
			ts : ''
		};
	};
	$scope.commitScholarship 	= function (form) {
		$scope.selectedScholarship.details = tinyMCE.activeEditor.getContent ();
		var scholarship = $scope.selectedScholarship;
		
		
		$.post ('commitScholarship', {param:scholarship})
		.then (function (r) {
			r = $.parseJSON (r);
			console.log (r);
			
		}, function (err) {console.error (err);});
	};
	$scope.dropScholarship 		= function (param) {
		$scope.scholarships.splice ($scope.scholarships.indexOf (param), 1);
		$.post ('dropScholarship', {id:param.id})
		.then (function (s) {
			console.info (s);
		}, function (err) {console.error (err);});
	};
	$scope.loadScholarships 	= function () {
		$scope.clearScholarship ();
		$.getJSON ('ajaxScholarships', function (data) {
			$scope.scholarships = data.object;
			angular.forEach ($scope.scholarships, function (x) {
				var t = x.details.substring ()
			});
			$scope.$digest ();
		});
	};
	$scope.setScholarship 		= function (param) {
		$scope.selectedScholarship = param;
		tinyMCE.activeEditor.setContent (param.details);
	};
	
	
	/** instituition Types **/
	$scope.clear_inst_type 			= function () {
		$scope.selectedInstType = {id:0, name:''};
	};
	$scope.load_inst_type 			= function () {
		$.getJSON ('load_instituition_types')
		.then (function (d) {
			$scope.InstituitionTypes = d.types;
			$scope.$digest ();
			$scope.clear_inst_type ();
		});
	};
	$scope.inst_type_makeChanges 	= function (form) {
		if (form.$valid) {
			var inst = $scope.selectedInstType;
			$scope.clear_inst_type ();
			$.post ('commit_inst_type', {param:inst})
			.then (function (r) {
				r = $.parseJSON (r);
				if (r.type === 'save') {
					inst.id = r.id;
					$scope.InstituitionTypes.unshift (inst);
					$scope.$digest ();
				}
			});
		}
	};
	$scope.set_inst_type 			= function (inst) {
		$scope.selectedInstType = inst;
	};
	$scope.delete_inst_type 		= function (param) {
		$scope.InstituitionTypes.splice ($scope.InstituitionTypes.indexOf (param), 1);
		$.post ('drop_inst_type', {id:param.id});
	};
	
	
	/** Faculties **/
	$scope.faculties			= [];
	$scope.selectedfaculty 		= {id:0, name:''};
	$scope.loadFaculties 		= function () {
		$scope.clearFaculty ();
		$.getJSON ('loadFaculties')
		.then (
			function (r) {
				$scope.faculties = r.faculties;
				$scope.$digest ();
			},
			function (e) {
				console.error (e);
			}
		);
	};
	$scope.dropFaculty 			= function (fac) {
		$scope.faculties.splice($scope.faculties.indexOf (fac), 1);
		$scope.clearFaculty ();
		$.post ('dropFaculty', {id:fac.id});
	};
	$scope.faculty_makeChanges 	= function (form) {
		if (form.$valid)
			$.post ('commitFaculty', {faculty:$scope.selectedfaculty})
			.then (
				function (r) {
					r = $.parseJSON (r);
					if (r.type === 'save') {
						$scope.selectedfaculty.id = r.id;
						$scope.faculties.push ($scope.selectedfaculty);
						$scope.$digest ();
						$scope.clearFaculty ();
					} 
				}
			);
	};
	$scope.setfaculty 			= function (fac) {
		$scope.selectedfaculty = fac;
	};
	$scope.clearFaculty 		= function () {
		$scope.selectedfaculty = {
			id : 0,
			name : ''
		};
	};
	
	
	/** News **/
	$scope.news					= []; // holding all the news items
	$scope.newsDetails 			= {
		files : [],
		details : "",
		subject	: "",
		id		: 0
	};
	$scope.newsuploadImage 		= function ($files) {
		$scope.newsDetails.files = $files;
	};	
	$scope.clearNews 			= function () {
		$scope.newsDetails 	= {
			files : [],
			details : "",
			subject	: "",
			id		: 0
		};
	};	
	$scope.loadNews 			= function () {
		$.getJSON ('loadNews')
		.then (
			function (news) {
				console.log (news);
				$scope.news = news.news;
				$scope.$digest ();
			},
			function (err) {
				console.error (err);
			}
		);
	};	
	$scope.editNews 			= function ($index) {
		$scope.newsDetails = $scope.news[$index];
	}
	$scope.commitNews 			= function (form) {
		if (form.$valid) {
			Upload.upload ({
				url: 'commitNews',
				data : {
					files 	: $scope.newsDetails.files,
					param	: $scope.newsDetails
				}
			})
			.then (
				function (news) {
					news = news.data;
					if (news.type === 'save')
						$scope.news.unshift (news.news);
					$scope.clearNews ();
				},
				function (err) {
					console.error (err);
				}
			);
		}
	};
	$scope.dropNews 			= function ($index) {
		var news = $scope.news[$index];
		$scope.news.splice($index, 1);
		
		$.post ('dropNews', {id:news.id})
		.then (
			function (n) {
				//$scope.news.splice ($scope.news.indexOf (news));
				//$scope.$digest ();
			},
			function (err) {
				console.error (err);
			}
		);
	};
	
	
	/** Web Administrators **/
	$scope.webAdmins				= [];
	$scope.selectedWebAdmin 		= {
		id		: 0,
		username: "",
		password: "",
		email	: "sample@mail.com",
		status  : 3,
		profile_image : ""
	};
	$scope.selectedWebAdmin.username_error = "";
	$scope.selectedWebAdmin.password_error = "";
	$scope.setWebAdmin 				= function (param) {
		$scope.selectedWebAdmin = param;
	};
	$scope.clearWebAdmin 			= function () {
		$scope.selectedWebAdmin = {
			id		: 0,
			username: "",
			password: "",
			email	: "sample@mail.com",
			status  : 3,
			profile_image : ""
		};
	};
	$scope.deleteWebAdmin	 		= function () {
		var tobe = $scope.webAdmins.indexOf ($scope.selectedWebAdmin);
		$.post ('deleteWebAdmin', {id:$scope.selectedWebAdmin.id}, function (res) {
			$scope.webAdmins.splice (tobe, 1);
			$scope.clearWebAdmin ();
			$scope.$digest ();
		});
	};
	$scope.commitChangesWebAdmin 	= function () {
		// send the web admin details to the server
		if ($scope.selectedWebAdmin.username.trim ().length < 6) {
			$scope.selectedWebAdmin.username_error = "username length must be greater than 10";
			return ;
		}
		if ($scope.selectedWebAdmin.password.trim ().length < 6) {
			$scope.selectedWebAdmin.password_error = "password length must be greater than 10";
			return ;
		}
		
		$.post ('commitWebAdmin', {data: $scope.selectedWebAdmin}, function (res) {
			var data = $.parseJSON (res);
			if (data.status == 200) {
				if (data.object > 0) {
					// push into array 
					$scope.selectedWebAdmin.id = data.object;
					$scope.webAdmins.unshift ($scope.selectedWebAdmin);
					$scope.clearWebAdmin ();
					$scope.$digest ();
				}
			}
		});
	};
	$scope.loadWebAdmins 			= function () {
		$.getJSON ('ajaxWebAdmins', function (data) {
			$scope.webAdmins = data.object;
			angular.forEach ($scope.webAdmins, function (user) {
				user.profile_image = '../'+user.profile_image;
			});
			$scope.$digest ();
		});
	};
	
	
	/** School Administrators **/
	$scope.schAdmins	= [];
	$scope.selectedSchAdmin 	= {
			id : 0,
			username : '',
			password : '',
			email : '',
			profile_image : '',
			usertype : {
				id : 0, 
				name: ''
			},
			status : 1,
			school : {
				id : 0,
				name : '',
				year_of_est : new Date (),
				url : '',
				logo : '',
				state : 0,
				email : '',
				address : '',
				cover_photo : '',
				history : '',
				type : ''
			}
		};
	$scope.clearSchoolAdmins 	= function () {};
	$scope.setSchAdmin	 		= function (param) {
		$scope.selectedSchAdmin = param;
	};
	$scope.clearSchAdmin 		= function () {
		$scope.selectedSchAdmin = {
			id : 0,
			username : '',
			password : '',
			email : '',
			profile_image : '',
			usertype : {
				id : 0, 
				name: ''
			},
			status : 1,
			school : {
				id : 0,
				name : '',
				year_of_est : new Date (),
				url : '',
				logo : '',
				state : 0,
				email : '',
				address : '',
				cover_photo : '',
				history : '',
				type : ''
			}
		};
	};
	$scope.loadSchAdmins 		= function () {
		$.getJSON ('ajaxSchAdmins')
		.then(function (data) {
			$scope.schAdmins = data.object;
			console.info ($scope.schAdmins);
			angular.forEach ($scope.schAdmins, function (user) {
				user.profile_image = '../'+user.profile_image;
			});
			$scope.$digest ();
		}, function (err) {console.error (err);});
	};
	
	
	/** Instituitions **/
	$scope.instituitions			= [];
	$scope.selectedInstType 		= {id:0, name:''};
	$scope.selectedInstituition 	= {
		id:0,
		name : '',
		year_of_est : new Date (),
		url: '',
		logo : '',
		state : {
			id : 0,
			name : '',
			slogan : '',
			emblem : '',
			description :'',
		},
		email : '',
		address : '',
		cover_photo : '',
		history : '',
		type : {
			id : 0,
			name : ''
		},
		user : {
			id : 0,
			username : '',
			password : '',
			email : ''
		},
		logo_file : ''
	};
	$scope.resetInstituition 		= function () {
		$scope.selectedInstituition = {
			id:0,
			name : '',
			year_of_est : new Date (),
			url: '',
			logo : '',
			state : {
				id : 0,
				name : '',
				slogan : '',
				emblem : '',
				description :'',
			},
			email : '',
			address : '',
			cover_photo : '',
			history : '',
			type : {
				id : 0,
				name : ''
			},
			user : {
				id : 0,
				username : '',
				password : '',
				email : ''
			},
			logo_file : ''
		};
		tinyMCE.activeEditor.setContent("")
	};
	$scope.instituitionMakeChanges 	= function (form) {
		if (form.$valid) {
			$scope.selectedInstituition.address = tinyMCE.activeEditor.getContent();
			var inst = $scope.selectedInstituition;
			$scope.resetInstituition ();
			
			if (inst.logo_file) {
				Upload.upload({
					url: 'ajaxSaveInstituition',
					data: inst
				}).then(
					function (response) {
						if (response.data.type === 'save') {
							inst.id = response.data.id;
							$scope.instituitions.push (inst);
						}
					}, 
					function (error) {
						//console.error (error);
					}, function (evt) {            
						$scope.progress = 
							Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
					}
				);
			} else $.post ('ajaxSaveInstituition', {data: inst}, function (res) { console.log (res); });
		}
	};
	$scope.deleteInstituition 		= function ($index) {
		var inst = $scope.instituitions.slice ($index, 1);
		$scope.instituitions.splice ($index, 1); 
		$.post ('ajaxDeleteInstituition', {data:inst}, function (res) { console.log (res); });
	};
	$scope.init 					= function () {
		$scope.loadDisciplines ();
		$scope.loadInstituitions ();
	};
	$scope.loadInstituitions 		= function () {
		
		$.getJSON ('ajaxLoadInstituitions', function (res) {
			$scope.instituitions = res.instituitions;
			
			angular.forEach ($scope.instituitions, function (d) {
				d.type 	= d.type === null ? {id:0, name:''} : d.type;
				d.state = d.state === null ? {id : 0,
					name : '',
					slogan : '',
					emblem : '',
					description :'',
				} : d.state;
				d.user 	= d.user === null ? {
					id : 0, 
					username : '', 
					password : '', 
					email : d.email ? '':d.email
				} : d.user;
				d.logo_file = '';
			});
			$scope.resetInstituition ();
			
			$scope.$digest ();
			$scope.load_inst_type ();
		});
	};
	$scope.setInstitution 			= function (param) {
		$scope.selectedInstituition = param;
		$scope.selectedInstituition.year_of_est = new Date ($scope.selectedInstituition.year_of_est);
		tinyMCE.activeEditor.setContent(param.address);
	};
	$scope.getInstituitionLogo 		= function(param) {
		//$scope.selectedInstituition.logo = '';
	};
	
	$scope.institutionUpload 	= {};
	$scope.institutionUpload.error = "";
	$scope.institutionUpload.success = "";
	$scope.institutionUpload.status = 0;
	$scope.institutionUpload.file = {name:''};
	$scope.institutionUpload.file_size = 0;
	$scope.institutionUpload.upload = function ($file) {
		if ($file) {
			$scope.institutionUpload.file = $file;
			$scope.institutionUpload.file_size = Math.round ($scope.institutionUpload.file.size / 1000);
			Upload.upload ({
				url : "uploadExcelInstituitions",
				data : {
					files: $file
				}
			})
			.then (
				function (result) {
					var data = result.data;
					$scope.institutionUpload.status = 100;
					if (data.status === 400) $scope.institutionUpload.error = data.message;
					else $scope.institutionUpload.success = data.message;
				}, 
				function (error) {
					$scope.institutionUpload.status = 100;
					$scope.institutionUpload.error 	=  'Compilation Error, Please conact Administrator!';
					console.error (error);
				}, 
				function (progress) {
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
	
	/** disciplines **/
	$scope.disciplines 				= [];
	$scope.disciplineTypes 			= [];
	$scope.selectedDisciplineType 	= {};
	$scope.disciplineUpload 		= {};
	$scope.disciplineUpload.error 	= "";
	$scope.disciplineUpload.success = "";
	$scope.disciplineUpload.status 	= 0;
	$scope.disciplineUpload.file 	= {name:''};
	$scope.disciplineUpload.file_size = 0;
	$scope.selectedDiscipline 		= {
		id : 0,
		name : "",
		type: {},
		type_brand : {
			id : 0,
			name : ""
		}, 
		faculty : {
			id : 0,
			name : '',
			imageUrl : ''
		}
	};
	$scope.selectDisciplineType 	= function ($index) {
		$scope.selectedDisciplineType = $scope.disciplineTypes.slice ($index);
	};
	$scope.loadDisciplineTypes 		= function () {
		$.getJSON ('disciplineTypes')
		.then (
			function (d) {
				$scope.disciplineTypes = d.types;
				$scope.selectedDisciplineType = $scope.disciplineTypes[0];
				$scope.$digest ();
			},
			function (err) {
				console.error (err);
			}
		);
	};
	$scope.loadDisciplines 			= function () {
		$.getJSON ('ajaxgetDisciplines', function (data) {
			$scope.disciplines = data.object;
			angular.forEach ($scope.disciplines, function (x) {
				x.faculty = x.faculty === null ? {id : 0, name : '', imageUrl : ''} : x.faculty;
			});
			$scope.$digest ();
			$scope.loadDisciplineTypes ();
			$scope.loadFaculties ();
		});
	};
	$scope.setDiscipline 			= function (param) {
		$scope.selectedDiscipline = param;
	};
	$scope.deleteDiscipline 		= function ($index, param) {
		// remove the item from the list
		$scope.disciplines.splice ($index, 1);
		$.post ('removeDiscipline', {data: param.id}, function () {});
	};
	$scope.clear_discipline 		= function () {
		$scope.selectedDiscipline = {
			id : 0,
			name : "",
			type: {},
			type_brand : {
				id : 0,
				name : ""
			}, 
			faculty : {
				id : 0,
				name : '',
				imageUrl : ''
			}
		};
	};
	$scope.discipline_makeChanges 	= function (form) {
		
		if (form.$valid) {
			$.post ('ajaxUpdateDiscipline', {param: $scope.selectedDiscipline})
			.then (
				function (r) {
					var value = $.parseJSON (r);
					if (value.type === 'save') {
						$scope.selectedDiscipline.id = value.id;
						$scope.disciplines.unshift ($scope.selectedDiscipline);
					}
					$scope.clear_discipline ();
					$scope.$digest ();
				}
			);
		}
	};
	$scope.disciplineUpload.upload  = function ($file) {
		if ($file) {
			$scope.disciplineUpload.file = $file;
			$scope.disciplineUpload.file_size = Math.round ($scope.disciplineUpload.file.size / 1000);
			Upload.upload ({
				url : 'uploadExcelDisciplines',
				data : {
					files: $file
				}
			})
			.then (
				function (succ) {
					var data = succ.data;
					$scope.disciplineUpload.status = 100;
					if (data.status === 400) $scope.disciplineUpload.error = data.message;
					else {
						$scope.disciplineUpload.success = data.message;
					}
				},
				function (err) {
					$scope.disciplineUpload.status = 100;
					$scope.disciplineUpload.error = 'Compilation Error, Please conact Administrator!';
					console.error (err);
				},
				function (prog) {
					$scope.disciplineUpload.status = Math.round ((prog.loaded / prog.total) * 100) - 10;
				}
			);
		}
	};
	$scope.disciplineUpload.clear 	= function () {
		$scope.disciplineUpload.status 	= 0;
		$scope.disciplineUpload.error 	= "";
		$scope.disciplineUpload.success = "";
		$scope.disciplineUpload.file 	= {};
	};
	
	
	/** Profile **/
	$scope.profile 				= {};
	$scope.upload 				= {};
	$scope.upload.getImage 		= function (img) {
		$scope.profile.profile_image = img;
	};
	$scope.upload.makeChanges 	= function (form) {
		console.log (form.$error, form.$valid, form);
		
		if (form.$valid) {
			// send fom to db
			console.log ($scope.profile.profile_image);
			Upload.upload ({
				url 		: 'updateProfile',
				data		: {
					files 		: $scope.profile.profile_image,
					username 	: $scope.profile.username,
					pwd			: $scope.profile.newpassword,
					email		: $scope.profile.email
				}
			})
			.then (
				function (suc) {
					$window.location.reload ();
				},
				function (err) {
					console.log (err);
				}
			);
		}
		
	};
	$scope.getProfileDetails 	= function () {
		$http.get ('getProfile')
		.then (function (res) {
			res.data.user.profile_image = '../'+res.data.user.profile_image;
			$scope.profile = res.data.user;
		});
	};
});
