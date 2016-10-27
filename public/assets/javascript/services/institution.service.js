angular.module ('institution.service', [])

.service ('InstitutionService', function ($q, $http, $rootScope, Upload) {
	var svc = this;

	svc.getSubadmin = function (param) {
		var q = q.defer ();
		$http.post ($rootScope.inst.getSubadmin , {school:param.school})
		.then (
			done => {
				q.resolve (done.data);
			}, fail => {
				q.reject (fail);
			}
		);
		return q.promise;
	};

	svc.getScholarships = function (param) {
		var q = q.defer ();
		$http.post ($rootScope.inst.getScholarships , {poster:param.poster})
		.then (
			done => {
				q.resolve (done.data);
			}, fail => {
				q.reject (fail);
			}
		);
		return q.promise;
	};

	svc.recvApplications = function (param) {
		var q = q.defer ();
		$http.post ($rootScope.inst.recvApplications , {school:param.school})
		.then (
			done => {
				q.resolve (done.data);
			}, fail => {
				q.reject (fail);
			}
		);
		return q.promise;
	};

	svc.createScholarship = function (param) {
		var q = q.defer ();
		Upload.upload ({ url:$rootScope.inst.createScholarship , data:{
			file: param.file,
			name: param.name,
			details:param.details,
			poster:param.poster
		}})
		.then (
			done => {
				q.resolve (done.data);
			}, fail => {
				q.reject (fail);
			}
		);
		return q.promise;
	};

	svc.editScholarship = function (param) {
		var q = q.defer ();
		Upload.upload ({ url: $rootScope.inst.editScholarship, data:{
				file: param.file,
				id: param.id,
				details:param.details,
				poster:param.poster,
				name: param.name
		}})
		.then (
			done => {
				q.resolve (done.data);
			}, fail => {
				q.reject (fail);
			}
		);
		return q.promise;
	};

	svc.dropScholarship = function (param) {
		var q = q.defer ();
		$http.post ($rootScope.inst.dropScholarship , {id:param.id, image:param.image, poster:param.poster})
		.then (
			done => {
				q.resolve (done.data);
			}, fail => {
				q.reject (fail);
			}
		);
		return q.promise;
	};

	svc.createApplication = function (param) {
		var q = q.defer ();
		$http.post ($rootScope.inst.createApplication , {
			institution:param.institution,
			start_date: param.start_date,
			end_date:param.end_date,
			name: param.name,
			disciplines: param.disciplines
		})
		.then (
			done => {
				q.resolve (done.data);
			}, fail => {
				q.reject (fail);
			}
		);
		return q.promise;
	};

	svc.closeApplication = function (param) {
		var q = q.defer ();
		$http.post ($rootScope.inst.closeApplication , {
			school:param.school,
			application:param.application
		})
		.then (
			done => {
				q.resolve (done.data);
			}, fail => {
				q.reject (fail);
			}
		);
		return q.promise;
	};

	svc.dropApplication = function (param) {
		var q = q.defer ();
		$http.post ($rootScope.inst.dropApplication , {
			school:param.school,
			application:param.application
		})
		.then (
			done => {
				q.resolve (done.data);
			}, fail => {
				q.reject (fail);
			}
		);
		return q.promise;
	};

	svc.editApplication = function (param) {
		var q = q.defer ();
		$http.post ($rootScope.inst.editApplication , {
			institution:param.institution,
			start_date: param.start_date,
			end_date:param.end_date,
			name: param.name,
			disciplines: param.disciplines,
			id:param.id
		})
		.then (
			done => {
				q.resolve (done.data);
			}, fail => {
				q.reject (fail);
			}
		);
		return q.promise;
	};

	/* pending */
	svc.viewApplicants = function (param) {
		var q = q.defer ();
		$http.post ($rootScope.inst.viewApplicants , {

		})
		.then (
			done => {
				q.resolve (done.data);
			}, fail => {
				q.reject (fail);
			}
		);
		return q.promise;
	};

	/* pending */
	svc.reviewApplicant = function (param) {
		var q = q.defer ();
		$http.post ($rootScope.inst.reviewApplicant , {})
		.then (
			done => {
				q.resolve (done.data);
			}, fail => {
				q.reject (fail);
			}
		);
		return q.promise;
	};

	svc.viewApplicant = function (param) {
		var q = q.defer ();
		$http.post ($rootScope.inst.viewApplicant , {
			school:param.school,
			applicant: param.applicant
		})
		.then (
			done => {
				q.resolve (done.data);
			}, fail => {
				q.reject (fail);
			}
		);
		return q.promise;
	};

	svc.listNews = function (param) {
		var q = q.defer ();
		$http.post ($rootScope.inst.listNews , {poster:param.poster})
		.then (
			done => {
				q.resolve (done.data);
			}, fail => {
				q.reject (fail);
			}
		);
		return q.promise;
	};

	svc.addNews = function (param) {
		var q = q.defer ();
		$http.post ($rootScope.inst.addNews , {
			poster: param.poster,
			files: param.files,
			subject: param.subject,
			details: param.details
		})
		.then (
			done => {
				q.resolve (done.data);
			}, fail => {
				q.reject (fail);
			}
		);
		return q.promise;
	};

	svc.dropNews = function (param) {
		var q = q.defer ();
		$http.post ($rootScope.inst.dropNews , {
			id: param.id,
			poster: param.poster,
			resources: param.resources
		})
		.then (
			done => {
				q.resolve (done.data);
			}, fail => {
				q.reject (fail);
			}
		);
		return q.promise;
	};

	svc.updateProfile = function (param) {
		var q = q.defer ();
		Upload.upload ({ url:$rootScope.inst.updateProfile , data: {
			file:param.file,
			username: param.username,
			pwd: param.pwd,
			password: param.password,
			email: param.email,
			id: param.id
		}})
		.then (
			done => {
				q.resolve (done.data);
			}, fail => {
				q.reject (fail);
			}
		);
		return q.promise;
	};

	svc.assignCourses = function (param) {
		var q = q.defer ();
		$http.post ($rootScope.inst.assignCourses , {
			school: param.school,
			courses: param.courses
		})
		.then (
			done => {
				q.resolve (done.data);
			}, fail => {
				q.reject (fail);
			}
		);
		return q.promise;
	};

	svc.ourCourses = function (param) {
		var q = q.defer ();
		$http.post ($rootScope.inst.ourCourses , {
			school: param.school
		})
		.then (
			done => {
				q.resolve (done.data);
			}, fail => {
				q.reject (fail);
			}
		);
		return q.promise;
	};

	svc.getOurCourse = function (param) {
		var q = q.defer ();
		$http.post ($rootScope.inst.getOurCourse , {
			school: param.school,
			discipline: param.discipline
		})
		.then (
			done => {
				q.resolve (done.data);
			}, fail => {
				q.reject (fail);
			}
		);
		return q.promise;
	};

	svc.updateCourse = function (param) {
		var q = q.defer ();
		$http.post ($rootScope.inst.updateCourse , {
			school: param.school,
			discipline: param.discipline,
			content: param.content,
			id: param.id,
			description: param.description,
			intl: param.intl,
			local: param.local
		})
		.then (
			done => {
				q.resolve (done.data);
			}, fail => {
				q.reject (fail);
			}
		);
		return q.promise;
	};

	svc.dropCourse = function (param) {
		var q = q.defer ();
		$http.post ($rootScope.inst.dropCourse , {
			school: param.school,
			discipline: param.discipline
		})
		.then (
			done => {
				q.resolve (done.data);
			}, fail => {
				q.reject (fail);
			}
		);
		return q.promise;
	};

	return svc;
});
