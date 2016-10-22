$scope.messages = {};
	$scope.messages.inbox 	= [];
	$scope.messages.outbox 	= [];
	$scope.messages.drafts	= [];
	$scope.messages.trash	= [];
	$scope.messages.sending = [];
	$scope.messages.people	= [];
	
	$scope.messages.messageIds = [];
	
	$scope.messages.getPeopleTo = function () {
		$http.get($scope.baseMsgControllerUrl + 'getToPeople', function (param) {
			var data = $.parseJSON(param);
			$scope.messages.people = data.people;
		});
	};
	
	$scope.messages.addtomessageids = function (msg) {
		if (msg.checked) $scope.messages.messageIds.push(msg.id);
	};
	
	$scope.messages.sendMessage = function () {
		
		$http.post($scope.baseMsgControllerUrl +'sendMessage', {
				msg_to: $scope.messages.sending.to,
				msg_message: $scope.messages.sending.message,
				msg_subject: $scope.messages.sending.subject 
			}, function (param) {
			
			var data = $.parseJSON(param);
			
			if (data.status)
				goodAlert('Success!', "Message Sent Successfully!");
			else 
				badAlert('Error', "An Error Occured While Sending Message!");
		});
	};
		
	$scope.messages.loadInboxMessages = function () {
		
		$http.get($scope.baseMsgControllerUrl + 'getAllInboxMessages', function (param) {
			var data = $.parseJSON(param);
			angular.forEach(data.messages, function (msg) {
				msg.checked = false;
				$scope.messages.inbox.push(msg); 
			});
		});
	};
	
	$scope.messages.loadSentMessages = function () {
		$http.get($scope.baseMsgControllerUrl + 'getAllOutboxMessages', function (param) {
			var data = $.parseJSON(param);
			angular.forEach(data.messages, function (msg) {
				msg.checked = false;
				$scope.messages.outbox.push(msg); 
			});
		});
	};
	
	$scope.messages.loadTrashedMessages = function () {
		$http.get($scope.baseMsgControllerUrl + 'getAllTrashedMessages', function (param) {
			var data = $.parseJSON(param);
			angular.forEach(data.messages, function (msg) {
				msg.checked = false;
				$scope.messages.trash.push(msg); 
			});
		});
	};
	
	$scope.messages.markMessageUnread = function () {
		
		$http.post($scope.baseMsgControllerUrl + 'markMessagesUnread', {
			messageIds : $scope.messages.messageIds
		}, function (param) {
			var data = $.parseJSON(param);
			
			if (data.status)
				goodAlert('Success!', "Message(s) Successfully Marked Unread!");
			else 
				badAlert('Error', "An Error Occured While Marking Message(s) Unread!");
			$scope.messages.messageIds = [];
		});
	};
	
	$scope.messages.deleteMessage = function () {
		$http.post($scope.baseMsgControllerUrl + 'markMessagesUnread', {
			messageIds : $scope.messages.messageIds
		}, function (param) {
			var data = $.parseJSON(param);
			
			if (data.status)
				goodAlert('Success!', "Message(s) Successfully Deleted!");
			else 
				badAlert('Error', "An Error Occured While Deleting Message(s)!");
			$scope.messages.messageIds = [];
		});
	};


	// this handles the applications search part
	$scope.applications.search 			= {};
	$scope.applications.search.bar; // this is the search bar
	
	$scope.applications.search.degree_awards 	= [];
	$scope.applications.search.sub_disciplines 	= [];
	$scope.applications.search.states 			= [];
	$scope.applications.search.durations 		= [];
	$scope.applications.search.study_variants 	= [];
	$scope.applications.search.pricing 			= {
		min: 0,
		max: 0,
		per: {
			annum: {checked: false},
			semester: {checked: false},
		},
		student_type: {
			intl: {checked: false},
			local: {checked: false},
		}
	};
	
	$scope.applications.search.resultCount = 0;
	$scope.applications.search.order;
	

	$scope.applications.search.fetchAwards = function () {
		$scope.applications.search.degree_awards 	= [];
		$http.get($scope.baseControllerUrl + 'fetchAwards', function (param) {
			var data = $.parseJSON(param);
			angular.forEach(data.awards, function (award) {
				award.checked = false;
				$scope.applications.search.degree_awards.push(award);
			});
		});
	};
	
	
	$scope.applications.search.fetchSubDiscipline = function (faculty) {
		$scope.applications.search.sub_disciplines 	= [];
		$http.get($scope.baseControllerUrl + 'getSubDisciplines/' + faculty, function (param) {
			var data = $.parseJSON(param);
			angular.forEach(data.disciplines, function (discipline) {
				discipline.checked = false;
				$scope.applications.search.sub_disciplines.push(discipline);
			});
		});
	}; 
		
	$scope.applications.search.fetchStates = function () {
		$scope.applications.search.states = [];
		$http.get($scope.baseControllerUrl + 'fetchStates', function (param) {
			var data = $.parseJSON(param);
			angular.forEach(data.states, function (item) {
				item.checked = false;
				$scope.applications.search.states.push(item);
			});
		});
	};
	
	$scope.applications.search.fetchVariants = function () {
		$scope.applications.search.study_variants 	= [];
		$http.get($scope.baseControllerUrl + 'fetchVariants', function (param) {
			var data = $.parseJSON(param);
			angular.forEach(data.variants, function (item) {
				item.checked = false;
				$scope.applications.search.study_variants.push(item);
			});
		});
	};
	
	$scope.applications.search.init = function () {
		$scope.applications.search.fetchAwards ();
		$scope.applications.search.fetchStates();
	};