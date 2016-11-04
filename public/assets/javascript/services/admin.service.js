angular.module ('admin.service', [])

.service ('AdminService', function ($q, $http, $rootScope, Upload) {
	var svc = this;

	svc.updateProfile = function (admin) {
		var q = $q.defer ();
		Upload.upload ({
			url 	: $rootScope.admin.updateProfile,
			data 	: {
				file 	: (admin.image) ? Upload.rename (admin.image, (('uploads/admin/').concat (admin.username.replace (/ /g, '_')))) : null,
				username:admin.username,
				password:admin.password,
				email	:admin.email,
				pwd 	:admin.pwd
			}
		})
		.then (
			done => {
				if (done.data.done)
					q.resolve (true);
				else 
					q.reject (false);
			}, err => {
				q.reject (err);
			}
		);

		return q.promise;
	};

	svc.loadApplicants = function () {
		var defer = $q.defer ();
		$http.get ($rootScope.admin.loadApplicants)
		.then (
			data => {
				defer.resolve (data.data);
			}, err => {
				defer.reject (err);
			}
		);
		return defer.promise;
	};

	svc.updateDocType = function (param) {
		var q = $q.defer ();
		$http.post ($rootScope.admin.updateDocType, {
			name: param.name,
			id: param.id
		})
		.then (
			y => {
				if (y.data.done) q.resolve (true);
				else q.reject (false);
			}, n => {
				q.reject (false);
			}
		);
		return q.promise;
	};

	svc.loadWebAdmins = function () {
		var q = $q.defer ();
		$http.get ($rootScope.admin.loadWebAdmins)
		.then (
			y => {
				q.resolve (y.data);
			}, n => {
				q.reject (n);
			}
		);
		return q.promise;
	};

	svc.loadSchAdmins = function () {
		var q = $q.defer ();
		$http.get ($rootScope.admin.loadSchAdmins)
		.then (
			y => {
				q.resolve (y.data);
			}, n => {
				q.reject (n);
			}
		);
		return q.promise;
	};

	svc.loadDocTypes = function () {
		var q = $q.defer ();
		$http.get ($rootScope.admin.loadDocTypes)
		.then (
			y => {
				q.resolve (y.data.data);
			}, n => {
				q.reject (n);
			}
		);
		return q.promise;
	};

	svc.dropDocType = function (param) {
		var q = $q.defer ();
		$http.post ($rootScope.admin.dropDocType, {
			id : param.id
		})
		.then (
			y => {
				q.resolve (true);
			}, n => {
				q.reject (n);
			}
		);
		return q.promise;
	};

	svc.dropWebAdmin = function (param) {
		var q = $q.defer ();
		console.log ('dropping: ', param);
		$http.post ($rootScope.admin.dropWebAdmin, {
			id: param.id,
			profile_image: param.profile_image
		})
		.then (
			y => {
				console.log (y.data);
				q.resolve (true);
			}, n => {
				console.warn (n);
				q.reject (n);
			}
		);
		return q.promise;
	};

	svc.dropSchAdmin = function (param) {
		var q = $q.defer ();
		$http.post ($rootScope.admin.dropSchAdmin, {
			id: param.id,
			profile_image : param.profile_image
		})
		.then (
			y => {
				q.resolve (true);
			}, n => {
				q.reject (n);
			}
		);
		return q.promise;
	};

	svc.dropScholarship = function (param) {
		var q = $q.defer ();
		console.log ('querying ', $rootScope.admin.dropScholarship);
		$http.post ($rootScope.admin.dropScholarship, {id:param.id, image:param.image})
		.then (
			y => {
				if (y.data.done)
					q.resolve (true);
				else q.reject (false);
			}, n => {
				q.reject (n);
			}
		);
		return q.promise;
	};

	svc.dropNews = function (param) {
		var q = $q.defer ();
		$http.post ($rootScope.admin.dropNews, {
			id:param.id,
			resources: param.resources
		})
		.then (
			y => {
				q.resolve (true);
			}, n => {
				q.reject (n);
			}
		);
		return q.promise;
	};

	svc.dropFaculty = function (param) {
		var q = $q.defer ();
		$http.post ($rootScope.admin.dropFaculty, {id:param.id})
		.then (
			y => {
				q.resolve (true);
			}, n => {
				q.reject (n);
			}
		);
		return q.promise;
	};

	svc.dropInstType = function (param) {
		var q = $q.defer ();
		$http.post ($rootScope.admin.dropInstType, {id:param.id})
		.then (
			y => {
				q.resolve (true);
			}, n => {
				q.reject (n);
			}
		);
		return q.promise;
	};

	svc.dropInst = function (param) {
		var q = $q.defer ();
		$http.post ($rootScope.admin.dropInst, {
			id:param.id,
			logo:param.logo,
			cover_photo:param.cover_photo
		})
		.then (
			y => {
				q.resolve (true);
			}, n => {
				q.reject (n);
			}
		);
		return q.promise;
	};

	svc.createDocType = function (param) {
		var q = $q.defer ();
		$http.post ($rootScope.admin.createDocType, {
			name : param.name
		})
		.then (
			y => {
				if (y.data.done)
					q.resolve (y.data.id);
				else q.reject (0);
			}, n => {
				q.reject (n);
			}
		);
		return q.promise;
	};

	svc.createWebAdmin = function (param) {
		var q = $q.defer ();
		console.log ('param: ', param);
		Upload
		.upload ({
			url : $rootScope.admin.createWebAdmin,
			data: {
				file: param.profile_image ? Upload.rename (param.profile_image, param.username.replace (/ /g, '_')) : null,
				username: param.username,
				password: param.password,
				status: 3,
				usertype: 2,
				email: param.email
			}
		})
		.then (
			y => {
				if (y.data.done)
					q.resolve (y.data);
				else q.reject (false);
			}, n => {
				console.error (n);
				q.reject (false);
			}
		);
		return q.promise;
	};

	svc.createSchAdmin = function (param) {
		var q = $q.defer ();
		console.log (param);

		Upload.upload ({
			url:$rootScope.admin.createSchAdmin, 
			data: {
				username	: param.username,
				password	: param.password,
				status		: 3,
				file 		: Upload.rename (param.profile_image, param.username.replace (/ /g, '_')),
				usertype 	: param.usertype,
				email 		: param.email,
				school 		: param.school
			}
		})
		.then (
			y => {
				q.resolve (y.data);
			}, n => {
				q.reject (false);
			}
		);
		return q.promise;
	};

	svc.createNews = function (param) {
		var q = $q.defer ();
		Upload.upload ({
			url :$rootScope.admin.createNews, 
			arrayKey: '',
			data: {
				files: param.files ? Upload.rename (param.files, param.subject.replace (/ /g, '_').concat (Date.now ())) : null,
				subject: param.subject,
				details: param.details,
				poster: param.poster
			}
		})
		.then (
			y => {
				q.resolve (y.data);
			}, n => {
				q.reject (false);
			}
		);
		return q.promise;
	};

	svc.createFaculty = function (param) {
		var q = $q.defer ();
		$http.post ($rootScope.admin.createFaculty, {name:param.name})
		.then (
			y => {
				q.resolve (y.data);
			}, n => {
				q.reject (false);
			}
		);
		return q.promise;
	};

	svc.createInstType = function (param) {
		var q = $q.defer ();
		console.log ('param: ', param);
		$http.post ($rootScope.admin.createInstType, {name:param.name})
		.then (
			y => {
				console.log (y);
				q.resolve (y.data);
			}, n => {
				q.reject (false);
			}
		);
		return q.promise;
	};

	svc.createInst = function (param) {
		var q = $q.defer ();
		Upload.upload ({
			url :$rootScope.admin.createInst, 
			data: {
				_logo 			: param._logo ? Upload.rename (param._logo, param.name.replace (/ /g, '_').concat ('_logo_')) : null,
				_cover_photo 	: param._cover_photo ? Upload.rename (param._cover_photo, param.name.replace (/ /g, '_').concat ('_cover_photo')) : null,
				logo 			: param.logo || '',
				cover_photo 	: param.cover_photo || '',
				name 			: param.name,
				year_of_est 	: param.year_of_est,
				url 			: param.url,
				state 			: param.state,
				email 			: param.email,
				address 		: param.address,
				history 		: param.history,
				type 			: param.type,
				tel 			: param.tel,
				mail 			:param.mail
			}
		})
		.then (
			y => {
				q.resolve (y.data);
			}, n => {
				q.reject (false);
			}
		);
		return q.promise;
	};

	svc.createScholarship = function (param) {
		var q = $q.defer ();
		console.log (param);

		Upload.upload ({
			url :$rootScope.admin.createScholarship, 
			data: {
				file: param.file,
				name: param.name,
				details: param.details,
				poster: param.poster
			}
		})
		.then (
			y => {
				q.resolve (y.data);
			}, n => {
				q.reject (false);
			}
		);
		return q.promise;
	};

	svc.asignSchDesci = function (param) {
		var q = $q.defer ();
		$http.post ($rootScope.admin.asignSchDesci, {
			discipline: param.discipline,
			school: param.school,
			description: param.description,
			intl: param.intl,
			local: param.local,
			content: param.content
		})
		.then (
			y => {
				q.resolve (y.data);
			}, n => {
				q.reject (false);
			}
		);
		return q.promise;
	};

	svc.editWebAdmin = function (param) {
		var q = $q.defer ();
		Upload.upload ({ 
			url: $rootScope.admin.editWebAdmin, 
			data: {
				file: param.file ? Upload.rename (param.file, param.username.replace (/ /g, '_')) : null,
				profile_image:param.profile_image,
				pwd: param.pwd,
				password:param.password,
				username: param.username,
				email:param.email,
				status: param.status,
				usertype: param.usertype,
				email: param.email,
				id: param.id
			}
		})
		.then (
			y => {
				q.resolve (y.data);
			}, n => {
				q.reject (false);
			}
		);
		return q.promise;
	};

	svc.editSchAdmin = function (param) {
		var q = $q.defer ();

		Upload.upload ({ url: $rootScope.admin.editSchAdmin, data: {
			file 		: param.file ? Upload.rename (param.file, param.username.replace (/ /g, '_')) : null,
			pwd 		: param.pwd,
			password 	: param.password,
			username 	: param.username,
			email 		: param.email,
			status 		: param.status,
			usertype 	: param.usertype,
			email 		: param.email,
			id 			: param.id,
			school 		: param.school,
			profile_image:param.profile_image
		}})
		.then (
			y => {
				q.resolve (y.data);
			}, n => {
				q.reject (false);
			}
		);
		return q.promise;
	};

	svc.editScholarship = function (param) {
		var q = $q.defer ();
		Upload.upload ({url :$rootScope.admin.editScholarship, data: {
			file: param.file,
			name:param.name,
			details: param.details,
			id:param.id,
			poster:param.poster	
		}})
		.then (
			y => {
				q.resolve (y.data);
			}, n => {
				q.reject (false);
			}
		);
		return q.promise;
	};

	svc.editFaculty = function (param) {
		var q = $q.defer ();
		$http.post ($rootScope.admin.editFaculty, {name:param.name, id:param.id})
		.then (
			y => {
				q.resolve (y.data);
			}, n => {
				q.reject (false);
			}
		);
		return q.promise;
	};

	svc.editInstType = function (param) {
		var q = $q.defer ();
		$http.post ($rootScope.admin.editInstType, {name:param.name, id:param.id})
		.then (
			y => {
				q.resolve (y.data);
			}, n => {
				q.reject (false);
			}
		);
		return q.promise;
	};

	svc.editInst = function (param) {
		var q = $q.defer ();
		Upload.upload ({url:$rootScope.admin.editInst, data:{
			_logo: param._logo ? Upload.rename (param._logo, param.name.replace (/ /g, '_').concat ('_logo_')) : null,
			_cover_photo : param._cover_photo ? Upload.rename (param._cover_photo, param.name.replace (/ /g, '_').concat ('_cover_photo')) : null,
			logo: param.logo || '',
			cover_photo: param.cover_photo || '',
			id:param.id,
			name: param.name,
			year_of_est: param.year_of_est,
			url: param.url,
			state: param.state,
			email:param.email,
			address: param.address,
			history: param.history,
			type: param.type,
			tel: param.tel,
			mail:param.mail
		}})
		.then (
			y => {
				q.resolve (y.data);
			}, n => {
				q.reject (false);
			}
		);
		return q.promise;
	};

	svc.verifyInstName = function (param) {
		var q = $q.defer ();
		$http.post ($rootScope.admin.verifyInstName, {name:param.name})
		.then (
			y => {
				if (y.data.done)
					q.resolve (y.data.done);
				else q.reject (false);
			}, n => {
				q.reject (false);
			}
		);
		return q.promise;
	};

	svc.verifyFacName = function (param) {
		var q = $q.defer ();
		$http.post ($rootScope.admin.verifyFacName, {name:param.name})
		.then (
			y => {
				if (y.data.done)
					q.resolve (y.data.done);
				else q.reject (false);
			}, n => {
				q.reject (false);
			}
		);
		return q.promise;
	};

	svc.excel_to_json = function (param) {
		var q = $q.defer ();
		
		//$http.post ($rootScope.api.excel_to_json, {type:param.type})
		Upload.upload({url 	: $rootScope.api.excel_to_json,
			method	: 'POST',
			data 	: {
				type 	: param.type,
				file 	: param.file
			}
		})
		.then (
			yes => {
				q.resolve (yes.data);
			}, no => {
				q.reject (no);
			}, progress => {
				q.notify (progress);
			}
		);
		return q.promise;
	};

	
	return svc;
});