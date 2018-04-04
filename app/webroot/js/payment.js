$(document).ready(function(){
	$('.currency').change(function(){
		console.log($(this).val());
		temp = $(this);
		if ((currency = $(this).val()) && (duration_id = $(this).closest('form').find('.duration').val())) {
			$.post('/general/get_amount', {'duration_id': duration_id, 'currency' : currency})
			.done(function(data) {
				console.log(data);
				$(temp).closest('form').find('.amount').val(data);
			})
			.fail(function(data) {
				console.log(data);
			});
		}
	});
	$('.duration').change(function(){
		//console.log($(this).val());
		temp = $(this);
		if ((currency = $(this).closest('form').find('.currency').val()) && (duration_id = $(this).val())) {
			$.post('/general/get_amount', {'duration_id': duration_id, 'currency' : currency})
			.done(function(data) {
				//console.log(data);
				$(temp).closest('form').find('.amount').val(data);
			})
			.fail(function(data) {
				console.log(data);
			});
		}
	});
});