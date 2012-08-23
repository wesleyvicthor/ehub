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

	$('#wi-hack').tooltip();

	$('#wi-imp').tooltip();

	$('#wi-conf').tooltip();
	showGuider();
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


	function showGuider() {
		guiders.createGuider({
			buttons: [{name: "Next"}],
			description: "Ehub centraliza as informações e notificações sobre seu evento e gera interações com os participantes.",
			id: "first",
			next: "second",
			overlay: true,
			title: "Bem vindo ao Ehub!"
		}).show();

		guiders.createGuider({
			buttons: [{name: "Next"}, {name: 'Close'}],
			attachTo: '#event-infos',
			buttons: [{name: "Next"}],
			description: "Box com as informações principais pertinentes ao evento, dicas, opções, descontos, wifi, agenda, etc. Informações gravadas através de um formulário ou integração com Events do facebook",
			id: "second",
			next: "third",
			title: "O Evento",
			position: 2
		});

		guiders.createGuider({
			buttons: [{name: "Next"}, {name: 'Close'}],
			attachTo: '#hashtag-list',
			buttons: [{name: "Next"}],
			description: "Lista dos twitts realtime usando a hashtag do evento",
			id: "third",
			next: "fourth",
			title: "O que estão comentando?",
			position: 'leftTop'
 		});

		guiders.createGuider({
			buttons: [{name: "Next"}, {name: 'Close'}],
			attachTo: '#who-here',
			buttons: [{name: "Next"}],
			description: "Lista de quem está na aplicação, ou fez checking pelo foursquare com a possibilidade de gerar grupos de conversas. O evento tem a facilidade de interagir com os usuários na aplicação através de messagens às salas ou individualmente.",
			id: "fourth",
			next: "fifth",
			title: "Quem está no evento?",
			position: 'leftTop'
		});
	}

});