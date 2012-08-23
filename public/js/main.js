$(document).ready(function() {
	var url = 'tweets.json';

	$('#schedule-info').popover({
		trigger: 'hover',
		placement: 'right'
	});
	$('#date-one').popover({
		trigger: 'hover',
		placement: 'right'
	});
	$('#date-two').popover({
		trigger: 'hover',
		placement: 'right'
	});
	$('#the-venue').popover({
		trigger: 'hover',
		placement: 'right'
	});
	$('#your-judges').popover({
		trigger: 'hover',
		placement: 'right'
	});
	$('#the-map').popover({
		trigger: 'hover',
		placement: 'right'
	});
	$('#apis-list').popover({
		trigger: 'hover',
		placement: 'right'
	});
	$('#recommended').popover({
		trigger: 'hover',
		placement: 'right'
	});

	setInterval(function(){
		$.get(url, function(result) {
			if (!result.length) {
				return;
			}
			$twitt = $('.twitt');
			$('.twitt ul').empty();
			$.each(result, function (i, el) {
				var stripped = (i % 2 == 0)? 'odd' : 'even';
				var $list = $('<li class="list-twitt '+stripped+'"><div class="img-wrapper"><img width="20" src="'+el.profile+'" /></div><div style="line-height: 11px">'+el.text+'</div><div>'+el.user+'</div></li>');
				$('.twitt ul').prepend($list);
			});

		}, 'json');
	}, 500);

	$.getJSON("http://ehub/place/5034cca2e4b0ec35e6f8b5d3.json", function(data){
		var items = '';

		jQuery.each(data, function(key, val) {
		  items += '<li>'+ val.name +'</li>';
		});

		$('#ul-nearby').append(items);


		//console.log(items);
	});

});