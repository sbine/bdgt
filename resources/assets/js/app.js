$(document).on('ready ajaxComplete', function() {
	$(".moment").not('.processed-ready').each(function(value) {
		var dateFromNow = moment($(this).text(), "YYYY-MM-DD").fromNow();

		if (dateFromNow !== 'Invalid date') {
			$(this).text(dateFromNow);
		}

		$(this).addClass('processed-ready');
	});

	$(".money").not('.processed-ready').each(function(value) {
		var formattedValue = accounting.formatMoney($(this).text(), "$ ");

		if (formattedValue !== undefined) {
			$(this).text(formattedValue);
		}
	});

	$(".money-signed").not('.processed-ready').each(function(value) {
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
	$('.datepicker').each(function() {
		var dp = $(this);
		dp.datepicker({
			'zIndexOffset': 1050,
			'format': 'yyyy-mm-dd',
		})

		if (!dp.val()) {
			dp.datepicker('setDate', new Date()).datepicker('update');
		}
	});
});