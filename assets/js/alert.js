$(function() { 
	tinymce.init({ 
		selector:'.summernote', 
		statusbar: false,
		menubar : false,
		toolbar : "undo redo | bold italic underline"
	}); 
	tinymce.init({ 
		selector:'.summernote2', 
		statusbar: false,
		menubar : false,
		toolbar : "undo redo | bold italic underline | styleselect",
		height	: 250,
	}); 
});
$('.notify .good').click(function() {
	var btn 	= $(this);
	$.notify({
		title: 		"<strong>"+ btn.attr('data-title') +"</strong>",
		message: 	btn.attr('data-message'),
	}, {
		type: 'success',
		animate: {
			enter: 'animated flipInY',
			exit: 'animated flipOutX'
		},	
		newest_on_top: true,
	});
});

$('.notify .bad').click(function() {
	var btn 	= $(this);
	$.notify({
		title: 		"<strong>"+ btn.attr('data-title') +"</strong>",
		message: 	btn.attr('data-message'),
	}, {
		type: 'danger',
		animate: {
			enter: 'animated flipInY',
			exit: 'animated flipOutX'
		},
		newest_on_top: true,
	});
});

$('.notify .warning').click(function() {
	var btn 	= $(this);
	$.notify({
		title: 		"<strong>"+ btn.attr('data-title') +"</strong>",
		message: 	btn.attr('data-message'),
	}, {
		type: 'warning',
		animate: {
			enter: 'animated flipInY',
			exit: 'animated flipOutX'
		},
		newest_on_top: true,
	});
});

var goodAlert = function (title, message) {
	$.notify({
		title: 		"<strong>"+ title +"</strong>",
		message: 	message,
	}, {
		type: 'success',
		animate: {
			enter: 'animated flipInY',
			exit: 'animated flipOutX'
		},
		newest_on_top: true,
	});
};

var badAlert = function (title, message) {
	$.notify({
		title: 		"<strong>"+ title +"</strong>",
		message: 	message,
	}, {
		type: 'danger',
		animate: {
			enter: 'animated flipInY',
			exit: 'animated flipOutX'
		},
		newest_on_top: true,
	});
};

var warningAlert = function (title, message) {
	$.notify({
		title: 		"<strong>"+ title +"</strong>",
		message: 	message,
	}, {
		type: 'warning',
		animate: {
			enter: 'animated flipInY',
			exit: 'animated flipOutX'
		},
		newest_on_top: true,
	});
};
