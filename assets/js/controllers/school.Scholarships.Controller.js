var app = app || angular.module('schoolApp', ['ngAnimate', 'ngSanitize', 'angularUtils.directives.dirPagination', 'ngFileUpload']);
app.controller('schoolCntrl', function ($scope, $http, $filter, $sce) {
	/** scholarships part **/
	$scope.scholarships = {};
	
	$scope.scholarships.details;
	$scope.scholarships.scholarshipsItems = [];
	
	$scope.scholarships.delete = false;
	$scope.scholarships.saving = true;
	$scope.scholarships.updating = false;
	$scope.scholarships.actionItem = {};
	
	
	$scope.scholarships.getScholarships = function (opt) {
		opt = opt || false;
		if (opt) console.log('getScholarships called!');
		
		$scope.scholarships.scholarshipsItems = [];
		$.post($scope.baseControllerUrl + '/getScholarships', function (items) {
			items = $.parseJSON(items);
			$scope.scholarships.scholarshipsItems = $scope.scholarships.sortScholarships(items.scholarships);
		});
	};
	
	$scope.scholarships.sortScholarships = function (items) {
		
		angular.forEach(items, function (item) {
			item.abbr = $.truncate(item.details, {length:500});
		});
		return items;
	};
	
	$scope.scholarships.getSingleScholarship = function (item) {
		$scope.scholarships.delete = true;
		$scope.scholarships.saving = false;
		$scope.scholarships.updating = true;
		$scope.scholarships.actionItem = item;
		$scope.scholarships.name = item.name;
		tinyMCE.activeEditor.setContent(item.details);
	};
	
	$scope.scholarships.saveScholarships = function () {
		$scope.scholarships.delete = false;
		$scope.scholarships.saving = true;
		$scope.scholarships.updating = false;
		
		$scope.scholarships.actionItem.name = $scope.scholarships.name;
		$scope.scholarships.actionItem.details = tinyMCE.activeEditor.getContent();

		$scope.scholarships.name = " ";
		tinyMCE.activeEditor.setContent("");
			
		$.post($scope.baseControllerUrl + 'saveScholarships', {name: $scope.scholarships.actionItem.name, details: $scope.scholarships.actionItem.details}, function (response) {
			var r = $.parseJSON(response);

			if (r.status) {
				goodAlert('SAVED', "Scholarships Item Saved Successfully!");
				$scope.scholarships.actionItem.id = r.id;
				var final_array = [];
				$scope.scholarships.scholarshipsItems.findIndex(function(param, index, arr) {
					$.each(param, function (key, value) { final_array.push(value); });
				});
				final_array.push($scope.scholarships.actionItem);
				
				$scope.scholarships.scholarshipsItems = $scope.scholarships.sortScholarships(final_array);
				$scope.$digest();
				
			} else {
				badAlert('ERROR', "Scholarships Item NOT Saved Successfully!");
			}
		});
		
	};
	
	$scope.scholarships.updateScholarships = function () {
		$scope.scholarships.delete = false;
		$scope.scholarships.saving = true;
		$scope.scholarships.updating = false;
		$scope.scholarships.actionItem.name = $scope.scholarships.name;
		$scope.scholarships.actionItem.details = tinyMCE.activeEditor.getContent();
		
		$scope.scholarships.name = " ";
		tinyMCE.activeEditor.setContent("");
		
		$.post($scope.baseControllerUrl + 'updateScholarships', {id: $scope.scholarships.actionItem.id, name: $scope.scholarships.actionItem.name, details: $scope.scholarships.actionItem.details}, function (response) {
			var r = $.parseJSON(response);
			
			$scope.$digest();

			if (r.status) {
				goodAlert('UPDATED', "Scholarships Item Updated Successfully!");
			} else {
				badAlert('ERROR', "Scholarships Item NOT Updated Successfully!");
			}
		});
	};
	
	$scope.scholarships.deleteScholarships = function () {
		$scope.scholarships.delete = false;
		$scope.scholarships.saving = true;
		$scope.scholarships.updating = false;
		
		$scope.scholarships.name = " ";
		tinyMCE.activeEditor.setContent("");
		
		var final_array = [];
		
		$scope.scholarships.scholarshipsItems.findIndex(function(param, index, arr) {
			$.each(param, function (key, value) { if (value.id !== $scope.scholarships.actionItem.id) final_array.push(value); });
		});
		$scope.scholarships.scholarshipsItems = $scope.scholarships.sortScholarships(final_array);
		
		$.post($scope.baseControllerUrl + 'deleteScholarships', {id: $scope.scholarships.actionItem.id}, function (response) {
			var r = $.parseJSON(response);
			if (r.status) goodAlert('DELETED', "Scholarships Item Deleted Successfully!");
			else badAlert('ERROR', "Scholarships Item NOT Deleted Successfully!");
		});
	};
});