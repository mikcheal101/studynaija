var app = angular.module('schoolApp', ['ngAnimate', 'ngSanitize', 'angularUtils.directives.dirPagination', 'ngFileUpload']);

app.filter('mySearchFilter', function () {
	return function (items, element) {
		var courses = new Array;
		angular.forEach(items, function (item) {
			var show_all 			= (element.sos.value && element.edu.value && 
										element.eng.value && element.admin.value && 
										element.sci.value && element.agric.value && 
										element.law.value && element.med.value && 
										element.arts.value && element.others.value && 
										element.all.value && element.sorted.value  
										&& element.unsorted.value);
			
			var show_all_sorted		= (element.sos.value && element.edu.value && 
										element.eng.value && element.admin.value && 
										element.sci.value && element.agric.value && 
										element.law.value && element.med.value && 
										element.arts.value && element.others.value && 
										element.all.value && element.sorted.value  
										&& !(element.unsorted.value));
										
			var show_all_unsorted	= (element.sos.value && element.edu.value && 
										element.eng.value && element.admin.value && 
										element.sci.value && element.agric.value && 
										element.law.value && element.med.value && 
										element.arts.value && element.others.value && 
										element.all.value && element.unsorted.value  
										&& !(element.sorted.value));
										
			var show_some_sorted	= ((element.sos.value || element.edu.value || 
										element.eng.value || element.admin.value || 
										element.sci.value || element.agric.value || 
										element.law.value || element.med.value || 
										element.arts.value || element.others.value) &&  
										(!(element.all.value) && element.sorted.value  
										&& !(element.unsorted.value)));
										
			var show_some_unsorted	= ((element.sos.value || element.edu.value || 
										element.eng.value || element.admin.value || 
										element.sci.value || element.agric.value || 
										element.law.value || element.med.value || 
										element.arts.value || element.others.value) &&  
										(!(element.all.value) && element.unsorted.value  
										&& !(element.sorted.value)));
										
			var show_some_selected 	= ((element.sos.value || element.edu.value || 
										element.eng.value || element.admin.value || 
										element.sci.value || element.agric.value || 
										element.law.value || element.med.value || 
										element.arts.value || element.others.value) &&  
										(!(element.all.value) && element.unsorted.value  
										&& element.sorted.value));
			
			if (show_all) {
				courses.push(item);
			} else if (show_all_sorted) {
				if (item.faculty !== null) 
					courses.push(item);
					
			} else if (show_all_unsorted) {
				if (item.faculty == null) 
					courses.push(item);
				
			} else if (show_some_sorted) {
				
				if (element.admin.value && (item.faculty == element.admin.id)) {
					courses.push(item);
					
				} else if (element.agric.value && (item.faculty == element.agric.id)) { 
					courses.push(item);
					
				} else if (element.arts.value && (item.faculty == element.arts.id)) { 
					courses.push(item);
					
				} else if (element.edu.value && (item.faculty == element.edu.id)) { 
					courses.push(item);
					
				} else if (element.eng.value && (item.faculty == element.eng.id)) { 
					courses.push(item);
					
				} else if (element.law.value && (item.faculty == element.law.id)) { 
					courses.push(item);
					
				} else if (element.med.value && (item.faculty == element.med.id)) { 
					courses.push(item);
					
				} else if (element.sci.value && (item.faculty == element.sci.id)) { 
					courses.push(item);
					
				} else if (element.sos.value && (item.faculty == element.sos.id)) { 
					courses.push(item);
					
				} else if (element.others.value && (item.faculty == element.others.id)) { 
					courses.push(item);
				}
				
			} else if (show_some_unsorted) {
				if (item.faculty == null) 
					courses.push(item);
					
			} else if (show_some_selected){
				if (item.faculty == null) 
					courses.push(item);
					
				if ((element.admin.value && (item.faculty == element.admin.id)) || item.faculty == null) {
					courses.push(item);
					
				} else if ((element.agric.value && (item.faculty == element.agric.id)) || item.faculty == null) { 
					courses.push(item);
					
				} else if ((element.arts.value && (item.faculty == element.arts.id))  || item.faculty == null) { 
					courses.push(item);
					
				} else if ((element.edu.value && (item.faculty == element.edu.id))  || item.faculty == null) { 
					courses.push(item);
					
				} else if ((element.eng.value && (item.faculty == element.eng.id))  || item.faculty == null) { 
					courses.push(item);
					
				} else if ((element.law.value && (item.faculty == element.law.id))  || item.faculty == null) { 
					courses.push(item);
					
				} else if ((element.med.value && (item.faculty == element.med.id)) || item.faculty == null) { 
					courses.push(item);
					
				} else if ((element.sci.value && (item.faculty == element.sci.id)) || item.faculty == null) { 
					courses.push(item);
					
				} else if ((element.sos.value && (item.faculty == element.sos.id)) || item.faculty == null) { 
					courses.push(item);
					
				} else if ((element.others.value && (item.faculty == element.others.id)) || item.faculty == null) { 
					courses.push(item);
				}
			} 
			
		});
		return courses;
	};	
});

app.controller('schoolCntrl', function ($scope, $http, $filter, $sce) {
	
	$scope.baseControllerUrl 	= 'http://localhost/ngschools/index.php?/schoolsController/';
	$scope.baseUrl 				= 'http://localhost/ngschools/school/';
	
	$scope.courses 			= [];
	$scope.selectedCourses	= [];
	$scope.selectedFaculties= [];
	$scope.search 			= {};
	
	$scope.x_courses 		=[];
	$scope.processing 		= false;
	$scope.faculties 		= [];
	$scope.searchChecks 	= {
		all				: {value: true, id: 0},
		unsorted		: {value: true, id: 0},
		sorted			: {value: true, id: 0},
		admin			: {value: true, id: 1},
		agric			: {value: true, id: 2},
		arts			: {value: true, id: 3},
		edu				: {value: true, id: 4},
		eng				: {value: true, id: 5},
		law				: {value: true, id: 6},
		med				: {value: true, id: 7},
		sci				: {value: true, id: 8},
		sos				: {value: true, id: 9},
		others			: {value: true, id: 10},
	};
	
	$scope.init = function () {
		$scope.getData();
		$scope.getFaulties();
	};
	
	$scope.checkAll = function () {
		var option = $scope.searchChecks.all.value;
		angular.forEach($scope.searchChecks, function (opt) {
			opt.value = option;
		});
		if ($scope.searchChecks.all.value == false) $scope.searchChecks.sorted.value = true;
	};
	
	$scope.toogleAll = function () {
		var option = true;
		option = (option && $scope.searchChecks.sos.value);
		option = (option && $scope.searchChecks.edu.value);
		option = (option && $scope.searchChecks.eng.value);
		option = (option && $scope.searchChecks.admin.value);
		option = (option && $scope.searchChecks.sci.value);
		option = (option && $scope.searchChecks.agric.value);
		option = (option && $scope.searchChecks.law.value);
		option = (option && $scope.searchChecks.med.value);
		option = (option && $scope.searchChecks.arts.value);
		option = (option && $scope.searchChecks.others.value);
		$scope.searchChecks.all.value = option;
	};
	
	$scope.swapUnsorted = function () {
		if ($scope.searchChecks.unsorted.value == false) $scope.searchChecks.sorted.value = true;
	};
	
	$scope.swapSorted = function () {
		if ($scope.searchChecks.sorted.value == false) $scope.searchChecks.unsorted.value = true;
	};

	$scope.getData = function (url) {
		$http.post($scope.baseUrl + '/getCourses')
		.success(function(response) {
			$scope.processing = false;
			$scope.courses = response.courses;
		});
	};
	
	
	$scope.getDisciplinesCourses = function () {
		return $scope.courses;
	};
	
	$scope.getFaulties = function() {
		$http.post($scope.baseControllerUrl + 'getFaculties')
		.success(function(response) {
			$scope.faculties = response.faculties;
			angular.forEach($scope.faculties, function (x) {
				x.courses = [];
			});
		});
	};
	
	$scope.getFaculty = function (sentId) {
		var found = $filter('filter')($scope.faculties, {id: sentId}, true);
		console.log('found area', sentId);
		return found[0];
	};
	
	$scope.search = function() {
		console.log($scope.searchBar);
	};
	
	$scope.saveDiscipline = function ($evt, course) {
		param 			= $evt.currentTarget; 
		var select 		= param.parentNode.parentNode.parentNode.childNodes[1].childNodes[1];
		var faculty 	= select.options[select.selectedIndex].value;
		var discipline 	= param.getAttribute('value');
		var url 		= $scope.baseUrl + '/disciplineSchool';
				
		course.faculty = faculty;
		$.post(url, {discipline: discipline, faculty:faculty}, function (x) {
			goodAlert('SAVED', "Discipline Associated to Faculty Successfully!");
		});
	};
	
	$scope.updateDiscipline = function ($evt, course) {
		param 			= $evt.currentTarget; 
		var select 		= param.parentNode.parentNode.parentNode.childNodes[1].childNodes[1];
		var faculty 	= select.options[select.selectedIndex].value;
		var discipline 	= param.getAttribute('value');
		var stdid 		= param.getAttribute('data-stdid');
		
		var url 		= $scope.baseUrl + '/disciplineSchoolUpdate';
		
		course.faculty = faculty;
		$.post(url, {discipline: discipline, faculty:faculty, id: stdid}, function (x) {
			goodAlert('UPDATED', "Discipline Associated to Faculty Successfully!");
		});
	};
	
	
}); 
