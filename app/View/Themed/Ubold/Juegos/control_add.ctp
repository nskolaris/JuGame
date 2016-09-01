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
							<label for="Juego.nombre" class="col-sm-2 control-label"><b>Lista de preguntas</b></label>
							<div class="col-sm-8">
								<?php echo $this->Form->input('MpPregunta.MpPregunta',array('label'=>false,'multiple'=>'multiple','type'=>'select','options'=>$preguntas)); ?>
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