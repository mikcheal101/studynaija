var service = angular.module ('user.services', [])

.service ('Scholarship', function ($q, $http, Upload, $rootScope) {
	var svc = this;

	svc.fetchAll = function () {
		var defer = $q.defer ();
		console.log ('fetchAll called!');
		$http
			.get ($rootScope.server.scholarships)
			.then (
				function (succ) {
					defer.resolve (succ.data.scholarships);
				}, function (err) {
					console.warn ('error: ', err);
					defer.reject (err);
				}
			)
		return defer.promise;
	}

	
	return svc;
})

.service('News', [function ($q, $http, $rootScope) {
	var svc = this;

	svc.fetchAll = function () {
		var defer = $q.defer ();
		$http.get ($rootScope.server.news)
		.then (function (n) {
			defer.resolve(n.data.news);
		}, function (e) {defer.reject (e);});
		return defer.promise;
	}


	return svc;
}])