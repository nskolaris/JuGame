<?php echo $this->Html->script('client_connection_manager'); ?>
<?php echo $this->Html->script('client_connection_parser'); ?>
<?php echo $this->Html->script('game_objects'); ?>
<?php echo $this->Html->script('app-gui'); ?>
<script>
	var game;
	var socket;
	
	$(document).ready(function(){
		//Setting up connection
		client_connection_manager.base_url = '<?php echo $this->Html->Url(array('controller'=>'partidas','action'=>'connect')); ?>';
		client_connection_manager.callback = client_connection_parser.parseData;
		//client_connection_manager.startConnection();
		
		<?php if(!isset($own_partida)){ ?>
			socket = io('192.168.3.249:8888');
			socket.emit('establishConnection',{usuario_id:<?php echo $usuario['id']; ?>, partida_id: <?php echo $partida_id; ?>});
			socket.on('status', function(data){
				client_connection_parser.parseData(data);
			});
		<?php }else{ ?>
			client_connection_parser.parseData({status: 1, time_updated: 1});
			setTimeout(function(){client_connection_parser.parseData({status: 2});},2500);
		<?php } ?>
		
		game = new Phaser.Game($(window).width(), $(window).height(), Phaser.AUTO, '', { preload: preload, create: create, update: update });
		game.width = $(window).width();
		game.height = $(window).height();
	});
	
	//Phaser base functions
	
	function preload(){
		game.load.image('background','<?php echo $this->webroot.'img/cambiemos_bg_full.jpg'; ?>');
	}

	function create(){
		game.add.tileSprite(0, 0, game.width, game.height, 'background');
	}

	function update(){}
	
	//GUI functions
	var mainBoxObj;

	function setupGUI() {
		EZGUI.components.general_button.on('click', function () {
			showScoreBoardTab('general');
		});
		EZGUI.components.group_button.on('click', function () {
			showScoreBoardTab('group');
		});
		EZGUI.components.status_bar.position.y = -80;
		
		EZGUI.components.refresh_button.on('click', function () {
			location.reload();
		});
		
		EZGUI.components.logout_button.on('click', function () {
			window.location = "<?php echo $this->Html->Url(array('controller'=>'usuarios','action'=>'login')); ?>";
		});
		
		EZGUI.components.usuario_activo.settings.text = '<?php echo $usuario['apellido']; ?>';
		EZGUI.components.usuario_activo.rebuild();
	}
	
	var loaded_ui = false;
	
	EZGUI.Theme.load(['<?php echo $this->webroot.'assets/ezgui/metalworks-theme/metalworks-theme.json'; ?>'], function () {
		mainBoxObj.position = {x: ((game.width - mainBoxObj.width)/2), y: ((game.height - mainBoxObj.height)/2)};
		mainBox = EZGUI.create(mainBoxObj, 'metalworks');

		EZGUI.components.game_data.visible = false;
		EZGUI.components.scoreboard.visible = false;
		EZGUI.components.pregunta.visible = false;
		EZGUI.components.after_pregunta.visible = false;
		EZGUI.components.black_overlay.visible = false;

		setupGUI();
		loaded_ui = true;
	});
	
	function showGameStartTimerGUI(){
		EZGUI.components.start_timer.position.y = EZGUI.components.game_data.height;
		EZGUI.components.start_timer.visible = true;
		var target_position_y = EZGUI.components.start_timer.settings.position.y;
		EZGUI.components.start_timer.animatePosTo(EZGUI.components.start_timer.settings.position.x, target_position_y, 500, EZGUI.Easing.Linear.Out, function(){});
	}
	
	function toggleGameDataGUI(state){
		showStatusBar(false);
		if(state){
			EZGUI.components.start_timer.visible = false;
			EZGUI.components.game_data.position.y = -mainBox.height;
			EZGUI.components.game_data.visible = true;
			var target_position_y = EZGUI.components.game_data.settings.position.y;
		}else{
			EZGUI.components.game_data.position.y = EZGUI.components.game_data.settings.position.y;
			EZGUI.components.game_data.visible = true;
			var target_position_y = -mainBox.height;
		}
		EZGUI.components.game_data.animatePosTo(EZGUI.components.game_data.settings.position.x, target_position_y, 750, EZGUI.Easing.Back.Out, function(){
			if(!state){EZGUI.components.game_data.visible = false;}
		});
	}
	
	function toggleScoreboardGUI(state){
		if(state){
			EZGUI.components.scoreboard.position.x = mainBox.width;
			var target_position_x = EZGUI.components.scoreboard.settings.position.x;
		}else{
			EZGUI.components.scoreboard.position.x = EZGUI.components.scoreboard.settings.position.x;
			var target_position_x = mainBox.width;
		}
		EZGUI.components.scoreboard.visible = true;
		EZGUI.components.scoreboard.animatePosTo(target_position_x, EZGUI.components.scoreboard.settings.position.y, 750, EZGUI.Easing.Back.Out, function(){
			if(!state){EZGUI.components.scoreboard.visible = false;}
		});
	}
	
	function togglePreguntaGUI(state){
		if(state){
			EZGUI.components.pregunta.position.x = -mainBox.width;
			EZGUI.components.pregunta.visible = true;
			EZGUI.components.respuestas_container.position.y = -(EZGUI.components.pregunta.settings.height);
			EZGUI.components.respuestas_container.visible = true;
			
			EZGUI.components.pregunta.animatePosTo(EZGUI.components.pregunta.settings.position.x, EZGUI.components.pregunta.settings.position.y, 500, EZGUI.Easing.Back.Out, function(){
				EZGUI.components.respuestas_container.animatePosTo(
					EZGUI.components.respuestas_container.settings.position.x,
					EZGUI.components.respuestas_container.settings.position.y,
					800, EZGUI.Easing.Exponential.Out, function(){
					
					}
				);
			});
		}else{
			EZGUI.components.pregunta.position.x = EZGUI.components.pregunta.settings.position.x;
			EZGUI.components.pregunta.visible = true;
			EZGUI.components.respuestas_container.position.y = EZGUI.components.respuestas_container.settings.position.y;
			EZGUI.components.respuestas_container.visible = true;
			
			EZGUI.components.pregunta.animatePosTo(-mainBox.width, EZGUI.components.pregunta.settings.position.y, 1000, EZGUI.Easing.Back.Out, function(){
				EZGUI.components.pregunta.visible = false;
			});
			
			EZGUI.components.respuestas_container.animatePosTo(
				EZGUI.components.respuestas_container.settings.position.x,
				-EZGUI.components.pregunta.settings.height,
				1000, EZGUI.Easing.Exponential.Out, function(){
					EZGUI.components.respuestas_container.visible = false;
				}
			);
		}
	}

	function setAfterPreguntaText(title, text){
		EZGUI.components.after_pregunta_header.settings.text = title;
		EZGUI.components.after_pregunta_header.rebuild();
		text = lineBreak(text, 24);
		EZGUI.components.after_pregunta_text.settings.text = text;
		EZGUI.components.after_pregunta_text.rebuild();
	}
	
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
	
	function toggleAfterPreguntaGUI(state){
		toggleOverlay(state);
		if(state){
			EZGUI.components.after_pregunta.position.y = mainBox.height;
			var target_position_y = EZGUI.components.after_pregunta.settings.position.y;
		}else{
			EZGUI.components.after_pregunta.position.y = EZGUI.components.after_pregunta.settings.position.y;
			var target_position_y = mainBox.height;
		}
		EZGUI.components.after_pregunta.visible = true;
		EZGUI.components.after_pregunta.animatePosTo(EZGUI.components.after_pregunta.settings.position.x, target_position_y, 750, EZGUI.Easing.Back.Out, function(){
			if(!state){EZGUI.components.after_pregunta.visible = false;}
		});
	}
	
	function toggleOverlay(state){
		EZGUI.components.black_overlay.visible = state;
	}
	
	var tab_on_animation = false;
	
	function showScoreBoardTab(tab){
		if(!tab_on_animation){
			tab_on_animation = true;
			if(tab == 'general'){
				EZGUI.components.general_button.settings.skin = 'darkOrangeContainer';
				EZGUI.components.group_button.settings.skin = 'orangeContainer';
				EZGUI.components.table_general.animatePosTo(0, EZGUI.components.table_general.settings.position.y, 1000, EZGUI.Easing.Exponential.Out, function(){
					tab_on_animation = false;
				});
				EZGUI.components.table_grupo.animatePosTo(EZGUI.components.scoreboard.width, EZGUI.components.table_grupo.settings.position.y, 1000, EZGUI.Easing.Exponential.Out, function(){
					tab_on_animation = false;
				});
			}else{
				EZGUI.components.group_button.settings.skin = 'darkOrangeContainer';
				EZGUI.components.general_button.settings.skin = 'orangeContainer';
				EZGUI.components.table_grupo.animatePosTo(0, EZGUI.components.table_grupo.settings.position.y, 1000, EZGUI.Easing.Exponential.Out, function(){
					tab_on_animation = false;
				});
				EZGUI.components.table_general.animatePosTo(-EZGUI.components.scoreboard.width, EZGUI.components.table_general.settings.position.y, 1000, EZGUI.Easing.Exponential.Out, function(){
					tab_on_animation = false;
				});
			}
			EZGUI.components.general_button.rebuild();
			EZGUI.components.group_button.rebuild();
		}
	}
	
	var time_bar_animation;
	
	function setSecondsTimerValue(seconds){
		EZGUI.components.seconds_time.settings.text = seconds.toString();
		EZGUI.components.seconds_time.rebuild();
	}
	
	function setTimeBarPercentage(percentage, time){
		EZGUI.components.time_progress_bar.visible = true;
		var size = (percentage * EZGUI.components.time_progress_bar.settings.width)/100;
		if(time != null){
			time_bar_animation = EZGUI.components.time_progress_bar.animateSizeTo(size, EZGUI.components.time_progress_bar.settings.height, time, EZGUI.Easing.Linear.Out, function(){});
		}else{
			if(time_bar_animation != null){time_bar_animation.stop();}
			if(percentage == 0){
				EZGUI.components.time_progress_bar.visible = false; //Si seteaba width = 0 se rompia el boton "after_pregunta_next" ???
			}else{
				EZGUI.components.time_progress_bar.width = size;
			}
		}
	}
	
	function showPointsGained(points){
		var plus = "+";
		if(points < 0){
			plus = "";
		}
		EZGUI.components.points_gained.settings.text = plus + points.toString();
		EZGUI.components.points_gained.rebuild();
		EZGUI.components.points_gained.position.y = EZGUI.components.points_gained.settings.position.y;
		EZGUI.components.points_gained.visible = true;
		EZGUI.components.points_gained.animatePosTo(EZGUI.components.points_gained.settings.position.x, -EZGUI.components.points_gained.height, 7500, EZGUI.Easing.Exponential.Out, function(){
			EZGUI.components.points_gained.visible = false;
		});
	}
	
	function showTimePointsGained(points){
		EZGUI.components.time_points_gained.settings.text = "+" + points.toString();
		EZGUI.components.time_points_gained.rebuild();
		if(time_points_gained_animation != null){time_points_gained_animation.stop();}
		EZGUI.components.time_points_gained.position.y = EZGUI.components.time_points_gained.settings.position.y;
		EZGUI.components.time_points_gained.visible = true;
		var time_points_gained_animation = EZGUI.components.time_points_gained.animatePosTo(EZGUI.components.time_points_gained.settings.position.x, -EZGUI.components.time_points_gained.height, 7500, EZGUI.Easing.Exponential.Out, function(){
			EZGUI.components.time_points_gained.visible = false;
		});
	}
	
	function showStatusBar(state){
		EZGUI.components.points_gained.visible = false;
		EZGUI.components.time_points_gained.visible = false;
		setPointsGUI(partida.points);
		setPreguntaIndexGUI();
		if(state){
			var target_y = EZGUI.components.status_bar.settings.position.y;
		}else{
			var target_y = -EZGUI.components.status_bar.height;
		}
		EZGUI.components.status_bar.animatePosTo(EZGUI.components.status_bar.position.x,target_y,500,EZGUI.Easing.Back.Out,function(){});
	}
	
	function setPointsGUI(points){
		EZGUI.components.puntaje_counter.settings.text = points.toString();
		EZGUI.components.puntaje_counter.rebuild();
	}
	
	function setPreguntaIndexGUI(){
		if(partida.pregunta_index != null){
			EZGUI.components.pregunta_index.settings.text = partida.pregunta_index.toString() + "/" + partida.mp_cantidad_preguntas;
			EZGUI.components.pregunta_index.rebuild();
		}
	}
	
	//Game functions
	
	function startGameCountdown(seconds){
		seconds_timer.start(seconds,function(){
			<?php if(isset($own_partida)){ ?>
				client_connection_parser.parseData({status: 3, pregunta_index: 1});
			<?php } ?>
		},function(seconds_left){
			EZGUI.components.start_timer.settings.text = 'El juego comenzara en '+seconds_left+' segundos...';
			EZGUI.components.start_timer.rebuild();
		});
		showGameStartTimerGUI();
	}
	
	function hideAllElements(){
		if(EZGUI.components.game_data.visible){toggleGameDataGUI(false);}
		if(EZGUI.components.scoreboard.visible){toggleScoreboardGUI(false);}
		if(EZGUI.components.pregunta.visible){togglePreguntaGUI(false);}
		if(EZGUI.components.after_pregunta.visible){toggleAfterPreguntaGUI(false);}
		if(EZGUI.components.black_overlay.visible){toggleOverlay(false);}
	}

	function refreshGameData(){
		if(loaded_ui){
			EZGUI.components.game_data_title.settings.text = partida.nombre_juego;

			if(36 - partida.nombre_juego.length < 0){
				var chars_de_mas = 36 - partida.nombre_juego.length;
				if(chars_de_mas > -10){
					EZGUI.components.game_data_title.settings.font.size = '30px';
				}else if(chars_de_mas > -15){
					EZGUI.components.game_data_title.settings.font.size = '23px';
				}else if(chars_de_mas > -20){
					EZGUI.components.game_data_title.settings.font.size = '20px';
				}else if(chars_de_mas > -25){
					EZGUI.components.game_data_title.settings.font.size = '18px';
				}else{
					EZGUI.components.game_data_title.settings.font.size = '17px';
				}
			}else{
				EZGUI.components.game_data_title.settings.font.size = '40px';
			}
			
			EZGUI.components.game_data_title.rebuild();
			
			var text = 'ö  '+partida.mp_tiempo_pregunta+'\nü  '+partida.mp_cantidad_preguntas;
			EZGUI.components.game_data_text.settings.text = text;
			EZGUI.components.game_data_text.rebuild();
			
			var text_equipo = '';
			if(partida.equipo != false){
				text_equipo += partida.equipo.nombre+'\n';
				$.each(partida.equipo.integrantes,function(id,integrante){
					text_equipo += integrante.apellido + '\n';
				});
			}
			EZGUI.components.game_data_equipo.settings.text = text_equipo;
			EZGUI.components.game_data_equipo.rebuild();

			if(!EZGUI.components.game_data.visible){
				toggleGameDataGUI(true);
			}
		}else{
			setTimeout(refreshGameData,1000);
		}
	}

	var respuesta_comentario;
	
	function showPregunta(){
		pregunta = partida.preguntas[partida.pregunta_index];
				
		if(38 - pregunta.texto.length < 0){
			var chars_de_mas = 38 - pregunta.texto.length;
			//EZGUI.components.pregunta_text.settings.font.size = (30+(chars_de_mas/1.5)).toString() + 'px';
			if(chars_de_mas > -10){
				EZGUI.components.pregunta_text.settings.font.size = '25px';
			}else if(chars_de_mas > -15){
				EZGUI.components.pregunta_text.settings.font.size = '23px';
			}else if(chars_de_mas > -20){
				EZGUI.components.pregunta_text.settings.font.size = '20px';
			}else if(chars_de_mas > -25){
				EZGUI.components.pregunta_text.settings.font.size = '18px';
			}else{
				EZGUI.components.pregunta_text.settings.font.size = '15px';
			}
		}else{
			EZGUI.components.pregunta_text.settings.font.size = '30px';
		}
		
		if(pregunta.texto.indexOf('<br>') > -1){
			pregunta.texto = pregunta.texto.replace(/\<br \/\>/g, "\n");
			pregunta.texto = pregunta.texto.replace(/\<br\>/g, "\n");
			EZGUI.components.pregunta_text.settings.font.size = '18px';
		}
		
		/*pregunta.texto = lineBreak(pregunta.texto,36);
		if(pregunta.texto.indexOf("\n") > -1){
			EZGUI.components.pregunta_text.settings.font.size = '28px';
		}else{
			EZGUI.components.pregunta_text.settings.font.size = '30px';
		}*/
		
		EZGUI.components.pregunta_text.settings.text = pregunta.texto;
		EZGUI.components.pregunta_text.rebuild();

		resetRespuestas();

		var i = 1;

		$.each(pregunta.opciones,function(index,respuesta){
			if(40 - respuesta.texto.length < 0){
				var chars_de_mas = 40 - respuesta.texto.length;
				EZGUI.components['respuesta_'+i].settings.font.size = (20+(chars_de_mas/4)).toString() + 'px';
			}else{
				EZGUI.components['respuesta_'+i].settings.font.size = '22px';
			}
			if(respuesta.texto.indexOf('<br>') > -1){
				respuesta.texto = respuesta.texto.replace(/\<br \/\>/g, "\n");
				respuesta.texto = respuesta.texto.replace(/\<br\>/g, "\n");
				EZGUI.components['respuesta_'+i].settings.font.size = '20px';
			}
			EZGUI.components['respuesta_'+i].settings.text = respuesta.texto;
			EZGUI.components['respuesta_'+i].settings.respuesta_id = respuesta.id;
			EZGUI.components['respuesta_'+i].off('click');
			EZGUI.components['respuesta_'+i].on('click', function () {
				respuesta_comentario = respuesta.comentario;
				selectRespuesta(respuesta.id);
			});
			EZGUI.components['respuesta_'+i].visible = true;
			EZGUI.components['respuesta_'+i].rebuild();
			i++;
		});
		
		//No se
		EZGUI.components['respuesta_'+i].settings.font.size = '22px';
		EZGUI.components['respuesta_'+i].settings.text = 'No se';
		EZGUI.components['respuesta_'+i].settings.respuesta_id = 0;
		EZGUI.components['respuesta_'+i].off('click');
		EZGUI.components['respuesta_'+i].on('click', function () {
			respuesta_comentario = pregunta.comentario;
			selectRespuesta(0);
		});
		EZGUI.components['respuesta_'+i].visible = true;
		EZGUI.components['respuesta_'+i].rebuild();
		

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
		showStatusBar(true);
	}
	
	function resetRespuestas(){
		for(var i = 1; i <= 5; i++){
			EZGUI.components['respuesta_'+i].width = EZGUI.components['respuesta_'+i].settings.width;
			EZGUI.components['respuesta_'+i].height = EZGUI.components['respuesta_'+i].settings.height;
			EZGUI.components['respuesta_'+i].position.x = EZGUI.components['respuesta_'+i].settings.position.x;
			EZGUI.components['respuesta_'+i].position.y = EZGUI.components['respuesta_'+i].settings.position.y;
			EZGUI.components['respuesta_'+i].settings.skin = "orangeContainer";
			EZGUI.components['respuesta_'+i].rebuild();
			EZGUI.components['respuesta_'+i].visible = false;
		}
	}
	
	var respuesta_id_selected;
	
	function selectRespuesta(respuesta_id){
		respuesta_id_selected = respuesta_id;
		if(seconds_timer.running){
			seconds_timer.stop();
			for(var i = 1; i <= 5; i++){
				if(respuesta_id != partida.preguntas[partida.pregunta_index].opcion_correcta_id){
					if(EZGUI.components['respuesta_'+i].settings.respuesta_id == respuesta_id){
						marcarRespuestaIncorrecta(EZGUI.components['respuesta_'+i]);
					}
				}
				if(EZGUI.components['respuesta_'+i].settings.respuesta_id == partida.preguntas[partida.pregunta_index].opcion_correcta_id){
					marcarRespuestaCorrecta(EZGUI.components['respuesta_'+i]);
				}
			}
			<?php if(!isset($own_partida)){ ?>
				socket.emit('selectAnswer',{pregunta_id: pregunta_id, respuesta_id: respuesta_id});
			<?php } ?>
			client_connection_parser.selectRespuesta(partida.pregunta_index,respuesta_id,seconds_timer.seconds_left);
		}
	}
	
	function marcarRespuestaCorrecta(respuesta){
		respuesta.settings.skin = 'greenContainer';
		respuesta.rebuild();
		respuesta.animateSizeTo(
			respuesta.settings.width + 50,
			respuesta.settings.height,
			500, EZGUI.Easing.Back.Out, function(){}
		);
		respuesta.animatePosTo(
			respuesta.settings.position.x - 25,
			respuesta.settings.position.y,
			500, EZGUI.Easing.Back.Out, function(){}
		);
	}
	
	function marcarRespuestaIncorrecta(respuesta){
		respuesta.settings.skin = 'darkOrangeContainer';
		respuesta.rebuild();
		respuesta.animateSizeTo(
			respuesta.settings.width - 50,
			respuesta.settings.height,
			500, EZGUI.Easing.Back.Out, function(){}
		);
		respuesta.animatePosTo(
			respuesta.settings.position.x + 25,
			respuesta.settings.position.y,
			500, EZGUI.Easing.Back.Out, function(){}
		);
	}
	
	//Variables para setear cuanto tarda en mostrar cuantos puntos gano
	var add_score_ms = 250;
	var show_time_score_ms = 500;
	var add_time_score_ms = 500;
	var show_details_ms = 500;
	
	function addPoints(answer_points,time_points){
		var initial_answer_points = answer_points;
		var initial_time_points = time_points;
		var afterShowScore = function(){
			setTimeout(function(){
				var title = "Respuesta correcta!";
				var skin = "thumbsUp";
				
				var points_text;
				if(answer_points > 0){
					//points_text = "Ganaste "+initial_answer_points+" puntos más "+initial_time_points+" por responder en segundos!"
					points_text = "¡Ganaste "+(initial_answer_points+initial_time_points).toString()+" puntos!"
				}else if(answer_points < 0){
					points_text = "¡Perdiste "+(initial_answer_points*(-1)).toString()+" puntos!"
				}else{
					points_text = "No respondiste, no ganaste ningún punto."
				}
				EZGUI.components.after_pregunta_points.settings.text = points_text;
				EZGUI.components.after_pregunta_points.rebuild();
				
				if(respuesta_id_selected != partida.preguntas[partida.pregunta_index].opcion_correcta_id){
					title = "Respuesta incorrecta...";
					skin = "thumbsDown";
				}
				var comentario = partida.preguntas[partida.pregunta_index].comentario;
				if(respuesta_id_selected != 0){
					//comentario = partida.preguntas[partida.pregunta_index].opciones[respuesta_id_selected].comentario;
					comentario = respuesta_comentario;
				}
				var text = comentario;
				EZGUI.components.after_pregunta_image.settings.skin = skin;
				EZGUI.components.after_pregunta_image.rebuild();
				setAfterPreguntaText(title,text);
				toggleAfterPreguntaGUI(true);
				togglePreguntaGUI(false);
				
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
					setPointsGUI(parseInt(EZGUI.components.puntaje_counter.text) + parseInt(score_amount_per_cycle));
				}else{
					clearInterval(addScorePointsTimer);
					partida.points += initial_answer_points;
					setPointsGUI(partida.points);
					if(time_points > 0){
						setTimeout(function(){
							score_amount_per_cycle = (16*time_points)/add_time_score_ms;
							var seconds_left = parseInt(EZGUI.components.seconds_time.text);
							var secondsToSubtract = seconds_left / (add_time_score_ms/16);
							var time_points_gained = 0;
							var addTimePointsTimer = setInterval(function(){
								if(time_points - score_amount_per_cycle >= 0){
									time_points -= score_amount_per_cycle;
									time_points_gained += score_amount_per_cycle;
									showTimePointsGained(parseInt(time_points_gained));
									setPointsGUI(parseInt(parseInt(EZGUI.components.puntaje_counter.text) + score_amount_per_cycle));
									seconds_left -= secondsToSubtract;
									if(seconds_left > 0){
										setSecondsTimerValue(parseInt(seconds_left));
										var perc = (seconds_left * 100) / partida.mp_tiempo_pregunta;
										setTimeBarPercentage(perc);
									}
								}else{
									clearInterval(addTimePointsTimer);
									partida.points += initial_time_points;
									setPointsGUI(partida.points);
									showTimePointsGained(initial_time_points);
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
		showStatusBar(false);
		var general_grupo_text = '';
		var general_puntaje_text = '';
		var general_puntaje_total_text = '';
		
		for(var pos=0;pos<Object.keys(equipos).length;pos++){
			$.each(equipos,function(equipo_id,equipo){
				if(equipo.pos == pos){
					if(equipo_id == partida.equipo.id){
						var grupo_jugadores_text = '';
						var grupo_puntaje_text = '';
						var grupo_puntaje_total_text = '';
						if(equipo.Usuarios != null){
							$.each(equipo.Usuarios,function(usuario_id,usuario){
								grupo_jugadores_text += usuario.apellido + '\n\n';
								if(usuario.preguntas[partida.pregunta_index] != null){
									grupo_puntaje_text += usuario.preguntas[partida.pregunta_index].puntos + '\n\n';
								}else{
									grupo_puntaje_text += 0 + '\n\n';
								}
								grupo_puntaje_total_text += usuario.puntos + '\n\n';
							});
							EZGUI.components.columna_jugadores.settings.text = grupo_jugadores_text; EZGUI.components.columna_jugadores.rebuild();
							EZGUI.components.columna_puntaje_jugadores.settings.text = grupo_puntaje_text; EZGUI.components.columna_puntaje_jugadores.rebuild();
							EZGUI.components.columna_puntaje_total_jugadores.settings.text = grupo_puntaje_total_text;
							EZGUI.components.columna_puntaje_total_jugadores.rebuild();
						}
					}
					general_grupo_text += equipo.nombre + '\n\n';
					if(equipo.preguntas[partida.pregunta_index] != null){
						general_puntaje_text += equipo.preguntas[partida.pregunta_index].puntos + '\n\n';
					}else{
						general_puntaje_text += '0' + '\n\n';
					}
					general_puntaje_total_text += equipo.puntos + '\n\n';
				}
			});
		}
		
		EZGUI.components.columna_grupos.settings.text = general_grupo_text; EZGUI.components.columna_grupos.rebuild();
		EZGUI.components.columna_puntaje_grupos.settings.text = general_puntaje_text; EZGUI.components.columna_puntaje_grupos.rebuild();
		EZGUI.components.columna_puntaje_total_grupos.settings.text = general_puntaje_total_text; EZGUI.components.columna_puntaje_total_grupos.rebuild();
		
		hideAllElements();
		toggleScoreboardGUI(true);
		
		<?php if(isset($own_partida)){ ?>

				if(partida.pregunta_index + 1 <= partida.mp_cantidad_preguntas){
					client_connection_parser.parseData({status: 3, pregunta_index: partida.pregunta_index + 1});
				}

		<?php } ?>
	}
</script>