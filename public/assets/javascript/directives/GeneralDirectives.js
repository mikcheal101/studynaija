angular.module ('app.directives', [])

.directive ('email', ($q, AppService) => {
	return {
		require	: 'ngModel',
		link 	:  (s, e, a, c) => {
			c.$asyncValidators.email = (mV, vV) => {
				if (c.$isEmpty (mV)) return $q.when ();
				var defer = $q.defer ();

				var id = angular.isUndefined(a.myId) ? 0 : a.myId;
				
				if (a.myemail === mV) {
					defer.resolve (mV);
				} else {
					AppService
					.verifyEmail (mV, id)
					.then (
						notfound => {

							defer.resolve (notfound);
						}, found => {
							defer.reject (found);
						}
					);
				}
				return defer.promise;
			};
		}
	};
})

.directive ('username', ($q, AppService) => {
	return {
		require : 'ngModel',
		link 	:  (s, e, a, c) => {
			c.$asyncValidators.username = (mV, vV) => {
				if (c.$isEmpty (mV)) return $q.when ();
				var defer = $q.defer ();
				var id = angular.isUndefined(a.myId) ? 0 : a.myId;

				if (a.myusername === mV) {
					defer.resolve (mV);
				} else {
					AppService
					.verifyUsername (mV, id)
					.then (
						notfound => {
							defer.resolve (notfound);
						}, found => {
							defer.reject (found);
						}
					);
				}
				return defer.promise;
			};
		}
	};
})