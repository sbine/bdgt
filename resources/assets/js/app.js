$(document).on('ready ajaxComplete', function() {
	$(".moment").not('.processed-ready').each(function(value) {
		var dateFromNow = moment($(this).text(), "YYYY-MM-DD").fromNow();

		if (dateFromNow !== 'Invalid date') {
			$(this).text(dateFromNow);
		}

		$(this).addClass('processed-ready');
	});

	$(".money").not('.processed-ready').each(function(value) {
		if ($(this).text().charAt(0) == '-') {
			$(this).addClass('negative');
		}
		else {
			$(this).addClass('positive');
		}
	});
});

$(document).ready(function()
{
	$('.datepicker').datepicker({
		'zIndexOffset': 1050,
		'format': 'yyyy-mm-dd',
	}).datepicker('setDate', new Date()).datepicker('update');
});