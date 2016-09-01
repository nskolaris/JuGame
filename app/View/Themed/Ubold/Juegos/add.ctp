<script>
	function addPregunta(){
		html = '<div class="form-group" id="new_pregunta"><div class="col-md-10"><input class="form-control" placeholder="Texto Pregunta"></div><div class="col-md-2"><button type="button" class="btn btn-white waves-effect" onClick="confirmPregunta()">Agregar</button></div></div>';
		$('.preguntas').append(html);
	}
	
	function confirmPregunta(){
		if($('#new_pregunta input').val() != ''){
			$.post(
				'<?php echo $this->Html->Url(array('controller'=>'mp_preguntas','action'=>'add')); ?>',
				{juego_id:<?php echo $this->data['Juego']['id']; ?>,texto:$('#new_pregunta input').val()}, 
				function(response){
					response = JSON.parse(response);
					if(response.status){
						$('#new_pregunta').remove();
						html = '<div class="pregunta" id="pregunta-'+response.MpPregunta.id+'">'+response.MpPregunta.texto+'<br><br><div class="opciones"></div><br><button class="btn btn-white waves-effect waves-light" type="button" onClick="addOpcion('+response.MpPregunta.id+');">Agregar Opción</button><button class="btn btn-white waves-effect waves-light" type="button" onClick="deletePregunta('+response.MpPregunta.id+');">Borrar Pregunta</button></div><br><br>';
						$('.preguntas').append(html);
					}
				}
			);
		}
	}
	
	function deletePregunta(pregunta_id){
		$.post('<?php echo $this->Html->Url(array('controller'=>'mp_preguntas','action'=>'delete')); ?>/'+pregunta_id,function(response){
			if(response=='ok'){
				$('#pregunta-'+pregunta_id).remove();
			}else{
				alert(response);
			}
		});
	}
	
	function addOpcion(pregunta_id){
		html = '<div id="new_opcion">';
		html += '<div class="form-group"><div class="col-md-6"><input class="form-control texto" placeholder="Texto Opción"></div></div>';
		html += '<div class="form-group"><div class="col-md-6"><textarea class="form-control comentario" placeholder="Texto Seleccionada"/></div></div>';
		html += '<div class="form-group"><div class="col-md-6"><div class="checkbox checkbox-primary"><input class="es_correcta" type="checkbox"><label> Es correcta?</label></div></div></div>';
		html += '<div class="form-group"><div class="col-md-6"><input class="form-control puntos" placeholder="Puntos opción"></div></div>';
		html += '<div class="form-group"><div class="col-md-2"><button type="button" class="btn btn-white waves-effect" onClick="confirmOpcion('+pregunta_id+')">Agregar</button></div></div>';

		$('#pregunta-'+pregunta_id+' .opciones').append(html);
	}
	
	function confirmOpcion(pregunta_id){
		if($('#new_opcion input.text').val() != ''){
			data = {
				mp_pregunta_id:pregunta_id,
				texto:$('#new_opcion input.texto').val(),
				comentario:$('#new_opcion textarea.comentario').val(),
				es_correcta:$('#new_opcion input.es_correcta').is(":checked"),
				puntos:$('#new_opcion input.puntos').val(),
			};
			$.post(
				'<?php echo $this->Html->Url(array('controller'=>'mp_preguntas','action'=>'add_opcion')); ?>',data,function(response){
					response = JSON.parse(response);
					if(response.status){
						$('#new_opcion').remove();
						css = 'class="opcion"';
						if(response.MpPreguntaOpcion.es_correcta==1){
							css = 'class="opcion correcta"';
						}
						html = '<div '+css+' id="opcion-'+response.MpPreguntaOpcion.id+'">'+response.MpPreguntaOpcion.texto+'<button class="btn btn-white waves-effect waves-light" type="button" onClick="deleteOpcion('+response.MpPreguntaOpcion.id+');">Borrar Opcion</button></div><br>';
						$('#pregunta-'+pregunta_id+' .opciones').append(html);
					}
				}
			);
		}
	}
	
	function changeCorrectOption(opcion_id){
		$('#opcion-'+opcion_id+' .check').prop('disabled', true);
		$.post('<?php echo $this->Html->Url(array('controller'=>'mp_preguntas','action'=>'set_opcion_correcta')); ?>',{opcion_id:opcion_id,es_correcta: $('#opcion-'+opcion_id+' .check').is(":checked")},function(response){
			$('#opcion-'+opcion_id+' .check').prop('disabled', false);
			if(response=='ok'){
				if($('#opcion-'+opcion_id+' .check').is(":checked")){
					$('#opcion-'+opcion_id).addClass('correcta');
				}else{
					$('#opcion-'+opcion_id).removeClass('correcta');
				}
			}else{
				if($('#opcion-'+opcion_id+' .check').is(":checked")){
					$('#opcion-'+opcion_id+' .check').prop("checked", false);
				}else{
					$('#opcion-'+opcion_id+' .check').prop("checked", true);
				}
			}
		});
	}
	
	function deleteOpcion(opcion_id){
		$.post('<?php echo $this->Html->Url(array('controller'=>'mp_preguntas','action'=>'delete_opcion')); ?>/'+opcion_id,function(response){
			if(response=='ok'){
				$('#opcion-'+opcion_id).remove();
			}else{
				alert(response);
			}
		});
	}
</script>
<style>
	.opcion{}
	.opcion.correcta{color:green;font-weight:bold;}
</style>
<div class="row">
	<div class="col-sm-12">
		<div class="card-box">
			<h4 class="m-t-0 header-title"><b><?php echo (!empty($this->data)?'Modificar juego ID '.$this->data['Juego']['id']:'Crear juego'); ?></b></h4>
			<p class="text-muted m-b-30 font-13"></p>
			<div class="row">
				<div class="col-md-12">
					<?php echo $this->Form->create('Juego',array('class'=>'form-horizontal','role'=>'form','action'=>'add')); ?>
						<?php echo $this->Form->input('Juego.id',array('type'=>'hidden')); ?>
						<div class="row" style="margin-bottom:30px">
							<label for="Juego.nombre" class="col-sm-2 control-label"><b>Nombre</b></label>
							<div class="col-sm-8">
								<?php echo $this->Form->input('Juego.nombre',array('label'=>false,'type'=>'text')); ?>
							</div>
						</div>
						<div class="row" style="margin-bottom:30px">
							<label for="Juego.nombre" class="col-sm-2 control-label"><b>Contenido</b></label>
							<div class="col-sm-8">
								<?php echo $this->Form->input('Juego.contenido',array('label'=>false,'type'=>'textarea')); ?>
							</div>
						</div>
						<div class="row" style="margin-bottom:30px">
							<label for="Juego.nombre" class="col-sm-2 control-label"><b>Categoria</b></label>
							<div class="col-sm-8">
								<?php echo $this->Form->input('Juego.categoria_id',array('label'=>false,'options'=>$categorias,'empty'=>'Seleccione')); ?>
							</div>
						</div>
						<div class="row" style="margin-bottom:30px">
							<label for="Juego.nombre" class="col-sm-2 control-label"><b>Lista de preguntas</b></label>
							<div class="col-sm-8">
								<?php echo $this->Form->input('MpPregunta.MpPregunta',array('label'=>false,'multiple'=>'multiple','type'=>'select','options'=>$preguntas)); ?>
							</div>
						</div>
						
						
						<h2>Lista de preguntas</h2>
						
						<?php if(!empty($this->data)){ ?><div class="preguntas">
							
							<?php foreach($this->data['MpPregunta'] as $pregunta){ ?>
								<div class="pregunta" id="pregunta-<?php echo $pregunta['id']; ?>">
									<?php echo $pregunta['texto']; ?><br><br>
									<div class="opciones">
										<?php foreach($pregunta['MpPreguntaOpcion'] as $opcion){ ?>
											<div class="opcion<?php echo ($opcion['es_correcta']==1?' correcta':''); ?>" id="opcion-<?php echo $opcion['id']; ?>">
												<?php echo $opcion['texto']; ?>
												<input class="check" type="checkbox" <?php echo ($opcion['es_correcta']==1?'checked':''); ?> onClick="changeCorrectOption(<?php echo $opcion['id']; ?>);">
												<button class="btn btn-white waves-effect waves-light" type="button" onClick="deleteOpcion(<?php echo $opcion['id']; ?>);">Borrar Opcion</button>
											</div><br>
										<?php } ?>
									</div><br>
									<button class="btn btn-white waves-effect waves-light" type="button" onClick="addOpcion(<?php echo $pregunta['id']; ?>);">Agregar Opción</button>
									<button class="btn btn-white waves-effect waves-light" type="button" onClick="deletePregunta(<?php echo $pregunta['id']; ?>);">Borrar Pregunta</button>
								</div><br><br>
								
							<?php } ?>

						</div><?php } ?>
						
						<button class="btn btn-white waves-effect waves-light" type="button" onClick="addPregunta();">Agregar Pregunta</button>
						
						<div class="row">
							<button class="btn btn-white waves-effect waves-light" type="submit" style="float:right;margin-right:10px">Guardar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>