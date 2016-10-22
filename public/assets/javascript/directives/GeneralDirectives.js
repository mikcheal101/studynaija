angular.module ('app.directives', [])

.directive ('email', ($q, AppService) => {
	return {
		require	: 'ngModel',
		link 	:  (s, e, a, c) => {
			c.$asyncValidators.email = (mV, vV) => {
				if (c.$isEmpty (mV)) return $q.when ();
				var defer = $q.defer ();

				if (a.myemail === mV) {
					defer.resolve (mV);
				} else {
					AppService
					.verifyEmail (mV)
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

				if (a.myusername === mV) {
					defer.resolve (mV);
				} else {
					AppService
					.verifyUsername (mV)
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