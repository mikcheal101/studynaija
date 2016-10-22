$('#editModal').on('show.bs.modal', function (evt) {
	var btn = $(evt.relatedTarget);
	var application = btn.data('item');
	
	console.log(application); 
});
