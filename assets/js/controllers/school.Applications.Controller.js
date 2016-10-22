var app = app || angular.module('schoolApp', ['ngAnimate', 'ngSanitize', 'angularUtils.directives.dirPagination', 'ngFileUpload']);
app.controller('schoolCntrl', function ($scope, $http, $filter, $sce) {

	/* applications part */
	$scope.application = {};
	
	$scope.application.applications = [];
	
	$scope.application.name 		= "";
	$scope.application.deadline		= "";
	$scope.application.resumption 	= "";
	$scope.application.search		= "";
	$scope.application.disciplines	= [];
	$scope.application.update		= {};
	$scope.application.editing		= false;
	$scope.application.editingItem	= {};
	$scope.application.editingItem.discipline = [];
	
	$scope.application.update.name 			= "";
	$scope.application.update.deadline		= "";
	$scope.application.update.resumption 	= "";
	$scope.application.update.search		= "";
	$scope.application.update.disciplines	= [];
	
	$scope.application.applicants 			= [];
	
	$scope.application.loadDisciplines = function () {
		$http.get($scope.baseControllerUrl + 'getSchoolDisciplines')
		.success(function(response) {
			angular.forEach(response.courses, function (courses) {
				var course = {
					id					: courses.discipline,
					checked				: true,
					discipline_name		: courses.discipline_name,
				};
				$scope.application.disciplines.push(course);	
			});
		});
	};
	
	$scope.application.loadApplications = function () {
		
		$.post($scope.baseControllerUrl + 'getSchoolApplicationFrames', function (response) {
			$scope.application.applications = $.parseJSON(response).applications;
			
			angular.forEach($scope.application.applications, function (applications) {
				applications.deadline 	= new Date(applications.deadline);
				applications.resumption	= new Date(applications.resumption);
			});
		});
	};
	
	$scope.application.searchCourse = function (item, discipline) {

		var gotten = null;
		var x;
		for (var i=0; i<item.discipline.length, x = item.discipline[i]; i++) {
			if (x.id == discipline.id) return x;
		}
		return gotten;
	};
	
	$scope.application.editApplication = function (item) {
		var disciplines = [];
		angular.forEach($scope.application.disciplines, function (discipline) {
			var found = $scope.application.searchCourse(item, discipline);
			
			if (found !== null) {
				disciplines.push(found);
			} else {
				discipline.checked = false;
				disciplines.push(discipline);
			}
		});
		item.discipline = disciplines;
		$scope.application.editingItem 	= item;
		$scope.application.editing		= true;
	};
	
	$scope.application.updateApplication = function () {
		var postData = {
			name		: $scope.application.editingItem.name, 
			deadline	: $scope.application.editingItem.deadline, 
			resumption	: $scope.application.editingItem.resumption, 
			disciplines	: $scope.application.editingItem.disciplines,
			id			: $scope.application.editingItem.id,
		};
		
		$scope.application.editingItem.name 		= "";
		$scope.application.editingItem.deadline 	= "";
		$scope.application.editingItem.resumption 	= "";
		
		$.post($scope.baseControllerUrl + 'updateSchoolApplication', postData, function (response) {
			var r = $.parseJSON(response);
			$scope.$digest();
			if (r.status) goodAlert('SAVED', "Application Updated Successfully!");
			else badAlert('ERROR', "Application NOT UPDATED Successfully!");
			
		}).fail(function () { badAlert('ERROR', "Application NOT UPDATED Successfully!"); });
	};
	
	$scope.application.deleteApplication = function (item) {
		
		var postData = { id	: $scope.application.editingItem.id};
		$scope.application.editingItem.name 		= "";
		$scope.application.editingItem.deadline 	= "";
		$scope.application.editingItem.resumption 	= "";
		
		var final_array = [];
		
		$scope.application.applications.findIndex(function(param, index, arr) {
			$.each(param, function (key, value) { 
				if (value.id !== $scope.application.editingItem.id) 
					final_array.push(value); 
			});
		});
		$scope.application.applications = final_array;
		
		$.post($scope.baseControllerUrl + 'deleteSchoolApplication', postData, function (response) {
			var r = $.parseJSON(response);
			if (r.status)
				goodAlert('SAVED', "Application DELETED Successfully!");
			else 
				badAlert('ERROR', "Application NOT Saved Successfully!");
				
		}).fail(function () { 
			badAlert('ERROR', "Application NOT DELETED Successfully!"); 
		});
	};
	
	$scope.application.saveApplication = function () {
		// send data to applications table
		$scope.application.editingItem.name 		= $scope.application.name;
		$scope.application.editingItem.deadline 	= $scope.application.deadline;
		$scope.application.editingItem.resumption 	= $scope.application.resumption;
		$scope.application.editingItem.disciplines 	= $scope.application.disciplines;
		
		var postData = {
			name		: $scope.application.editingItem.name, 
			deadline	: $scope.application.editingItem.deadline, 
			resumption	: $scope.application.editingItem.resumption, 
			disciplines	: $scope.application.editingItem.disciplines,
		};
		
		$.post($scope.baseControllerUrl + 'saveSchoolApplication', postData, function (response) {
			var r = $.parseJSON(response);
			if (r.status) {
				goodAlert('SAVED', "Application Saved Successfully!");
				$scope.application.editingItem.id = r.id;
				$scope.application.applications.push($scope.application.editingItem);
				$scope.$digest();
				
			} else {
				badAlert('ERROR', "Application NOT Saved Successfully!");
			}
			$('.modal').modal('hide');
		}).fail(function () {
			$('.modal').modal('hide');
			badAlert('ERROR', "Application NOT Saved Successfully!");
		});
	};
	
	$scope.application.loadApplicants = function () {
		$.post($scope.baseControllerUrl + 'fetchApplicants', function (response) {
			$scope.application.applicants = $scope.application.sortApplicants($.parseJSON(response).applicants);
		});	
	};
	
	$scope.application.sortApplicants = function (items) {
		var applicants 		= [];
		var item_applicant 	= [];
		var x = 1;
		
		angular.forEach(items, function (item) {
			if (x === items.length) {
				item.position = 0;
				item_applicant.push(item);
				applicants.push(item_applicant);
				
			} else if (x % 2 === 0) {
				item.position = 1;
				item_applicant.push(item);
				applicants.push(item_applicant);
				item_applicant = [];
				
			} else {
				item.position = 0;
				item_applicant.push(item);	
			}
			x++;
		});
		return applicants;
	};
	
	$scope.application.loadApplicants();
});