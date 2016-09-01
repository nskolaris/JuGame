<div class="row">
	<div class="col-sm-12">
		<div class="card-box">
			<h4 class="m-t-0 header-title"><b><?php echo (!empty($this->data)?'Modificar escuela ID '.$this->data['Escuela']['id']:'Registrar nuevo escuela'); ?></b></h4>
			<p class="text-muted m-b-30 font-13"></p>
			<div class="row">
				<div class="col-md-12">
					<?php echo $this->Form->create('Escuela',array('class'=>'form-horizontal','role'=>'form','action'=>'add')); ?>
						<?php echo $this->Form->input('Escuela.id',array('type'=>'hidden')); ?>
						<div class="row" style="margin-bottom:30px">
							<label for="Escuela.nombre" class="col-sm-2 control-label"><b>Nombre</b></label>
							<div class="col-sm-8">
								<?php echo $this->Form->input('Escuela.nombre',array('label'=>false,'type'=>'text')); ?>
							</div>
						</div>
						<div class="row">
							<button class="btn btn-white waves-effect waves-light" type="submit" style="float:right;margin-right:10px">Guardar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>