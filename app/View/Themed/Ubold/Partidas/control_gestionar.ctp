<?php echo $this->Html->script('game_objects'); ?>
<script>

	socket = io('192.168.3.249:8888');

	$(document).ready(function(){
		socket.emit('establishConnection',{usuario_id:<?php echo $usuario['id']; ?>, partida_id: <?php echo $this->data['Partida']['id']; ?>, profesor: true});
		
		socket.on('userAnswer', function(data){
			if(getScoreboardTimer != null){
				window.clearTimeout(getScoreboardTimer);
			}
			getScoreboardTimer = setTimeout(getScoreboard,2500);
		});
		
		socket.on('userStatus', function(data){
			usuarios[data.usuario_id].estado = data.status;
			$('#jugador_'+data.usuario_id+' .estado').html(data.status);
		});

		socket.on('playerList', function(data){
			var get_scoreboard = false;
			if(usuarios != {}){
				if(Object.keys(data.playerList).length != Object.keys(usuarios).length){
					get_scoreboard = true;
				}
			}
			usuarios = data.playerList;
			if(get_scoreboard){
				if(getScoreboardTimer != null){
					window.clearTimeout(getScoreboardTimer);
				}
				getScoreboardTimer = setTimeout(getScoreboard,2500);
			}else{manageConnectedPlayers();}
		});
		
		
		openPartida();
		getScoreboard();
	});
	
	var usuarios = {};
	function manageConnectedPlayers(){
		var usersOnline = 0;
		$.each(usuarios,function(usuario_id,usuario){
			usersOnline ++;
			if(usuario.status == 'online'){
				$('#jugador_'+usuario_id+' .fa-circle').removeClass('offline').removeClass('disconnected').addClass('online');
			}else{
				$('#jugador_'+usuario_id+' .fa-circle').removeClass('online').removeClass('disconnected').addClass('offline');
			}
			$('#jugador_'+usuario_id+' .estado').html(usuario.estado);
		});
		$('#users_online').text(usersOnline+'/'+registeredPlayers);
	}
	
	function openPartida(){
		$.post(
			'<?php echo $this->Html->Url(array('controller'=>'partidas','action'=>'setPartidaData',$this->data['Partida']['id'])); ?>',{partida_estado_id: 1},
			function(response){
				toggleLectura(true);
				cambiarEstado(1);
			}
		);
	}
	
	function endPartida(){
		$.post(
			'<?php echo $this->Html->Url(array('controller'=>'partidas','action'=>'setPartidaData',$this->data['Partida']['id'])); ?>',{partida_estado_id: 5},
			function(response){
				cambiarEstado(5);
			}
		);
	}
	
	var seconds_before_start = 5;
	function comenzarPartida(){
		$.post(
			'<?php echo $this->Html->Url(array('controller'=>'partidas','action'=>'setPartidaData',$this->data['Partida']['id'])); ?>',
			{partida_estado_id: 2},
			function(response){
				toggleLectura(false);
				cambiarEstado(2);
				seconds_timer.start(seconds_before_start,function(){
					mostrarPregunta(1);
				},function(seconds_left){
					$('#acciones_2 .tiempo').text(seconds_left);
				});
			}
		);
	}
	
	var tiempo_por_pregunta = <?php echo $this->data['Partida']['mp_tiempo_pregunta']; ?>;
	var current_pregunta_index = 1;
	var cantidad_preguntas = <?php echo $this->data['Partida']['mp_cantidad_preguntas']; ?>;
	
	function mostrarPregunta(id){
		seconds_timer.stop();
		$.post(
			'<?php echo $this->Html->Url(array('controller'=>'partidas','action'=>'setPartidaData',$this->data['Partida']['id'])); ?>',
			{pregunta_activa_id: id, partida_estado_id: 3},
			function(response){
				cambiarEstado(3);
				seconds_timer.start(tiempo_por_pregunta,function(){
					//mostrarResultados();
				},function(seconds_left){
					$('#acciones_3 .time_left').text(seconds_left);
				});
			}
		);
	}
	
	function nextPregunta(){
		current_pregunta_index++;
		mostrarPregunta(current_pregunta_index);
	}
	
	function mostrarResultados(){
		seconds_timer.stop();
		$.post(
			'<?php echo $this->Html->Url(array('controller'=>'partidas','action'=>'setPartidaData',$this->data['Partida']['id'])); ?>',
			{partida_estado_id: 4},
			function(response){
				cambiarEstado(4);
			}
		);
	}
	
	var partida_estado;
	
	function cambiarEstado(estado){
		partida_estado = estado;
		var estados = JSON.parse('<?php echo json_encode($estados); ?>');
		
		$('#estado').html(estados[estado]);
		$('.acciones').hide();
		$('#acciones_'+estado).show();
		
		socket.emit('statusChange', {status: estado});
		
		switch(estado){
			case 1:
			break;
			case 2:

			break;
			case 3:
				$('#pregunta_activa_index').text(current_pregunta_index);
				$('#scoreboard .pregunta').removeClass('activa');
				$('#scoreboard .pregunta-'+current_pregunta_index).addClass('activa');
			break;
			case 4:
				if(current_pregunta_index == cantidad_preguntas){
					$('#btn-siguiente-pregunta').hide();
					$('#btn-end').show();
					toggleLectura(true);
				}else{
					$('#btn-siguiente-pregunta').show();
					$('#btn-end').hide();
				}
			break;
			case 5:
			break;
		}
	}
	
	function resetPartida(){
		seconds_timer.stop();
		$.post('<?php echo $this->Html->Url(array('controller'=>'partidas','action'=>'reset',$this->data['Partida']['id'])); ?>',function(response){
			toggleLectura(true);
			cambiarEstado(1);
			current_pregunta_index = 1;
			$('#pregunta_activa_index').text(current_pregunta_index);
			getScoreboard();
		});
	}
	
	function resendStatus(){
		socket.emit('statusChange', {status: partida_estado});
	}
	
	var getScoreboardTimer;
	var usersRespondieron;
	var registeredPlayers;
	
	function getScoreboard(){
		$.post('<?php echo $this->Html->Url(array('controller'=>'partidas','action'=>'getScoreboard',$this->data['Partida']['id'])); ?>',function(response){
			data = JSON.parse(response);
			var html = '<tr><th>Jugador / N° Pregunta</th>';
			html += '<?php for($i=1;$i<=$this->data['Partida']['mp_cantidad_preguntas'];$i++){echo '<th class="pregunta pregunta-'.$i.'">'.$i.'</th>';} ?><th>Total</th>';
			usersRespondieron = 0;
			registeredPlayers = 0;
			for(var pos=0;pos<Object.keys(data).length;pos++){
				$.each(data,function(equipo_id,equipo){
					if(equipo.pos == pos){
						
						html += '<tr class="equipo-'+equipo_id+' equipo-nombre" style="background-color: '+equipo.color+';">';
						html += '<td>'+equipo.nombre+'</td>';
						
						for(var i = 1; i <= cantidad_preguntas; i++){
							html += '<td class="pregunta pregunta-'+i+'">';
							if(equipo.preguntas[i] != null){
								html += equipo.preguntas[i].puntos;
							}else{
								html += '';
							}
							html += '</td>';
						}
						
						if(current_pregunta_index == cantidad_preguntas){
							html += '<td>'+equipo.puntos+' ('+equipo.puntos_normalizados+')</td></tr>';
						}else{
							html += '<td>'+equipo.puntos+'</td></tr>';
						}
						
						if(equipo.Usuarios != null){
							$.each(equipo.Usuarios,function(index, usuario){
								
								registeredPlayers ++;
							
								html += '<tr class="equipo-'+equipo_id+' jugador" id="jugador_'+usuario.id+'"><td>'+usuario.nombre+' '+usuario.apellido;
								html += '  <i class="fa fa-circle disconnected"></i><span class="estado"></span>';
								html += '</td>';
								
								for(var i = 1; i <= cantidad_preguntas; i++){
									html += '<td class="pregunta pregunta-'+i+'">';
									if(usuario.preguntas[i] != null){
										if(i == current_pregunta_index){
											usersRespondieron ++;
										}
										html += usuario.preguntas[i].puntos;
									}else{
										html += '';
									}
									html += '</td>';
								}
								
								if(current_pregunta_index == cantidad_preguntas){
									html += '<td>'+usuario.puntos+' ('+usuario.puntos_normalizados+')</td></tr>';
								}else{
									html += '<td>'+usuario.puntos+'</td></tr>';
								}
								
							});
						}
					}
				});
			}
			$('#scoreboard').html(html);
			$('#scoreboard .pregunta-'+current_pregunta_index).addClass('activa');
			$('#acciones_3 .respondieron').text(usersRespondieron+'/'+registeredPlayers);
			manageConnectedPlayers();
			getScoreboardTimer = null;
		});
	}
	
	function toggleLectura(state){
		if(state){
			state = 1;
		}else{
			state = 0;
		}
		$.post('<?php echo $this->Html->Url(array('controller'=>'partidas','action'=>'setPartidaData',$this->data['Partida']['id'])); ?>', {contenido_disponible: state}, function(response){
			if(state){
				$('#btn-lectura').html('Deshabilitar Lectura').removeClass('btn-success').addClass('btn-danger').attr('onClick','toggleLectura(false); socket.emit("statusChange", {status: partida_estado});');
			}else{
				$('#btn-lectura').html('Habilitar Lectura').removeClass('btn-danger').addClass('btn-success').attr('onClick','toggleLectura(true); socket.emit("statusChange", {status: partida_estado});');
			}
			
		});
	}
</script>
<style>
	#scoreboard .pregunta.activa{background-color: rgba(255, 255, 0, 0.5);}
	#scoreboard .equipo-nombre{font-weight: bold;}
	#scoreboard tr{background-opacity: 0.5;}
	#scoreboard td{color: black;}
	.acciones button{font-size: 22px;}
	tr.jugador .fa-circle.online{color: #04FF00;}
	tr.jugador .fa-circle.offline{color: #707070;}
	tr.jugador .fa-circle.disconnected{opacity: 0;}
	tr.jugador .estado{float: right;}
</style>
<div class="row">
	<div class="col-sm-12">
		<div class="card-box">
			<h4 class="m-t-0 header-title"><b><?php echo 'Gestionando partida ID '.$this->data['Partida']['id']; ?></b></h4>
			<p class="text-muted m-b-30 font-13">
			</p>
			<div class="row">
				<div class="col-md-12">
				
					<button type="button" class="btn btn-primary waves-effect waves-light" onClick="window.location = '<?php echo $this->Html->Url(array('controller'=>'partidas','action'=>'crearEquipo',$this->data['Partida']['id'])); ?>';">Gestionar equipos</button><br>
				
					<div class="row">
						<div class="col-lg-4 col-sm-6">
							<div class="widget-panel widget-style-2 bg-white">
								<i class="fa fa-info text-primary"></i>
								<h2 class="m-0 text-dark counter font-600"><span id="estado"></span></h2>
								<div class="text-muted m-t-5">Estado</div>
							</div>
						</div>
						<div class="col-lg-4 col-sm-6">
							<div class="widget-panel widget-style-2 bg-white">
								<i class="fa fa-tablet text-primary"></i>
								<h2 class="m-0 text-dark counter font-600"><span id="users_online"></span></h2>
								<div class="text-muted m-t-5">Usuarios conectados</div>
							</div>
						</div>
						<div class="col-lg-4 col-sm-6">
							<div class="widget-panel widget-style-2 bg-white">
								<i class="fa fa-question text-primary"></i>
								<h2 class="m-0 text-dark counter font-600"><span id="pregunta_activa_index">1</span>/<?php echo $this->data['Partida']['mp_cantidad_preguntas']; ?></h2>
								<div class="text-muted m-t-5">Pregunta activa</div>
							</div>
						</div>
					</div>
					<?php if($this->data['Partida']['contenido_disponible']){ ?>
						<br><button type="button" class="btn btn-danger waves-effect waves-light" id="btn-lectura" onClick="toggleLectura(false); socket.emit('statusChange', {status: partida_estado});">Deshabilitar Lectura</button>
					<?php }else{ ?>
						<br><button type="button" class="btn btn-success waves-effect waves-light" id="btn-lectura" onClick="toggleLectura(true); socket.emit('statusChange', {status: partida_estado});">Habilitar Lectura</button>
					<?php } ?>
					<div id="acciones_1" class="acciones">
						<br><button type="button" class="btn btn-default waves-effect waves-light" onClick="comenzarPartida();">Comenzar partida</button>
					</div>
					<div id="acciones_2" class="acciones">
						<br><button type="button" class="btn btn-danger waves-effect waves-light">Comenzando partida en <span class="tiempo"></span> segundos...</button>
					</div>
					<div id="acciones_3" class="acciones">
						<br><button type="button" class="btn btn-default waves-effect waves-light" onClick="mostrarResultados();">Avanzar a resultados pregunta</button>
						<div class="row">
							<div class="col-lg-3 col-sm-6">
								<div class="widget-panel widget-style-2 bg-white">
									<i class="fa fa-clock-o text-primary"></i>
									<h2 class="m-0 text-dark counter font-600"><span class="time_left"></span></h2>
									<div class="text-muted m-t-5">Tiempo restante</div>
								</div>
							</div>
							<div class="col-lg-3 col-sm-6">
								<div class="widget-panel widget-style-2 bg-white">
									<i class="fa fa-users text-primary"></i>
									<h2 class="m-0 text-dark counter font-600"><span class="respondieron"></span></h2>
									<div class="text-muted m-t-5">Respondieron</div>
								</div>
							</div>
						</div>
					</div>
					<div id="acciones_4" class="acciones">
						<br><button type="button" class="btn btn-default waves-effect waves-light" onClick="nextPregunta();" id="btn-siguiente-pregunta">Siguiente pregunta</button>
						<br><button type="button" class="btn btn-default waves-effect waves-light" onClick="endPartida();" id="btn-end">Terminar partida</button>
					</div>
					
					<br><br><table id="scoreboard" class="table"></table>
					
					<br><button type="button" class="btn btn-danger waves-effect waves-light" onClick="resendStatus();">Reenviar estado</button>
					<button type="button" class="btn btn-danger waves-effect waves-light" onClick="resetPartida();">Reiniciar partida</button>
				</div>
			</div>
		</div>
	</div>
</div>