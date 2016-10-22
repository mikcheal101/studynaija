app.controller ('messagesController', function ($scope, $http, Upload, $interval) {
	
	var INBOX 	= 0;
	var SENT 	= 1;
	var DRAFT	= 2;
	var TRASH	= 3;
	
	$scope.messageType 		= INBOX;
	$scope.messages 		= [];
	$scope.myRecipients 	= [];
	$scope.currentMessage	= {
		to 		: [],
		sub		: "",
		mesg	: "",
	};
	
	$scope.selectedMessage = { id: 0};
	
	$scope.resetCompose = function () {
		tinyMCE.activeEditor.setContent("");
		$scope.currentMessage	= {
			to 		: [],
			sub		: "",
			mesg	: ""
		};
		$scope.$digest ();
	};
	
	$scope.getMessages = function (param) {
		$scope.messageType = param;
		switch (param) {
			case INBOX:
				$scope.loadInbox ();
			break;
			case SENT:
				$scope.loadOutbox ();
			break;
			case DRAFT:
				$scope.loadDrafts ();
			break;
			case TRASH:
				$scope.loadTrash ();
			break;
			default:
			break;
		};
	};
	
	$scope.sendMessage = function () {
		$scope.currentMessage.mesg = tinyMCE.activeEditor.getContent ();
		// get the currentMessage to send to the server 
		$.post ('postMessage', {data: $scope.currentMessage}, function (res) {
			res = $.parseJSON (res);
			if (res.status === 200) {
				// clear the currentMessage
				$scope.resetCompose ();
			} else {
				// alert user of an error
			}
		});
	};
	
	$scope.saveMessage = function () {
		$scope.currentMessage.mesg = tinyMCE.activeEditor.getContent ();
		// get the currentMessage to send to the server 
		$.post ('saveMessage', {data: $scope.currentMessage}, function (res) {
			res = $.parseJSON (res);
			if (res.status === 200) {
				// clear the currentMessage
				$scope.resetCompose ();
			} else {
				// alert user of an error
			}
		});

	};
	
	$scope.loadInbox = function () {
		$.getJSON ('getInbox', function (msg) {
			$scope.messages = msg.object;
			$scope.$digest ();
		});
	};
	
	$scope.loadOutbox = function () {
		$.getJSON ('getSent', function (msg) {
			$scope.messages = msg.object;
			$scope.$digest ();
		});
	};
	
	$scope.loadDrafts = function () {
		$.getJSON ('getSaved', function (msg) {
			$scope.messages = msg.object;
			$scope.$digest ();
		});
	};
	
	$scope.loadTrash = function () {
		$.getJSON ('getTrash', function (msg) {
			$scope.messages = msg.object;
			$scope.$digest ();
		});
	};

	$scope.loadMyRecipients = function () {
		$.getJSON ('my_recipients', function (res) {
			$scope.myRecipients = res.object;
			$scope.$digest ();
		});
	};
	
	$scope.loadMyRecipients ();
	
	$scope.readMessage = function (param) {
		// get the message 
		$scope.selectedMessage = param;
		console.log (param.from_status);
	};
	
	$scope.deleteMessage = function (param) {
		var message = $scope.messages.indexOf (param);
		// remove the message and send it to the db
		$scope.messages.splice (message, 1);
		$scope.selectedMessage = { id: 0};
		$.post ('trashMessage', {type: $scope.messageType, data:param}, function (res) {});
	};
	
	$scope.restoreMessage = function (param) {
		var message = $scope.messages.indexOf ($scope.selectedMessage);
		// remove the message and send it to the db
		$scope.messages.splice (message, 1);
		$scope.selectedMessage = { id: 0};
		$.post ('restoreMessage', {type: $scope.messageType, data:param}, function (res) { console.log (res);});
	}
	
	$scope.junkMessage = function () {
		var message = $scope.messages.indexOf ($scope.selectedMessage);
		var param 	= $scope.selectedMessage;
		// remove the message and send it to the db
		$scope.messages.splice (message, 1);
		$scope.selectedMessage = { id: 0};
		$.post ('junkMessage', {type: $scope.messageType, data:param}, function (res) {});
	};
	
	$scope.replyMessage = function (param) {
		var message = $scope.messages.indexOf ($scope.selectedMessage);
		// remove the message and send it to the db
		/*$scope.messages.splice (message, 1);
		$scope.selectedMessage = { id: 0};
		$.post ('trashMessage', {type: $scope.messageType, data:param}, function (res) {});
		*/
	};
});