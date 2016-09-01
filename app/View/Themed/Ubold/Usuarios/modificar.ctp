<script>
	var avatares = JSON.parse('<?php echo json_encode($avatares); ?>');

	$(document).ready(function(){
		
	});
	
	function selectAvatar(id){
		$('#UsuarioAvatarId').val(id);
		$('.user-avatar').attr('src','<?php echo $this->webroot.'img/avatars/'; ?>'+avatares[id]);
	}
</script>

<div class="row">
	<div class="col-sm-12">
		<div class="card-box">
			<h4 class="m-t-0 header-title"><b>Modificar perfil</b></h4>
			<p class="text-muted m-b-30 font-13">
			</p>
			<div class="row">
				<div class="col-md-12">
					<?php echo $this->Form->create('Usuario',array('class'=>'form-horizontal','role'=>'form','action'=>'modificar')); ?>
						<div class="row" style="margin-bottom:30px">
							<label class="col-sm-2 control-label">Nombre</label>
							<div class="col-sm-8">
								<?php echo $this->Form->input('Usuario.nombre',array('label'=>false,'class'=>'form-control')); ?>
							</div>
						</div>
						<div class="row" style="margin-bottom:30px">
							<label class="col-sm-2 control-label">Apellido</label>
							<div class="col-sm-8">
								<?php echo $this->Form->input('Usuario.apellido',array('label'=>false,'class'=>'form-control')); ?>
							</div>
						</div>
						<div class="row" style="margin-bottom:30px">
							<label for="mp_cantidad_preguntas" class="col-sm-2 control-label"><b>Imagen de perfil</b></label>
							<div class="col-sm-8">
								<?php echo $this->Form->input('Usuario.avatar_id',array('label'=>false,'type'=>'hidden','class'=>'form-control')); ?>
								<img class="user-avatar" src="<?php echo $this->webroot.'img/avatars/'.$this->data['Avatar']['filename']; ?>"/><br><br>
								<button class="btn btn-primary waves-effect waves-light" type="button" data-toggle="modal" data-target="#custom-width-modal">Seleccionar avatar</button>
							</div>
						</div>
						<div class="row">
							<button class="btn btn-success waves-effect waves-light" type="submit" style="float:right;margin-right:30px">Guardar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="custom-width-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog" style="width:55%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="custom-width-modalLabel">Avatares disponibles</h4>
			</div>
			<div class="modal-body">
				<?php foreach($avatares as $id => $filename){ ?>
					<a data-dismiss="modal" onClick="selectAvatar(<?php echo $id; ?>);" href="javascript:void(0);" class="avatar" style="background-image: url('<?php echo $this->webroot.'img/avatars/'.$filename; ?>')"></a>
				<?php } ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

<style>
	.avatar{
		width: 77px;
		height: 77px;
		display: inline-block;
		margin: 10px;
	}
</style>