var app = angular.module('applicantApp', ['ngAnimate', 'ngSanitize', 'checklist-model', 'angularUtils.directives.dirPagination']);


app.filter('mySearchFilter', function () {
	return (function(x, y) {
		var result = [];
		
		angular.forEach(x, function (val) {
			var bool = false;
				
			//search by state
			if (y.states.select.length > 0) {
				bool = ($.inArray(val.school_state, y.states.select) !== -1);
			} else bool = true;
			
			// search by degree award
			var awards = $.parseJSON(val.certificate).certifications;
			if (y.selected_opts.degree_award.length > 0) {
				angular.forEach(y.selected_opts.degree_award, function (award) {
					bool |= ($.inArray(award, awards) !== -1 || awards === null);
				});	
			} else {
				bool &=true;
			}
			
			
			// search by discipline
			if (y.selected_opts.faculties.length > 0) {
				bool &= ($.inArray(val.faculty, y.selected_opts.faculties) !== -1);
			} else bool &= true; 
			
			
			if (y.pricing.applies.value === 1) {
				// international students
				bool &=  (val.intl >= y.pricing.minimum.value && val.intl <= y.pricing.maximum.value);
			} else {
				// local students
				bool &= (val.local >= y.pricing.minimum.value && val.local <= y.pricing.maximum.value);
			}
			
			// study type part
			if (val.variant_name !== "---"  && val.variant_name.length >= 1) {
				var variant = val.variant_name.variants;
				angular.forEach(variant, function (v) {
					bool |= ($.inArray(v, y.selected_opts.variants));
				});
			}
			if(bool) result.push(val);
		});
		y.count = result.length;
		return result;
	});
});

app.controller('applicantCntrl', function ($scope, $http, $filter, $window) {
	
	$scope.baseMsgControllerUrl 	= 'http://localhost/ngschools/index.php?/messagesController/';
	$scope.baseControllerUrl 		= 'http://localhost/ngschools/index.php?/usersController/';
	$scope.facebookId				= "605081073007423";
	$scope.addCartCallback			= "http://localhost/ngschools/users/addCartCallback";
	$scope.facebookLoggedIn 		= false; 
	$scope.facebookDetails 			= {}; 
	
	$scope.init = (function () {
		// document ready
		$.ajaxSetup({ cache: true });
  		$.getScript('//connect.facebook.net/en_US/sdk.js', function(){
    		FB.init({
      			appId: '605081073007423',
  				version: 'v2.7' // or v2.1, v2.2, v2.3, ...
    		});     
    		FB.getLoginStatus($scope.facebookGetStatus);
  		});
	});
	
	
	$scope.facebookGetStatus = function (resp) {
		if (resp.status === "connected") {
			$scope.facebookLoggedIn = true;
			FB.api('/me?fields=email,name,birthday,picture.type(large),timezone,updated_time,friendlists,first_name, middle_name, last_name,gender', function (response) {
				// send user data to db
				$scope.facebookDetails = response;
				$.post($scope.baseControllerUrl + "/addApplicant", {user:response}, function (res) {});
			});
		}
	};
	
	
	$scope.facebookLogin = function () {
		FB.getLoginStatus(function (response) {
			if (response.status !== "connected") {
				FB.login($scope.facebookGetStatus);
			}
		});
	};
	
	$scope.today = new Date();
	$scope.schools = {};
	$scope.schools.schools = [];
		
	$scope.schools.sortSchools = function (items) {
		var insts 		= [];
		var item_inst 	= [];
		var x = 1;
		
		angular.forEach(items, function (item) {
			if (x === items.length) {
				item_inst.push(item);
				insts.push(item_inst);
				
			} else if (x % 4 === 0) {
				item_inst.push(item);
				insts.push(item_inst);
				item_inst = [];
				
			} else {
				item_inst.push(item);	
			}
			x++;
		});
		return insts;
	};
		
	$scope.schools.loadSchools = function () {
		$.post($scope.baseControllerUrl + 'fetchSchools', function (response) {
			$scope.schools.schools = $scope.schools.sortSchools($.parseJSON(response).schools);
			console.log($scope.schools.schools);
			$scope.$digest();		
		});
	};

	$scope.search = {};
	$scope.search.searchBar;
	$scope.search.degree_awards = [];
	$scope.search.courses = [];
	$scope.search.variants = [];
	$scope.search.reverse = false;
	$scope.search.states = {};
	$scope.search.count = 0;
	$scope.search.states.select = [];
	$scope.search.selected_opts = {
		faculties	: [],
		duration	: [],
		variants	: [],
		degree_award: [],
	};
	
	$scope.search.pricing = {
		minimum	: { value: 0},
		maximum	: { value: 1000000},
		per		: { value: 1 },
		applies	: { value: 1 },
	};
	$scope.search.faculties = [];
	
	$scope.search.studyTypes = [];
	$scope.search.duration = [
		{id: 1, name: '< 1 Year', checked: false},
		{id: 2, name: '1 - 2 Years', checked: false},
		{id: 3, name: '2 - 3 Years', checked: false},
		{id: 4, name: '3 - 4 Years', checked: false},
		{id: 5, name: '> 4 Years', checked: false},
	];
	
	$scope.search.loadFaculties = function () {
		$.post($scope.baseControllerUrl + 'getFaculties', function (response) {
			$scope.search.faculties = $.parseJSON(response).faculties;
			angular.forEach($scope.search.faculties, function (value) {
				value.selected = false;
			});
		});
	}();
	
	$scope.search.search_order = {
		selected : {value: true, name: 'Order Ascending'},
		options  : [
			{value: true, name: 'Order Ascending'},
			{value: false, name: 'Order Decending'},
		]
	};
	
	$scope.search.setUrlSearch = function () {
		var url = $.parseParams( window.location.href.split('?')[1] || '' );
		$scope.search.states.select = [];
		if (url.hasOwnProperty('state_selected')) {
			$scope.search.states.select.push(url.state_selected);
		} else if (url.hasOwnProperty('searchbar')) {
			$scope.search.searchBar = url.searchbar;
		}
	}();
	
	$scope.search.loadStudyTypes = function () {
		$.post($scope.baseControllerUrl + 'fetchVariants', function (response) {
			var r = $.parseJSON(response);
			$scope.search.variants = r.variants;
			angular.forEach($scope.search.variants, function (value) {
				value.checked = false;
			});
			$scope.$digest();
		});
	}();
	
	$scope.search.loadAwards = function () {
		$.post($scope.baseControllerUrl + 'fetchAwards', function (response) {
			$scope.search.degree_awards = $.parseJSON(response).awards;
			angular.forEach($scope.search.degree_awards, function (val) {val.selected = false;});
		});
	}();
	
	$scope.search.loadCourses = function () {
		$.post($scope.baseControllerUrl + 'getSchoolCourses', function (response) {
			var r = $.parseJSON(response);
			$scope.search.courses = r.search_data;
			angular.forEach($scope.search.courses, function (val) {
				if (val.variant_name !== "---")
					val.variant_name = $.parseJSON(val.variant_name).variants; // this gives u an array of variants
			});
			$scope.$digest();
		});
	}();
	
	$scope.search.reset = function () {
		$scope.search.states.select = [];
		$scope.search.selected_opts.degree_award = [];
		$scope.search.selected_opts.faculties = [];
	};
	
	
	
	
	/* ******* /
	 * 
	 */
	$scope.application = {};
	
	$scope.application.course = {};
	$scope.application.inCart	= false;
	$scope.application.paidApp	= false;
	$scope.application.procesing = false;
	$scope.application.verificationText = [];
	$scope.application.verificationText[0] = "<h4 class='m-b-00 font-14 bold' style='border-bottom: 1px solid #f3f3f3!important;'>Processing Payment</h4>";
	
	$scope.application.payment = {
		email	: '',
		name	: '',
		address	: '',
		tel		: '',
		amount	: 0,
	};
	
	$scope.application.errorText = {
		email	: '',
		name	: '',
		address	: '',
		tel		: '',
	};
	$scope.application.errors = {
		name: false,
		email: false,
		tel: false,
		address: false,
	};
	
	$scope.application.validatePayment = function () {

		$scope.application.errors.name 		= $scope.myForm.name.$valid;
		$scope.application.errorText.name 	= (!$scope.application.errors.name)? "Confirm Entered Name":"";
		
		$scope.application.errors.email 	= $scope.myForm.email.$valid;
		$scope.application.errorText.email 	= (!$scope.application.errors.email)? "Confirm entered email address":"";
		

		$scope.application.errors.address 	= $scope.myForm.address.$valid;
		$scope.application.errorText.address= (!$scope.application.errors.address)? "Confirm entered address":"";
		
		console.log($scope.application.errors.name, 
			$scope.application.errors.email, 
			$scope.application.errors.address);
		
		if ($scope.application.errors.name && $scope.application.errors.email && $scope.application.errors.address) {
			// form is valid
			// open display 
			$scope.application.startProcessing();
			console.log('payment started!');
			//start the procedure
			$scope.application.sendPaymentOne();
		}
	};
	
	$scope.application.sendPaymentOne = function () {
		var _data = {
			email	: $scope.application.payment.email,
			amount	: $scope.application.cartCount * 10000,
			cart	: $scope.application.cartItems,
		};
		
		$.post($scope.baseControllerUrl + "initializePaystackPayment", _data, function (res) {
			res = $.parseJSON(res);
			if (res.status === true) {
				window.location.href = res.data.authorization_url;
			}
		});
	};
	
	$scope.application.verifiyPayment = function () {
		var url = $.parseParams( window.location.href.split('?')[1] || '' );
		var _data = {reference:""};
		if (url.hasOwnProperty('trxref')) _data.reference =  url.trxref;

		$.post($scope.baseControllerUrl + "ajaxVerifyPayStackPayment", _data, function (res) {
			res = $.parseJSON(res);
			if (res.status === true) {
				$scope.application.verificationText.push("<p class='text-green font-14'>Thank you, your payment has been verified!</p>");
				$scope.application.confirmPayment(res.data);
			} else {
				$scope.application.verificationText.push("<p class='text-danger font-14'>Sorry, Your Payment Was declined!</p>");
			}
			$scope.$digest();
		});
	};
	
	$scope.application.confirmPayment = function (auth) {
		_data = {
			reference			: auth.reference,
			authorization_code	: auth.authorization.authorization_code,
			amount				: auth.amount,
			email				: auth.customer.email,
		};
		
		$scope.application.verificationText.push("<h4 class='m-b-00 font-14 bold' style='border-bottom: 1px solid #f3f3f3!important;'>Confirming Payment...</h4>");
		
		$.post($scope.baseControllerUrl + "ajaxConfirmPayment", _data, function (res) {
			res = $.parseJSON(res);
			var str = "";
			if (res.status) {
				// inform system of payment
				$.post($scope.baseControllerUrl + "paymentMade", {ref:auth.reference}, function (_res) { console.log(_res);});
				
				str+="<h5 class='text-green font-13 m-t-00 m-b-30'>Payment Confirmed</h5>";
				str+= "<table class='table table-responsive table-condensed m-b-00 text-green font-12'>";
					str+= "<tr>";
						str+= "<td>Reference Code</td>";
						str+= "<td><code>"+ auth.reference +"</code></td>";
					str+= "</tr>";
					str+= "<tr>";
						str+= "<td>Card Type</td>";
						str+= "<td><code>"+ res.data.authorization.card_type +"</code></td>";
					str+= "</tr>";
					str+= "<tr>";
						str+= "<td>With last 4 digits</td>";
						str+= "<td><code>**** **** **** "+ res.data.authorization.last4 +"</code></td>";
					str+= "</tr>";
				str+= "</table>";
			} else {
				str+="<h5 class='text-red bold font-14 m-t-00 m-b-30'>Payment Confirmed</h5>";
				str+= "<table class='table table-responsive table-condensed m-b-00 text-red font-12'>";
					str+= "<tr>";
						str+= "<td>Reference Code</td>";
						str+= "<td><code>"+ auth.reference +"</code></td>";
					str+= "</tr>";
				str+= "</table>";
			}
			$scope.application.verificationText.push(str);
			$scope.$digest();
		});
	};
	
	$scope.application.saveApplication = function () {
		$.post($scope.baseControllerUrl + "saveApplication", function (res) {
			
		});
	};
	
	$scope.application.startProcessing = function () {
		$scope.application.procesing = true;
		$('.father').css({'visibility':'visible'});
	};
	
	$scope.application.addToCart = function (param) {
		
		// firstly verify facebook status
		FB.getLoginStatus(function (response) {
			if (response.status !== "connected") {
				FB.login(function (resp) {
					if (resp.status === "connected") {
						$scope.facebookLoggedIn = true;
						$scope.facebookDetails = resp;
						$scope.application.postApplication(param);
					}
				});
			} else if (response.status === "connected") {
				//console.log("logged in but not in app"); 
				$scope.application.postApplication(param);
			}
		});
		
	};
	
	$scope.application.postApplication = function (param) {
		$.post($scope.baseControllerUrl + "/add_to_cart", {item: param, facebook: $scope.facebookDetails}, function (res) {
			$scope.application.inCart = true;
			window.location.reload();
			
		});
	};
	
	$scope.application.cartItems = [];
	$scope.application.cartCount = 0;
	
	$scope.application.getCartItems = function () {
		$.post($scope.baseControllerUrl + "/getCartItems", function (res) {
			$scope.application.cartItems = $.parseJSON(res).cartItems;
			$scope.application.cartCount = ($scope.application.cartItems != null)?Object.keys($scope.application.cartItems).length:0;
			$scope.$digest();
		});
	};
	
	$scope.application.getCourse = function (param) {
		$.post($scope.baseControllerUrl +"/getCourse", {discipline:param}, function (response) {
			$scope.application.course = $.parseJSON(response).course;
			$scope.application.inCart = ($scope.application.course.cart_available > 0);
			$scope.application.course.sa_deadline 	= new Date($scope.application.course.sa_deadline);
			$scope.application.course.sa_resumption	= new Date($scope.application.course.sa_resumption);
			$scope.application.course.applyable		= ($scope.today <= $scope.application.course.sa_deadline);
			$scope.$digest();
		});
	};
	
	$scope.application.myApplications = [];
	$scope.application.getMyApplications = function () {
		$.getJSON($scope.baseControllerUrl +"/fetchMyApplications", function (res) {
			$scope.application.myApplications = res.applications;
			$scope.$digest();
		});
	};
	
	
	
	$scope.application.getStatus = function (status) {
		switch (status) {
			case '1':
				return "Pending";
				break;
			case '2':
				return "Under Review";
				break;
			case '3':
				return "Rejected";
				break;
			case '4':
				return "Conditional Offer of Acceptance";
				break;
			case '5':
				return "UnConditional Offer of Acceptance";
				break;
			case '6':
				return "Completed";
				break;
			case '7':
				return "InComplete Documents";
				break;
			case '8':
				return "Submitted";
				break;
			default:
				return "Unknown";
				break;	
		}
	};

	$scope.sidebar = {};
	$scope.sidebar.inbox 		= [];
	$scope.sidebar.sent 		= [];
	$scope.sidebar.saved 		= [];
	$scope.sidebar.trash 		= [];
	$scope.sidebar.applications = [];
	$scope.sidebar.disciplines 	= [];
	$scope.sidebar.schools 		= [];
	
	$scope.sidebar.load = function () {
		$scope.sidebar.loadApplications();
	};
	
	$scope.messages = {};
	$scope.messages.messages = [];
	
	$scope.messages.getMessages = function (param) {
		switch (param) {
			case 0:
				$scope.messages.messages = $scope.messages.inbox;
			break;
			case 1:
				$scope.messages.messages = $scope.messages.sent;
			break;
			case 2:
				$scope.messages.messages = $scope.messages.saved;
			break;
			case 3:
				$scope.messages.messages = $scope.messages.trash;	
			break;
		}
	};
	
	$scope.sidebar.loadApplications = function () {
		$.getJSON($scope.baseControllerUrl +"/fetchMyApplications", function (res) {
			$scope.sidebar.applications = res.applications;
			$scope.$digest();
		});
	};
	
	$scope.messages.getInboxMsg 	= function () {
		$.getJSON($scope.baseMsgControllerUrl + "fetchInbox", function (res) {
			$scope.sidebar.inbox = res.msgs;
			$scope.$digest();
		});
	}();
	
	$scope.messages.getOutboxMsg 	= function () {
		$.getJSON($scope.baseMsgControllerUrl + "fetchOutbox", function (res) {
			$scope.sidebar.sent	= res.msgs;
			$scope.$digest();
		});
	}();
	
	$scope.messages.getSavedMsg 	= function () {
		$.getJSON($scope.baseMsgControllerUrl + "fetchDrafts", function (res) {
			$scope.sidebar.saved = res.msgs;
			$scope.$digest();
		});
	}();
	
	$scope.messages.getTrashMsg 	= function () {
		$.getJSON($scope.baseMsgControllerUrl + "fetchTrash", function (res) {
			$scope.sidebar.trash = res.msgs;
			$scope.$digest();
		});
	}();
});