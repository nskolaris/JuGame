<div class="row">
	<div class="col-sm-12">
		<div class="card-box">
			<h4 class="m-t-0 header-title"><b><?php echo (!empty($this->data)?'Modificar grado ID '.$this->data['Grado']['id']:'Agregar nuevo grado'); ?></b></h4>
			<p class="text-muted m-b-30 font-13">
			</p>
			<div class="row">
				<div class="col-md-12">
					<?php echo $this->Form->create('Grado',array('class'=>'form-horizontal','role'=>'form','action'=>'agregar')); ?>
					
						<?php echo $this->Form->input('Grado.id',array('type'=>'hidden')); ?>
						<?php echo $this->Form->input('Grado.ciclo_lectivo_id',array('type'=>'hidden','value'=>(empty($this->data)?$ciclo_lectivo_id:$this->data['Grado']['ciclo_lectivo_id']))); ?>
						
						<?php if($loggedUser['rol_id']==1){ ?>
							<div class="row" style="margin-bottom:30px">
								<label class="col-sm-2 control-label">Escuela</label>
								<div class="col-sm-8">
									<?php echo $this->Form->input('Grado.escuela_id',array('label'=>false,'options'=>$escuelas,'class'=>'form-control')); ?>
								</div>
							</div>
						<?php }else{
							echo $this->Form->input('Grado.escuela_id',array('type'=>'hidden','value'=>$loggedUser['escuela_id']));
						} ?>
						
						
						<div class="row" style="margin-bottom:30px">
							<label class="col-sm-2 control-label">Año</label>
							<div class="col-sm-8">
								<?php echo $this->Form->input('Grado.ano',array('label'=>false,'class'=>'form-control')); ?>
							</div>
						</div>
						
						<div class="row" style="margin-bottom:30px">
							<label class="col-sm-2 control-label">División</label>
							<div class="col-sm-8">
								<?php echo $this->Form->input('Grado.division',array('label'=>false,'class'=>'form-control')); ?>
							</div>
						</div>
						
						<div class="row">
							<button class="btn btn-success waves-effect waves-light" type="submit">Guardar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>