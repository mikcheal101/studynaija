var removeItem = function (removeItem, arr) {
	return $.grep(arr, function(value) {
		return value != removeItem;
	});
};

var checkAll = function (opts, fac) {
	$.each(opts, function () {
		$(this).prop('checked', true);
		fac.push($(this).val());
	});
	return fac;
};

var uncheckAll = function (opts) {
	$.each(opts, function () {
		$(this).prop('checked', false);
	});
};


var nullTable = function () {
	var _div = "";
	_div+='<div class="col-sm-12 padding-10 p-b-05 p-t-05 border-ash background-white-complete m-t-05">';
		_div+='<h3 class="text-red p-b-05 text-center bold">NO DISCIPLINES TO SHOW</h3>';
	_div+='</div>';	
	$('.coursesDiv').html(_div);
};

var displayProcessing = function () {
	var _div = "";
	_div+='<div class="col-sm-12 padding-10 p-b-05 p-t-05 border-ash background-white-complete m-t-05">';
		_div+='<h3 class="text-green p-b-05 text-center bold">PROCESSING...</h3>';
	_div+='</div>';	
	$('.coursesDiv').html(_div);
};

/* recheck this */
var getChecked = function() {
	var result = [];
	$('.options').each(function () {
		if($(this).is(':checked')) {
			result.push($(this).val());
		}
	});
	if (result.length == 12) {
		result.push($('#all').val());
		$('#all').prop('checked', true);
	}
	return result;
};




