window.flag = 0;

$(document).ready(function() {
	window.isHeaderTop = $('.header-top').height();
	window.isHeader = $('.header').height();
	window.isBanner= isHeader + $('.banner').height();
	$(function(){
		$(window).scroll(function(){
	    	//checkRolling();
		});
	});
	$('.language').click(function(){
		$(this).closest('form').submit();
	});
	
	// Change country
	$('.country').change(function(){
		//console.log($('.country').val());
		temp = $(this);
		if ( (country_id = $(this).val()) && (model = $(this).attr('model')) )  {
			$.post(webroot + 'general/get_location_by_country', {'country_id': country_id, 'model': model})
			.done(function(data) {
				$(temp).closest('fieldset, form').find('.location').closest('div').html(data);
			})
			.fail(function(data) {
				console.log(data);
			});
		}
	});
	$('.language').click(function(){
		$(this).closest('form').submit();
	});
	$('.avatar').change(function(event) {
		file = event.target.files[0];
		temp = URL.createObjectURL(file);
		$('.avatar-img').prop('src', temp);
	});
	$('.square').change(function(event) {
		file = event.target.files[0];
		temp = URL.createObjectURL(file);
		$('.square-img').prop('src', temp);
	});
	$('.rectangle').change(function(event) {
		file = event.target.files[0];
		temp = URL.createObjectURL(file);
		$('.rectangle-img').prop('src', temp);
	});
	
	// Random background image on Login Page
	console.log(1);
	bg_random = Math.floor((Math.random() * 100))%3 + 1;
	$('.login-wrapper').removeClass(function (index, className) {
		return (className.match (/bg-/g) || []).join('');
	});
	$('.login-wrapper').addClass('bg-' + bg_random);
	
});

//Date picker
$(function() {
	$(".datepicker.today_future").datepicker({ dateFormat: 'yy-mm-dd', minDate: 0, maxDate: "+1M" });
	$(".datepicker.past").datepicker({ changeMonth: true, changeYear: true, dateFormat: 'yy-mm-dd', yearRange: "-100:+0", maxDate: "+0M"});
	$(".datepicker.past_future").datepicker({ changeMonth: true, changeYear: true, dateFormat: 'yy-mm-dd', yearRange: "-100:+10"});
	$(".datepicker.birthday").datepicker({ changeMonth: true, changeYear: true, dateFormat: 'yy-mm-dd', yearRange: "-100:-12"});
});

//Check rolling and roll bar's position on load page
function checkRolling() {
	/*
	if($(this).scrollTop() < isHeader) {
		if(flag) {
			$('.logo-mini').animate({"width" : "0px"}, 300);
			flag = 0;
		}
	} else {	
		if(!flag) {
			$('.logo-mini').animate({width : "164px"}, 500);
			flag = 1;
		}
	}
	*/
}
