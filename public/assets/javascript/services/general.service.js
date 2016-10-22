angular.module ('app.service', [])

.service ('AppService', function ($q, $http, $rootScope) {
	var svc = this;

	svc.loadCountries = function () {
		var defer = $q.defer ();
		$http.get ($rootScope.api.countries)
		.then (
			data => {
				defer.resolve (data.data.countries);
			}, err => {
				defer.reject (err);
			}
		)
		return defer.promise;
	};

	// load institutions
	svc.loadInstitutions = function () {
		var defer = $q.defer ();

		$http.get ($rootScope.api.institutions)
		.then (
			function (data) {
				defer.resolve (data.data.schools);
			}, function (err) {
				defer.reject (err);
			}
		);
		return defer.promise;
	};

	//load states
	svc.loadStates = function () {
		var defer = $q.defer ();

		$http.get ($rootScope.api.states)
		.then (
			function (data) {
				defer.resolve (data.data.states);
			}, function (err) {
				defer.reject (err);
			}
		);
		return defer.promise;
	};

	//get state
	svc.getState = function (id) {
		var defer = $q.defer ();

		$http.post ($rootScope.api.states, {id:id})
		.then (
			function (data) {
				defer.resolve (data.data.state[0]);
			}, function (err) {
				defer.reject (err);
			}
		);
		return defer.promise;
	};

	//load news
	svc.loadNews = function () {
		var defer = $q.defer ();

		$http.get ($rootScope.api.news)
		.then (
			function (data) {
				defer.resolve (data.data.news);
			}, function (err) {
				defer.reject (err);
			}
		);
		return defer.promise;
	};

	// get single news by id
	svc.getNews = function (id) {
		console.log (id);

		var defer = $q.defer ();
		$http.post ($rootScope.api.getNews, {id:id})
		.then (
			data => {
				defer.resolve (data.data.news[0]);
			}, err => {
				defer.reject (err);
			}
		);
		return defer.promise;
	};

	//load disciplines
	svc.loadDisciplines = function () {
		var defer = $q.defer ();

		$http.get ($rootScope.api.disciplines)
		.then (
			function (data) {
				defer.resolve (data.data.disciplines);
			}, function (err) {
				defer.reject (err);
			}
		);
		return defer.promise;
	};

	//load highest_qualifications
	svc.loadHighestQualifications = function () {
		var defer = $q.defer ();

		$http.get ($rootScope.api.highest_qualifications)
		.then (
			function (data) {
				defer.resolve (data.data.highest_qualification);
			}, function (err) {
				defer.reject (err);
			}
		);
		return defer.promise;
	};

	//load scholarships 
	svc.loadScholarships = function () {
		var defer = $q.defer ();

		$http.get ($rootScope.api.scholarships)
		.then (
			function (data) {
				defer.resolve (data.data.scholarships);
			}, function (err) {
				defer.reject (err);
			}
		);
		return defer.promise;
	};

	//get single scholarship
	svc.getScholarship = function (id) {
		var defer = $q.defer ();

		$http.post ($rootScope.api.scholarships, {id:id})
		.then (
			function (data) {
				defer.resolve (data.data.scholarship[0]);
			}, function (err) {
				defer.reject (err);
			}
		);
		return defer.promise;
	};

	//load faculties 
	svc.loadFaculties = function () {
		var defer = $q.defer ();

		$http.get ($rootScope.api.faculties)
		.then (
			function (data) {
				defer.resolve (data.data.faculties);
			}, function (err) {
				defer.reject (err);
			}
		);
		return defer.promise;
	};

	//load faculties 
	svc.loadEducationalVariants = function () {
		var defer = $q.defer ();

		$http.get ($rootScope.api.educational_variants)
		.then (
			function (data) {
				defer.resolve (data.data.variants);
			}, function (err) {
				defer.reject (err);
			}
		);
		return defer.promise;
	};

	// sign user in
	svc.authenticate = function (user) {
		user = user.user || {username:'', password:''};
		var defer = $q.defer ();
		$http
		.post ($rootScope.api.authenticate, {user:user})
		.then (
			function (data) {
				defer.resolve (data.data);
			}, function (err) {
				defer.reject (err);
			}
		);
		return defer.promise;
	};

	// sign out
	svc.logout = function () {
		var defer = $q.defer ();
		$http.get ($rootScope.api.signout)
		.then (done => {
			defer.resolve (done.data);
		});		
		return defer.promise;
	};

	// check session details
	svc.session = function () {
		var defer = $q.defer ();
		$http.get ($rootScope.api.sessions)
		.then (
			data => {
				defer.resolve (data.data.session);
			}, err => {
				defer.reject (err);
			}
		);
		return defer.promise;
	};

	// register user
	svc.register = function (user) {
		var defer = $q.defer ();
		$http
		.post ($rootScope.api.register, {user:user})
		.then (
			saved => {
				defer.resolve (saved);
			}, err => {
				defer.reject (err);
			}
		);
		return defer.promise;
	};


	// load english levels
	svc.loadEnglishLevels = function () {
		var defer = $q.defer ();
		$http.get ($rootScope.api.english)
		.then (english => { 
			defer.resolve (english.data.english);
		}, err => {
			defer.reject (err);
		});
		return defer.promise;
	};

	// load payment options 
	svc.loadPaymentOptions = function () {
		var defer = $q.defer ();
		$http.get ($rootScope.api.funding)
		.then (payment => { 
			defer.resolve (payment.data.funding);
		}, err => {
			defer.reject (err);
		});
		return defer.promise;
	};

	// load semesters
	svc.loadSemesters = function () {
		var defer = $q.defer ();
		$http.get ($rootScope.api.semesters)
		.then (semesters => { 
			defer.resolve (semesters.data.semesters);
		}, err => {
			defer.reject (err);
		});
		return defer.promise;
	};

	// verify email address
	svc.verifyEmail = function (email) {
		var defer = $q.defer ();
		$http
		.post ($rootScope.api.verifyEmail, {email:email})
		.then (
			gotten => {
				if (gotten.data.valid)
					defer.reject (gotten.data.valid);
				else 
					defer.resolve (gotten.data.valid);
			}, err => {
				defer.reject (err);
			}
		);
		return defer.promise;
	};

	//verify username
	svc.verifyUsername = function (username) {
		var defer = $q.defer ();
		$http.post ($rootScope.api.verifyUsername, {username:username})
		.then (
			gotten => {
				if (gotten.data.valid)
					defer.reject (gotten.data.valid);
				else 
					defer.resolve (gotten.data.valid);
			}, err => {
				defer.reject (err);
			}
		);
		return defer.promise;
	};

	return svc;
});
