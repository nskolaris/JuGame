<div class="row">
	<div class="col-sm-12">
		<div class="card-box">
			<h4 class="m-t-0 header-title"><b><?php echo (!empty($this->data)?'Modificar usuario ID '.$this->data['Usuario']['id']:'Agregar nuevo usuario'); ?></b></h4>
			<p class="text-muted m-b-30 font-13">
			</p>
			<div class="row">
				<div class="col-md-12">
					<?php echo $this->Form->create('Usuario',array('class'=>'form-horizontal','role'=>'form','action'=>'agregar')); ?>
					
						<?php echo $this->Form->input('Usuario.id',array('type'=>'hidden')); ?>
						
						<?php if($loggedUser['rol_id']==1){ ?>
							<div class="row" style="margin-bottom:30px">
								<label class="col-sm-2 control-label">Escuela</label>
								<div class="col-sm-8">
									<?php echo $this->Form->input('Usuario.escuela_id',array('label'=>false,'options'=>$escuelas,'class'=>'form-control')); ?>
								</div>
							</div>
						<?php }else{
							echo $this->Form->input('Usuario.escuela_id',array('type'=>'hidden','value'=>$loggedUser['escuela_id']));
						} ?>
						
						<div class="row" style="margin-bottom:30px">
							<label class="col-sm-2 control-label">Rol</label>
							<div class="col-sm-8">
								<?php echo $this->Form->input('Usuario.rol_id',array('label'=>false,'options'=>$roles,'class'=>'form-control')); ?>
							</div>
						</div>
						
						<div class="row" style="margin-bottom:30px">
							<label class="col-sm-2 control-label">E-mail</label>
							<div class="col-sm-8">
								<?php echo $this->Form->input('Usuario.email',array('label'=>false,'class'=>'form-control')); ?>
							</div>
						</div>

						<div class="row" style="margin-bottom:30px">
							<label class="col-sm-2 control-label">Contraseña</label>
							<div class="col-sm-8">
								<?php if(empty($this->data)){ ?>
									<?php echo $this->Form->input('Usuario.password',array('label'=>false,'class'=>'form-control')); ?>
								<?php }else{ ?>
									<button class="btn btn-primary waves-effect waves-light" type="button">Cambiar contraseña</button><br>
								<?php } ?>
								
							</div>
						</div>
						
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
							<label class="col-sm-2 control-label">Género</label>
							<div class="col-sm-8">
								<?php echo $this->Form->input('Usuario.gender',array('label'=>false,'options'=>array('male'=>'Masculino','female'=>'Femenino'),'class'=>'form-control')); ?>
							</div>
						</div>
						
						<?php if(isset($grados)){ ?>
						
						<div class="row" style="margin-bottom:30px">
							<label class="col-sm-2 control-label">Grado</label>
							<div class="col-sm-8">
								<?php echo $this->Form->input('Usuario.grado_id',array('label'=>false,'options'=>$grados,'class'=>'form-control','empty'=>'Seleccione','selected'=>(!empty($this->data['Grado'])?$this->data['Grado'][0]['id']:''))); ?>
							</div>
						</div>
						<?php } ?>
						
						<div class="row">
							<button class="btn btn-success waves-effect waves-light" type="submit">Guardar</button>
						</div>
						
					</form>
					
				</div>
			</div>
		</div>
	</div>
</div>