<?php echo $this->Html->script('game_objects'); ?>
<script>
	var socket;
	
	$(document).ready(function(){
		
		$('#content').css('height',$(window).height());
		$('#content').css('width',$(window).width());
		
		client_connection_manager.base_url = '<?php echo $this->Html->Url(array('controller'=>'partidas','action'=>'connect')); ?>';
		
		<?php if(!isset($own_partida)){ ?>
		
			socket = io('<?php echo $_SERVER['HTTP_HOST']; ?>:8888');
			
			socket.emit('establishConnection',{usuario_id:<?php echo $usuario['id']; ?>, partida_id: <?php echo $partida_id; ?>});
			
			socket.on('status', function(data){
				client_connection_parser.parseData(data);
			});
			
			$(window).focus(function(){
				socket.emit('reEstablishConnection');
			}).blur(function(){
				socket.emit('deEstablishConnection');
			}).unload(function(){
				socket.emit('disconnection');
			}).bind('beforeunload', function() {
				socket.emit('disconnection');
			});
			
		<?php }else{ ?>
			client_connection_parser.parseData({status: 1, time_updated: 1});
			setTimeout(function(){client_connection_parser.parseData({status: 2});},2500);
		<?php } ?>
		
		adjustTexts();
		//setTimeout(adjustTexts,1000);
		setupElements();
	});

	function lineBreak(string, n_chars){
		var new_string = '';
		var char_count = 0;
		for(var i = 0; i < string.length; i++){
			if(string[i] == ' '){
				if(char_count > n_chars){
					new_string += '\n';
					char_count = 0;
				}else{
					new_string += string[i];
				}
			}else{
				new_string += string[i];
			}
			char_count++;
		}
		return new_string;
	}
	
	function adjustTexts(){
		$('.text').each(function(){
			var height = $(this).height();
			$(this).css({'text-align':'center','vertical-align':'middle','line-height':height.toString()+'px','font-size':(height*0.5).toString()+'px'});
		});
	}
	
	function setupElements(){
		$('#black_overlay').hide();
		$('#status_bar').hide();
		$('#game_data').hide();
		$('#pregunta').hide();
		$('#scoreboard').hide();
		$('#after_pregunta').hide();
		//$('#confirm_option').hide();
		$('#confirm_option_button').hide();
		$('#contenido_a_estudiar').hide();
		/*var width = $('#window').width() * 1.5;
		$('#background').css({'width': width, 'height': width, 'top': -(width - $('#window').height()) / 2, 'left': -(width - $('#window').width()) / 2});*/
	}
	
	function getCurrentAction(){
		<?php if(!isset($own_partida)){ ?>
			if($("#contenido_a_estudiar").is(":visible")){
				socket.emit('userStatus',{status: 'Leyendo contenido'});
			}else if($("#game_data").is(":visible")){
				socket.emit('userStatus',{status: 'Esperando comienzo'});
			}else if($("#pregunta").is(":visible")){
				socket.emit('userStatus',{status: 'En pregunta '+partida.pregunta_index});
			}else if($("#after_pregunta").is(":visible")){
				socket.emit('userStatus',{status: 'Respondió pregunta '+partida.pregunta_index});
			}else if($("#scoreboard").is(":visible")){
				socket.emit('userStatus',{status: 'En tabla de puntajes'});
			}
		<?php } ?>
	}
	
	function hideAllElements(){
		toggleGameDataGUI(false);
		toggleScoreboardGUI(false);
		togglePreguntaGUI(false);
		toggleAfterPreguntaGUI(false);
		toggleConfirmOptionGUI(false);
		toggleOverlay(false);
	}
	
	function showStatusBar(state){
		if(($("#status_bar").is(":visible") && !state) || (!$("#status_bar").is(":visible") && state)){
			setPointsGUI(partida.points);
			setPreguntaIndexGUI();
			if(state){
				$("#status_bar").css('top','-'+$('#status_bar').css('height'));
				var target_top = '1%';
			}else{
				$("#status_bar").css('top','1%');
				var target_top = '-'+$('#status_bar').css('height');
			}
			$("#status_bar").show();
			$("#status_bar").stop();
			$("#status_bar").animate({top: target_top},500,function(){if(!state){$("#status_bar").hide();}});
		}
	}
	
	function toggleGameDataGUI(state){
		if(($("#game_data").is(":visible") && !state) || (!$("#game_data").is(":visible") && state)){
			if(state){
				$("#game_data").css('top','-'+$('#game_data').css('height'));
				var target_top = '10%';
			}else{
				$("#game_data").css('top','10%');
				var target_top = '-' + $('#game_data').css('height');
			}
			$("#game_data").show();
			$("#game_data").stop();
			$("#game_data").animate({top: target_top},750,function(){if(!state){$("#game_data").hide();}});
		}
	}
	
	function togglePreguntaGUI(state){
		if(($("#pregunta").is(":visible") && !state) || (!$("#pregunta").is(":visible") && state)){
			$("#pregunta").show();
			$("#pregunta").stop();
			$("#pregunta .respuestas").stop();
			if(state){
				$('#pregunta').css('left',-$('#pregunta').width());
				var pregunta_target_left = '5%';
				$('#pregunta .respuestas').css('top',-$('#pregunta .respuestas').height());
				var respuestas_target_top = '17.5%';
				$("#pregunta").animate({left: pregunta_target_left},500,function(){
					$("#pregunta .respuestas").animate({top: respuestas_target_top},800,'swing',function(){});
				});
			}else{
				$('#pregunta').css('left','5%');
				var pregunta_target_left = -$('#pregunta').width();
				$('#pregunta .respuestas').css('top','17.5%');
				var respuestas_target_top = -$('#pregunta .respuestas').height();
				$("#pregunta .respuestas").animate({top: respuestas_target_top},1000,function(){});
				$("#pregunta").animate({left: pregunta_target_left},1000,function(){$("#pregunta").hide();});
			}
		}
	}

	function toggleOverlay(state){
		if(($("#black_overlay").is(":visible") && !state) || (!$("#black_overlay").is(":visible") && state)){
			if(state){
				$("#black_overlay").fadeIn("fast", function(){});
			}else{
				$("#black_overlay").fadeOut("fast", function(){});
			}
		}
	}
	
	function toggleAfterPreguntaGUI(state){
		if(($("#after_pregunta").is(":visible") && !state) || (!$("#after_pregunta").is(":visible") && state)){
			toggleOverlay(state);
			if(state){
				$('#after_pregunta').css('top',$('#content').height());
				var target_top = '20%';
			}else{
				$('#after_pregunta').css('top','20%');
				var target_top = $('#content').height();
			}
			$("#after_pregunta").show();
			$("#after_pregunta").animate({top: target_top},750,function(){if(!state){$("#after_pregunta").hide();}else{$('#pregunta').hide();}});
		}
	}
	
	function toggleConfirmOptionGUI(state){
		/*if(($("#confirm_option").is(":visible") && !state) || (!$("#confirm_option").is(":visible") && state)){
			toggleOverlay(state);
			if(state){
				$("#confirm_option").fadeIn("fast", function(){});
			}else{
				$("#confirm_option").fadeOut("fast", function(){});
			}
		}*/
		
		if(($("#confirm_option_button").is(":visible") && !state) || (!$("#confirm_option_button").is(":visible") && state)){
			var target_left = '90%';
			if(!state){
				target_left = '100%';
			}
			$("#confirm_option_button").show();
			$("#confirm_option_button").animate({left: target_left},250,function(){if(!state){$("#confirm_option_button").hide();}});
		}
	}
	
	function toggleContenidoEstudiarGUI(){
		var target_top;
		var state = false;
		if($("#contenido_a_estudiar").is(":visible")){
			$("#contenido_a_estudiar").css('top','5%');
			target_top = '105%';
		}else{
			$("#contenido_a_estudiar").css('top','105%');
			target_top = '5%';
			$("#contenido_a_estudiar").show();
			state = true;
		}
		toggleOverlay(state);
		if(!state){
			$("#show_contenido_button").text('Leer contenido');
		}else{
			$("#show_contenido_button").text('Ocultar contenido');
			<?php if(!isset($own_partida)){ ?>
				socket.emit('userStatus',{status: 'Leyendo contenido'});
			<?php } ?>
		}
		$("#contenido_a_estudiar").animate({top: target_top},750,function(){if(!state){$("#contenido_a_estudiar").hide();getCurrentAction();}});
	}
	
	function toggleScoreboardGUI(state){
		if(($("#scoreboard").is(":visible") && !state) || (!$("#scoreboard").is(":visible") && state)){
			if(state){
				$("#scoreboard").css('left',$('#content').width());
				var target_left = '5%';
			}else{
				$("#scoreboard").css('left','5%');
				var target_left = $('#content').width();
			}
			$("#scoreboard").show();
			$("#scoreboard").stop();
			$("#scoreboard").animate({left: target_left},750,function(){if(!state){$("#scoreboard").hide();}});
		}
	}
	
	function startGameCountdown(seconds){
		seconds_timer.start(seconds,function(){
			<?php if(isset($own_partida)){ ?>
				client_connection_parser.parseData({status: 3, pregunta_index: 1});
			<?php } ?>
		},function(seconds_left){
			$('#game_data .start_counter').text('El juego comenzara en '+seconds_left+' segundos...');
		});
		$('#game_data .start_counter').css('bottom','-'+$('#game_data .start_counter').height()+'px').show();
		$("#game_data .start_counter").animate({bottom: 0},500,function(){});
	}
	
	function setSecondsTimerValue(seconds){
		$('#status_bar .seconds').text(seconds.toString());
	}
	
	var time_bar_animation;
	
	function setTimeBarPercentage(percentage, time){
		if(time != null){
			$("#status_bar .seconds_bar").animate({width: percentage.toString()+'%'},time,function(){});
		}else{
			$("#status_bar .seconds_bar").stop();
			$("#status_bar .seconds_bar").css('width',percentage.toString()+'%');
		}
	}
	
	function showPointsGained(points){
		var plus = "+"; if(points < 0){plus = "";}
		$('#status_bar .points_gained').text(plus + points.toString()).css({'top':'10%','opacity':1}).stop();
		$("#status_bar .points_gained").animate({top: -$('#status_bar .points_gained').height(), opacity: 0},2000,function(){});
	}
	
	function showTimePointsGained(points){
		$('#status_bar .time_points_gained').text("+" + points.toString()).css({'top':'25%','opacity':1}).stop();
		$("#status_bar .time_points_gained").animate({top: -$('#status_bar .time_points_gained').height(), opacity: 0},2000,function(){});
	}
	
	function setPointsGUI(points){
		$('#status_bar .puntaje').text(points.toString());
	}
	
	function setPreguntaIndexGUI(){
		if(partida.pregunta_index != null){
			$('#status_bar .pregunta_index').text(partida.pregunta_index.toString() + "/" + partida.mp_cantidad_preguntas);
		}
	}
	
	function refreshGameData(){
		$('#game_data .title').text(partida.nombre_juego);
		$('#game_data .tiempo_por_pregunta').text('Tiempo por pregunta: '+partida.mp_tiempo_pregunta);
		$('#game_data .cantidad_preguntas').text('Cantidad de preguntas: '+partida.mp_cantidad_preguntas);
	
		$('#contenido_a_estudiar').html(partida.contenido);
	
		if(partida.equipo != false){
			$('#game_data .equipo .equipo_name').text(partida.equipo.nombre).css('background-color',partida.equipo.color);
			$('#game_data #integrante_prefab').show();
			$('#game_data .integrantes .data').remove();
			$.each(partida.equipo.integrantes,function(id,integrante){
				var integrante_element = $('#game_data #integrante_prefab').clone().attr('id','participante_'+id).addClass('data').appendTo('#game_data .integrantes').text(integrante.nombre+' '+integrante.apellido).css('background-image','url(<?php echo $this->webroot.'img/avatars/'; ?>'+integrante.Avatar.filename+')');
			});
			$('#game_data #integrante_prefab').hide();
		}
		<?php if(!isset($own_partida)){ ?>
			socket.emit('userStatus',{status: 'Esperando comienzo'});
		<?php } ?>
		toggleGameDataGUI(true);
	}

	var respuesta_comentario;
	
	function showPregunta(){
		pregunta = partida.preguntas[partida.pregunta_index];

		$('#pregunta .titulo').html(pregunta.texto);
		
		if(pregunta.texto.indexOf('<br>') > -1){
			$('#pregunta .titulo').css({'line-height':'4.5vh','font-size':'3vh','padding-top':'1%'});
		}else{
			$('#pregunta .titulo').css({'line-height':'9.5vh','font-size':'4vh','padding-top':'0'});
		}
		
		resetRespuestas();

		$.each(pregunta.opciones,function(index,respuesta){
			$('#pregunta #respuesta_prefab').clone().text(respuesta.texto).attr('id','respuesta_'+respuesta.id).click(function(){
				respuesta_comentario = respuesta.comentario;
				markRespuesta(respuesta.id,respuesta.texto);
				//selectRespuesta(respuesta.id);
			}).appendTo('#pregunta .respuestas');
		});

		$('#pregunta #respuesta_prefab').clone().text('No se').attr('id','respuesta_0').click(function(){
			respuesta_comentario = pregunta.comentario;
			markRespuesta(0,'No se');
			//selectRespuesta(0);
		}).appendTo('#pregunta .respuestas');

		$('#pregunta #respuesta_prefab').hide();
		
		hideAllElements();
		togglePreguntaGUI(true);
		
		seconds_timer.start(partida.mp_tiempo_pregunta,function(){
			selectRespuesta(0);
		},function(seconds_left){
			if(seconds_left < partida.mp_tiempo_pregunta){
				var perc = ((seconds_left-1) * 100) / partida.mp_tiempo_pregunta;
				setTimeBarPercentage(perc,1000);
			}else{
				setTimeBarPercentage(100);
			}
			setSecondsTimerValue(seconds_left);
		});
		
		<?php if(!isset($own_partida)){ ?>
			socket.emit('userStatus',{status: 'En pregunta '+partida.pregunta_index});
		<?php } ?>
		
		showStatusBar(true);
	}
	
	function resetRespuestas(){
		$('#pregunta .respuestas .respuesta').each(function(){
			if($(this).attr('id') != 'respuesta_prefab'){
				$(this).remove();
			}
		});
		$('#pregunta #respuesta_prefab').show();
	}
	
	var respuesta_id_selected;
	
	function selectRespuesta(respuesta_id){
		respuesta_id_selected = respuesta_id;
		toggleConfirmOptionGUI(false);
		if(seconds_timer.running){
			seconds_timer.stop();
			
			$('#pregunta .respuestas .respuesta').each(function(){
				if($(this).attr('id').replace('respuesta_','') == partida.preguntas[partida.pregunta_index].opcion_correcta_id){
					marcarRespuestaCorrecta($(this));
				}
				if(respuesta_id != partida.preguntas[partida.pregunta_index].opcion_correcta_id){
					if($(this).attr('id').replace('respuesta_','') == respuesta_id){
						marcarRespuestaIncorrecta($(this));
					}
				}
			});
			
			client_connection_parser.selectRespuesta(partida.pregunta_index,respuesta_id,seconds_timer.seconds_left);
		}
	}
	
	function markRespuesta(respuesta_id, texto){
		//$('#confirm_option .respuesta').html(texto);
		//$('#confirm_option .btn-si').attr('onClick','selectRespuesta('+respuesta_id+')');
		$('#confirm_option_button').unbind('click');
		$('#confirm_option_button').click(function(){selectRespuesta(respuesta_id);});
		$('#pregunta .respuesta').removeClass('marked');
		$('#respuesta_'+respuesta_id).addClass('marked');
		toggleConfirmOptionGUI(true);
	}
	
	function marcarRespuestaCorrecta(respuesta){
		respuesta.removeClass('marked');
		respuesta.addClass('correcta');
	}
	
	function marcarRespuestaIncorrecta(respuesta){
		respuesta.removeClass('marked');
		respuesta.addClass('incorrecta');
	}
	
	function showAfterPregunta(points){
		
		var title = "Respuesta correcta!";
		var image_class = "correcta";
		if(respuesta_id_selected != partida.preguntas[partida.pregunta_index].opcion_correcta_id){
			title = "Respuesta incorrecta...";
			image_class = "incorrecta";
		}
		
		$('#after_pregunta').removeClass('correcta').removeClass('incorrecta').addClass(image_class);
		
		$('#after_pregunta .head').text(title);
		$('#after_pregunta .image').removeClass('correcta').removeClass('incorrecta');
		
		var points_text;
		if(points > 0){
			points_text = "¡Ganaste "+points.toString()+" puntos!"
		}else if(points < 0){
			points_text = "¡Perdiste "+(points*(-1)).toString()+" puntos!"
		}else{
			points_text = "No respondiste, no ganaste ningún punto."
		}
		$('#after_pregunta .foot').text(points_text);
		
		var comentario = partida.preguntas[partida.pregunta_index].comentario;
		if(respuesta_id_selected != 0){
			comentario = respuesta_comentario;
		}
		$('#after_pregunta .comentario').text(comentario);
		
		<?php if(!isset($own_partida)){ ?>
			socket.emit('userStatus',{status: 'Respondió pregunta '+partida.pregunta_index});
		<?php } ?>
		
		toggleAfterPreguntaGUI(true);
	}
	
	//Variables para setear cuanto tarda en mostrar cuantos puntos gano
	var add_score_ms = 250;
	var show_time_score_ms = 500;
	var add_time_score_ms = 500;
	var show_details_ms = 500;
	
	function addPoints(answer_points,time_points){
		
		<?php if(!isset($own_partida)){ ?>
			socket.emit('selectAnswer',{pregunta_id: partida.pregunta_index, respuesta_id: respuesta_id_selected});
		<?php } ?>
		
		var initial_answer_points = answer_points;
		var initial_time_points = time_points;
		
		var afterShowScore = function(){
			setTimeout(function(){
				showAfterPregunta(initial_answer_points + initial_time_points);
				<?php if(isset($own_partida)){ ?>
					if(partida.pregunta_index + 1 <= partida.mp_cantidad_preguntas){
						setTimeout(function(){
							client_connection_parser.parseData({status: 4});
						},5000);
					}
				<?php } ?>
			},show_details_ms);
		}
		
		if(answer_points != 0){
			showPointsGained(answer_points);
			var score_amount_per_cycle = (16*answer_points)/add_score_ms;
			var addScorePointsTimer = setInterval(function(){
				if(answer_points - score_amount_per_cycle >= 0){
					answer_points -= score_amount_per_cycle;
					setPointsGUI(parseInt($('#status_bar .puntaje').text()) + parseInt(score_amount_per_cycle));
				}else{
					clearInterval(addScorePointsTimer);
					partida.points = parseInt(partida.points) + parseInt(initial_answer_points);
					setPointsGUI(partida.points);
					if(time_points > 0){
						setTimeout(function(){
							score_amount_per_cycle = (16*time_points)/add_time_score_ms;
							var seconds_left = parseInt($('#status_bar .seconds').text());
							var secondsToSubtract = seconds_left / (add_time_score_ms/16);
							var time_points_gained = 0;
							var addTimePointsTimer = setInterval(function(){
								if(time_points - score_amount_per_cycle >= 0){
									time_points -= score_amount_per_cycle;
									time_points_gained += score_amount_per_cycle;
									showTimePointsGained(parseInt(time_points_gained));
									setPointsGUI(parseInt(parseInt($('#status_bar .puntaje').text()) + parseInt(score_amount_per_cycle)));
									seconds_left -= secondsToSubtract;
									if(seconds_left > 0){
										setSecondsTimerValue(parseInt(seconds_left));
										var perc = (seconds_left * 100) / partida.mp_tiempo_pregunta;
										setTimeBarPercentage(perc);
									}
								}else{
									clearInterval(addTimePointsTimer);
									partida.points = parseInt(partida.points) + parseInt(initial_time_points);
									showTimePointsGained(initial_time_points);
									setPointsGUI(partida.points);
									setSecondsTimerValue(0);
									setTimeBarPercentage(0);
									afterShowScore();
								}
							},16);
						},show_time_score_ms);
					}else{afterShowScore();}
				}
			},16);
		}else{afterShowScore();}
	}

	function showScoreBoard(equipos){
		
		$('#scoreboard tr.data').remove();
		
		for(var pos=0;pos<Object.keys(equipos).length;pos++){
			$.each(equipos,function(equipo_id,equipo){
				if(equipo.pos == pos){
					if(equipo_id == partida.equipo.id){
						if(equipo.Usuarios != null){
							$.each(equipo.Usuarios,function(index,usuario){
								var row_equipo = '<tr class="data">';
								row_equipo += '<td>'+usuario.apellido+'</td>'
								if(usuario.preguntas[partida.pregunta_index] != null){
									row_equipo += '<td>'+usuario.preguntas[partida.pregunta_index].puntos+'</td>'
								}else{
									row_equipo += '<td>0</td>'
								}
								row_equipo += '<td>'+usuario.puntos+'</td></tr>';
								$('#scoreboard table.group').append(row_equipo);
							});
						}
					}
					var row = '<tr class="data">';
					row += '<td>'+equipo.nombre+'</td>';
					if(equipo.preguntas[partida.pregunta_index] != null){
						row += '<td>'+equipo.preguntas[partida.pregunta_index].puntos+'</td>';
					}else{
						row += '<td>0</td>';
					}
					row += '<td>'+equipo.puntos+'</td></tr>';
					$('#scoreboard table.general').append(row);
				}
			});
		}
		
		hideAllElements();
		showStatusBar(false);
		toggleScoreboardGUI(true);
		
		<?php if(isset($own_partida)){ ?>
			if(partida.pregunta_index + 1 <= partida.mp_cantidad_preguntas){
				client_connection_parser.parseData({status: 3, pregunta_index: partida.pregunta_index + 1});
			}
		<?php }else{ ?>
			socket.emit('userStatus',{status: 'En tabla de puntajes'});
		<?php } ?>
	}

	function showScoreBoardTab(tab){
		$('#scoreboard table.general').stop();
		$('#scoreboard table.group').stop();
		$('#scoreboard .tab_buttons div').removeClass('pressed');
		$('#scoreboard .tab_buttons div.'+tab).addClass('pressed');
		if(tab == 'general'){
			$('#scoreboard table.general').animate({left: 0},1000,function(){});
			$('#scoreboard table.group').animate({left: '100%'},1000,function(){});
		}else{
			$('#scoreboard table.general').animate({left: '-100%'},1000,function(){});
			$('#scoreboard table.group').animate({left: 0},1000,function(){});
		}
	}
</script>

<div id="window">

	<!--<div id="background"></div>-->

	<div id="black_overlay"></div>

	<div id="status_bar">
		<div class="seconds text"></div>
		<div class="seconds_bar_container">
			<div class="seconds_bar"></div>
		</div>
		<div class="pregunta_index text"></div>
		<div class="puntaje text"></div>
		<div class="points_gained text"></div>
		<div class="time_points_gained text"></div>
	</div>
	
	<div id="game_data">
		<div class="title text">Datos del juego</div>
		<div class="center">Esperando a todos los jugadores</div>
		<div class="settings">
			<div class="tiempo_por_pregunta"></div>
			<div class="cantidad_preguntas"></div>
		</div>
		<div class="equipo">
			<div class="equipo_name text"></div>
			<div class="integrantes">
				<div class="integrante text" id="integrante_prefab"></div>
			</div>
		</div>
		<div class="start_counter text">El juego comenzara en 5 segundos...</div>
	</div>
	
	<div id="pregunta">
		<div class="titulo text">Título pregunta</div>
		<div class="respuestas">
			<div id="respuesta_prefab" class="respuesta text">Respuesta 1</div>
		</div>
	</div>
	
	<div id="scoreboard">
		<div class="title text">Tabla de resultados</div>
		<div class="tab_buttons">
			<div class="general pressed" onClick="showScoreBoardTab('general')">General</div>
			<div class="group" onClick="showScoreBoardTab('group')">Mi equipo</div>
		</div>
		<table class="general"><tr class="head"><th>Equipo</th><th>Puntaje</th><th>Puntaje Total</th></tr></table>
		<table class="group"><tr class="head"><th>Jugador</th><th>Puntaje</th><th>Puntaje Total</th></tr></table>
	</div>
	
	<div id="after_pregunta">
		<div class="head text"></div>
		<div class="body">
			<div class="image"></div>
			<div class="comentario"></div>
		</div>
		<div class="foot text"></div>
	</div>
	
	<!--<div id="confirm_option">
		<div class="head text">¿Estás segur<?php echo ($loggedUser['gender']=='male'?'o':'a'); ?>?</div>
		<div class="respuesta"></div>
		<div class="buttons">
			<a href="javascript:void(0);" onClick="toggleConfirmOptionGUI(false)" class="btn-no">No</a>
			<a href="javascript:void(0);" onClick="" class="btn-si">Si</a>
		</div>
	</div>-->
	
	<div id="confirm_option_button"></div>
	
	<div id="contenido_a_estudiar"></div>
</div>

<div id="bottom_bar">
	<button id="refreshPage" onClick="location.reload();$('#refreshPage').addClass('pressed');">↻</button>
	<button id="show_contenido_button" onClick="toggleContenidoEstudiarGUI();">Leer contenido</button>
	<span class="username"><?php echo $usuario['nombre'].' '.$usuario['apellido']; ?></span>
	<button id="backButton" onClick="window.location = '<?php echo $this->Html->Url(array('controller'=>'partidas','action'=>'index')); ?>';$('#backButton').addClass('pressed');">↩</button>
</div>