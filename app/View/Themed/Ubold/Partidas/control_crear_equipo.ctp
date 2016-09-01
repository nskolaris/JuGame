<style>
.equipos_container{float: left;margin-left: 15px;margin-bottom: 10px;}

.equipo .fa-close{float: right;}
label{margin-right: 10px;}
.color{width: 30px;height: 30px;display: inline-block;margin: 10px;}
.color.selected{border: 5px solid black;}
.usuario p{margin: 5px;}
</style>

<script>

	socket = io('<?php echo $_SERVER['HTTP_HOST']; ?>:8888');

	var getUsuariosTimer;
	var getEquiposTimer;
	var getEquiposUsuariosTimer;

	$(document).ready(function(){
		getUsuarios();
		
		$('.color').click(function(){
			var color = $(this).css('background-color');
			$('#EquipoColor').val(color);
			$('.color').removeClass('selected');
			$(this).addClass('selected');
		});
		
		socket.emit('establishConnection',{usuario_id:<?php echo $usuario['id']; ?>, partida_id: <?php echo $partida_id; ?>, profesor: true});
		
		socket.on('playerList', function(data){
			getUsuarios();
		});
	});

	function getUsuarios(){
		socket.emit('gameDataChanged',{partida_id: <?php echo $partida_id; ?>});
		$.post('<?php echo $this->Html->Url(array('controller'=>'partidas','action'=>'getUsuariosInPartida',$partida_id)); ?>',function(response){
			if(response != 'error'){
				data = JSON.parse(response);
				$('#usuarios .row').empty();
				$.each(data,function(index,usuario){
					usuario = usuario.Usuario;
					var html = '<span class="usuario" id="usuario-'+usuario.id+'"><div class="col-md-8"><a href="javascript:void(0)" class="btn-close"><i class="fa fa-close"></i></a> '+usuario.apellido+' '+usuario.nombre+' <span class="equipo_container"></span></div><div class="col-md-4"><select class="equipos_container"></select></div></span>';
					$('#usuarios .row').append(html);
				});
			}
			$('.usuario .equipos_container').change(function(){
				if($(this).val() != ''){
					var usuario_id = parseInt($(this).closest('.usuario').attr('id').replace('usuario-',''));
					setEquipo(usuario_id, parseInt($(this).val()));
				}
			});
			$('.usuario .btn-close').click(function(){
				var usuario_id = parseInt($(this).closest('.usuario').attr('id').replace('usuario-',''));
				var r = confirm("¿Echar al usuario "+usuario_id+" de la partida?");
				if(r){
					kickUser(usuario_id);
				}
			});
			getDataEquipos();
		});
	}

	var equipos = {};
	
	function getDataEquipos(){
		$.post('<?php echo $this->Html->Url(array('controller'=>'partidas','action'=>'getScoreboard',$partida_id)); ?>',function(response){
			$('#equipos .row').empty();
			data = JSON.parse(response);
			
			var lista_equipos = '<option value="">Seleccione</option>';
			var hay_equipos = false;
			
			$.each(data,function(equipo_id,equipo){
				if(equipo.color != null){
					equipos[equipo.id] = {nombre: equipo.nombre, color: equipo.color, usuarios: {}};
					hay_equipos = true;
					lista_equipos += '<option value="'+equipo_id+'">'+equipo.nombre+'</option>';
				}
			});
			
			$('#usuarios .row .equipos_container').each(function(){
				$(this).empty().append(lista_equipos);
			});
			
			if(hay_equipos){
				$.each(data,function(equipo_id,equipo){
					if(equipo.color != null){
						var lista_usuarios = '<ul></ul>';
						if(equipo.Usuarios != null){
							$.each(equipo.Usuarios,function(index, usuario){
								equipos[equipo.id]['usuarios'][usuario.id] = {id: usuario.id};
								$('#usuarios .row').find('#usuario-'+usuario.id).find('.equipo_container').empty().html('<i class="fa fa-circle" style="color: '+equipo.color+';"></i>');
								$('#usuarios .row').find('#usuario-'+usuario.id).find('.equipos_container').val(equipo.id);
								lista_usuarios += '<li>' + usuario.nombre + ' ' + usuario.apellido + '</li>';
							});
						}
						var style = 'border-color: '+equipo.color+'!important; color: '+equipo.color+'!important;';
						var html = '<div class="col-md-3 equipo" id="equipo-'+equipo_id+'"><div class="panel panel-border panel-danger"><div class="panel-heading" style="'+style+'"><h3 class="panel-title">'+equipo.nombre+'<a href="javascript:void(0)" class="btn-close"><i class="fa fa-close"></i></a></h3></div><div class="panel-body">'+lista_usuarios+'</div></div></div>';
						$('#equipos .row').append(html);
					}
				});
				$('.equipo .btn-close').click(function(){
					var equipo_id = parseInt($(this).closest('.equipo').attr('id').replace('equipo-',''));
					var r = confirm("Borrar al equipo "+equipo_id+" de la partida?");
					if(r){
						deleteTeam(equipo_id);
					}
				});
			}
		});
	}
	
	function setEquipo(usuario_id, equipo_id){
		$.post('<?php echo $this->Html->Url(array('controller'=>'partidas','action'=>'setEquipoUser')); ?>', {partida_id: <?php echo $partida_id; ?>, usuario_id: usuario_id, equipo_id: equipo_id}, function(response){
			if(response == 'ok'){
				getUsuarios();
			}
		});
	}
	
	function saveEquipos(next_page){
		data = {equipos: JSON.stringify(equipos), partida_id: <?php echo $partida_id; ?>};
		$.post('<?php echo $this->Html->Url(array('controller'=>'partidas','action'=>'save_equipos')); ?>',data,function(response){
			document.location = next_page;
		});
	}
	
	function kickUser(usuario_id){
		$.post('<?php echo $this->Html->Url(array('controller'=>'partidas','action'=>'kickUser')); ?>', {partida_id: <?php echo $partida_id; ?>, usuario_id: usuario_id}, function(response){
			if(response == 'ok'){
				getUsuarios();
			}
		});
	}
	
	function deleteTeam(equipo_id){
		$.post('<?php echo $this->Html->Url(array('controller'=>'partidas','action'=>'deleteTeam')); ?>', {partida_id: <?php echo $partida_id; ?>, equipo_id: equipo_id}, function(response){
			if(response == 'ok'){
				getUsuarios();
			}
		});
	}

	function crearEquipo(){
		if($('#EquipoNombre').val() != '' && $('#EquipoColor').val() != ''){
			$.post('<?php echo $this->Html->Url(array('controller'=>'partidas','action'=>'createTeam')); ?>', {partida_id: <?php echo $partida_id; ?>, nombre: $('#EquipoNombre').val(), color: $('#EquipoColor').val()}, function(response){
				if(response == 'ok'){
					getUsuarios();
				}
			});
		}
	}
</script>
<div class="row">
	<div class="col-sm-12">
		<div class="card-box">
			<h4 class="m-t-0 header-title"><b>Crear equipo</b></h4>
			<p class="text-muted m-b-30 font-13">
			</p>
			<?php
				echo $this->Form->create('PartidaEquipo',array('class'=>'form-horizontal','role'=>'form'));
			?>
				<div class="row">
					<div class="col-md-3">
						<div class="card-box" id="usuarios">
							<h4 class="m-t-0 header-title"><b>Usuarios</b></h4>
							<p class="text-muted m-b-30 font-13">
							</p>
							<div class="row"></div>
						</div>
					</div>
					<div class="col-md-9">
						<div class="card-box" id="equipos">
							<h4 class="m-t-0 header-title"><b>Equipos</b></h4>
							<p class="text-muted m-b-30 font-13"></p>
							<div class="row">
							</div>
							<button class="btn btn-primary waves-effect waves-light" type="button" data-toggle="modal" data-target="#custom-width-modal">Crear Equipo</button>
						</div>
					</div>
				</div>
				<div class="row">
					<input name="data[proximaPagina]" value="" id="proximaPagina" type="hidden" />
					<button class="btn btn-success waves-effect waves-light" onclick="saveEquipos('<?php echo $this->Html->Url(array('controller'=>'partidas','action'=>'gestionar',$partida_id)); ?>');" type="button" style="float:right;margin-right:30px">Proximo</button>
					<button class="btn btn-white waves-effect waves-light" onclick="saveEquipos('<?php echo $this->Html->Url(array('controller'=>'partidas','action'=>'index')); ?>');" type="button" style="float:right;margin-right:10px">Grabar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div id="custom-width-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog" style="width:55%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="custom-width-modalLabel">Nuevo equipo</h4>
			</div>
			<div class="modal-body">
				<?php echo $this->Form->input('Equipo.nombre',array('label'=>'Nombre')); ?>
				<div class="input text"><label for="EquipoColor">Color</label><input name="data[Equipo][color]" id="EquipoColor" type="hidden">
					<?php foreach($colores as $color){ ?>
						<a href="javascript:void(0)" class="color" style="background-color: <?php echo $color; ?>;"></a>
					<?php } ?>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-success waves-effect waves-light" onclick="crearEquipo();" type="button" data-dismiss="modal">Guardar</button>
				<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>