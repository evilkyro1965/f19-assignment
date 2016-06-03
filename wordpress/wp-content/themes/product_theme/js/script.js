$(document).ready(function () {
	
	$( ".filterCheck" ).change(function() {
		
		var arrFilter = $('input[type=checkbox]:checked').map(function(_, el) {
			return $(el).val();
		}).get();
		
		var filterStr = arrFilter.toString();
		
		var filterUrl = currUrl+'?filters='+filterStr;
		
		if(filterStr !== '')
			window.location.href = filterUrl;
	});
	
});

function removeFilters() {
	var arrFilter = $('input[type=checkbox]:checked').map(function(_, el) {
			return $(el).val();
		}).get();
	
	var filterUrl = currUrl+'?filters=';
	
	if(arrFilter != null && arrFilter.length > 0)
		window.location.href = currUrl;
}
