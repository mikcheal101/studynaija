angular.module ('applicant.service', [])

.service ('ApplicantService', function ($q, $http, $rootScope, Upload) {
	var svc = this;

	// load profile details
	svc.profile = function (id) {
		var defer = $q.defer ();
		$http.post ($rootScope.user.profile, {id:id})
		.then (
			applicant => {
				defer.resolve (applicant.data.applicant[0]);
			}, err => {
				defer.reject (err);
			}
		);
		return defer.promise;
	};

	svc.updateProfile = (applicant, documents) => {
		var defer = $q.defer ();
		Upload
		.upload ({
			url : $rootScope.user.updateProfile,
			data : {
				file : documents.profile_image,
				applicant : applicant
			}
		})
		.then (
			updated => {
				defer.resolve (updated);
			}, err => {
				defer.reject (err);
			}
		);
		return defer.promise;
	};

	return svc;
});