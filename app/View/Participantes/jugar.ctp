<?php echo $this->Html->script('client_connection_manager'); ?>
<?php echo $this->Html->script('client_connection_parser'); ?>
<?php echo $this->Html->script('game_objects'); ?>
<script>
	//var context;
	var game_loop_timer;

	$(document).ready(function(){
		//context = document.getElementById('simpleCanvas').getContext("2d");

		//Setting up connection
		client_connection_manager.base_url = '<?php echo $this->Html->Url(array('controller'=>'participantes','action'=>'conn_test')); ?>';
		client_connection_manager.user_token = '<?php echo $user_token; ?>';
		client_connection_manager.callback = client_connection_parser.parseData;
		client_connection_manager.startConnection();
		
		game_loop_timer = setInterval(function(){update();/*draw();*/},32);
	});
	
	function update(){}
	
	/*function draw(){
		//context.clearRect(0, 0, canvas.width, canvas.height);
	}*/

	function startGameCountdown(seconds){
		$('#start_game_seconds').show();
		seconds_timer.start(seconds,function(){},$('#start_game_seconds .seconds'));
	}
	
	function hideAllElements(){
		$('.data-partida').hide();
		$('.pregunta').hide();
		$('.scoreboard_container').hide();
	}

	function showGameData(){
		$('.data-partida .tiempo_por_pregunta').text(partida.tiempo_por_pregunta);
		$('.data-partida .group_name').text(partida.groups[partida.group_id].name);
		$('.data-partida .group_members').empty();
		$.each(partida.groups[partida.group_id].participantes,function(id,participante){
			var name = '<span>'+participante.name+'</span>';
			if(id == partida.participante_id){
				name = '<span class="me">'+participante.name+'</span>';
			}
			$('.data-partida .group_members').append(name);
		});
		$('.data-partida').show();
	}
	
	var current_pregunta_id;
	
	function showPregunta(pregunta_id){
		hideAllElements();
		$('.pregunta .respuestas .respuesta').remove();
		current_pregunta_id = pregunta_id;
		pregunta = partida.preguntas[pregunta_id];
		$('.pregunta .pregunta_text').text(pregunta.pregunta);
		$.each(pregunta.respuestas,function(id,respuesta){
			var respuesta_object = $('.pregunta .respuestas .respuesta_template').clone();
			respuesta_object.find('.respuesta_text').text(respuesta.respuesta);
			respuesta_object.click(function(){
				selectRespuesta(id);
			});
			respuesta_object.removeClass('respuesta_template').addClass('respuesta').attr('id','respuesta_'+id);
			respuesta_object.appendTo($('.pregunta .respuestas'));
		});
		$('.pregunta').show();
		
		seconds_timer.start(partida.tiempo_por_pregunta,function(){
			selectRespuesta(0);
		},$('#seconds_left'));
	}
	
	function selectRespuesta(respuesta_id){
		if(seconds_timer.running){
			seconds_timer.stop();
			$('#respuesta_'+partida.preguntas[current_pregunta_id].respuesta_id).addClass('correcta');
			if(respuesta_id != partida.preguntas[current_pregunta_id].respuesta_id){
				$('#respuesta_'+respuesta_id).addClass('incorrecta');
			}
			client_connection_parser.selectRespuesta(current_pregunta_id,respuesta_id,seconds_timer.seconds_left);
		}
	}
	
	function showScoreBoard(groups){
		hideAllElements();
		$('.scoreboard_container tr.data').remove();
		$.each(groups,function(id,group){
			var own_group = '';
			if(id == partida.group_id){
				own_group = 'own';
				$.each(group.participantes,function(participante_id,participante){
					var is_self = '';
					if(participante_id == partida.participante_id){
						is_self = 'own';
					}
					$('.scoreboard.group table').append('<tr class="data '+is_self+'"><td>'+participante.name+'</td><td>'+participante.points[partida.pregunta_id]+'</td><td>'+participante.total_points+'</td></tr>');
				});
			}
			$('.scoreboard.general table').append('<tr class="data '+own_group+'"><td>'+group.name+'</td><td>'+group.points[partida.pregunta_id]+'</td><td>'+group.total_points+'</td></tr>');
		});
		$('.scoreboard_container').show();
		showScoreBoardTab('general');
		seconds_timer.start(5,function(){},$('#seconds_left'));
	}
	
	function showScoreBoardTab(tab){
		$('.scoreboard_container .tabs div').removeClass('selected');
		$('.scoreboard_container .tabs .'+tab).addClass('selected');
		$('.scoreboard').hide();
		$('.scoreboard.'+tab).show();
	}
</script>
<!--<canvas id="simpleCanvas" width="1200" height="700"></canvas>-->

<style>
	.game-container{height: 400px;}
	
	#start_game_seconds{position: absolute; width: 100%; margin: 0px 0px 0px -10px; bottom: 0; text-align: center; padding: 10px; font-size: 10px;}
	
	#seconds_left{position: absolute; margin: 0px 0px 0px -10px; bottom: 0; text-align: center; padding: 10px; font-size: 10px;}
	
	.data-partida{position: absolute; border: 2px solid black; padding: 10px; width: 500px; height: 275px; right: 0px; left: 0px; margin: auto; top: 0px; bottom: 0px;}
		.data-partida h1{margin: 0px; font-weight: bold; font-size: 20px; text-align: center;}
		.data-partida p{margin: 10px; font-size: 12px;}
		.data-partida .tiempo_por_pregunta{font-weight: bold;}
		.data-partida .group_name{font-weight: bold;}
		.data-partida .group_members{}
			.data-partida .group_members span{font-weight: bold; margin: 0px 5px;}
			.data-partida .group_members .me{color: green;}
	
	.pregunta{position: absolute; border: 2px solid black; padding: 10px; width: 500px; height: 275px; right: 0px; left: 0px; margin: auto; top: 0px; bottom: 0px;}
		.pregunta .pregunta_text{font-weight: bold; font-size: 30px; margin: 0px; text-align: center;}
		.pregunta .respuestas{background-color: rgb(194, 194, 194); margin: 10px;}
			.pregunta .respuestas .respuesta_template{display:none;}
			.pregunta .respuestas .respuesta{cursor: pointer; padding: 5px;}
			.pregunta .respuestas .respuesta.correcta{background-color: rgb(0, 255, 0);}
			.pregunta .respuestas .respuesta.incorrecta{background-color: red;}
				.pregunta .respuestas .respuesta .respuesta_text{margin: 0px; background-color: transparent; font-size: 15px;}
				
	.scoreboard_container{position: absolute; border: 2px solid black; margin: auto; right: 0px; top: 0px; left: 0px; width: 600px; bottom: 0px; height: 300px;}
		.scoreboard_container .tabs{background-color: rgb(204, 204, 204);}
			.scoreboard_container .tabs div{display: inline-block; padding: 5px; cursor: pointer;}
			.scoreboard_container .tabs div.selected{background-color: white;}
		.scoreboard_container .scoreboard{display:none;}
			.scoreboard_container .scoreboard tr.own{font-weight: bold; background-color: #E0E0E0;}
</style>

<div class="game-container">

	<div class="data-partida" style="display:none;">
		<h1>Data de la partida</h1>
		<p>Tiempo por pregunta: <span class="tiempo_por_pregunta"></span></p>
		<p>Mi equipo (<span class="group_name"></span>): <span class="group_members"></span></p>
		<div id="start_game_seconds" style="display:none;">El juego comenzará en <span class="seconds"></span> segundos</div>
	</div>

	<div class="pregunta" style="display:none;">
		<h1 class="pregunta_text"></h1>
		<div class="respuestas">
			<div class="respuesta_template">
				<h1 class="respuesta_text"></h1>
			</div>
		</div>
	</div>
	
	<div class="scoreboard_container" style="display:none;">
		<div class="tabs">
			<div class="general" onClick="showScoreBoardTab('general');">Tabla General</div>
			<div class="group" onClick="showScoreBoardTab('group');">Tabla del grupo</div>
		</div>
		<div class="scoreboard general">
			<table><tr><th>Grupo</th><th>Puntaje</th><th>Puntaje Total</th></tr></table>
		</div>
		<div class="scoreboard group">
			<table><tr><th>Jugador</th><th>Puntaje</th><th>Puntaje Total</th></tr></table>
		</div>
	</div>
	
	<div id="seconds_left"></div>
</div>