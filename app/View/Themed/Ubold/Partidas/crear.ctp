<script>
var cantidad_preguntas_juegos = {};

<?php $juegosOptions = array(); ?>

$(document).ready(function () {
	<?php foreach($juegos as $juego){ $juegosOptions[$juego['Juego']['id']] = $juego['Juego']['nombre'];
		echo 'cantidad_preguntas_juegos['.$juego['Juego']['id'].'] = '.count($juego['MpPregunta']).';';
	} ?>

	$("#cantidadPreguntasSlider").ionRangeSlider({
        min: 1,
        max: 5,
		step: 1
    });
	
	$("#tiempoPreguntasSlider").ionRangeSlider({
        min: 30,
        max: 120,
		step: 30
    });
	
	loadJuego();
	
	$('#PartidaJuegoId').change(loadJuego);
});

function loadJuego(){
	var juego_id = $('#PartidaJuegoId').val();
	var slider = $("#cantidadPreguntasSlider").data("ionRangeSlider");
	slider.update({
        max: cantidad_preguntas_juegos[juego_id],
    });
}

</script>
<div class="row">
	<div class="col-sm-12">
		<div class="card-box">
			<h4 class="m-t-0 header-title"><b><?php echo (!empty($this->data)?'Modificar partida ID '.$this->data['Partida']['id']:'Crear partida'); ?></b></h4>
			<p class="text-muted m-b-30 font-13">
			</p>
			<div class="row">
				<div class="col-md-12">
					<?php echo $this->Form->create('Partida',array('class'=>'form-horizontal','role'=>'form','action'=>'crear')); ?>
						<?php echo $this->Form->input('Partida.id',array('type'=>'hidden')); ?>
						<div class="row" style="margin-bottom:30px">
							<label class="col-sm-2 control-label">Selecioná el juego</label>
							<div class="col-sm-8">
								<?php echo $this->Form->input('Partida.juego_id',array('label'=>false,'options'=>$juegosOptions,'class'=>'form-control'))?>
							</div>
						</div>
						<div class="row" style="margin-bottom:30px">
							<label class="col-sm-2 control-label">Selecioná el grado que va a participar</label>
							<div class="col-sm-8">
								<?php echo $this->Form->input('Partida.grado_id',array('label'=>false,'options'=>$grados,'class'=>'form-control'))?>
							</div>
						</div>
						<div class="row" style="margin-bottom:30px">
							<label for="mp_cantidad_preguntas" class="col-sm-2 control-label"><b>Cantidad preguntas</b></label>
							<div class="col-sm-8">
								<?php echo $this->Form->input('Partida.mp_cantidad_preguntas',array('id'=>'cantidadPreguntasSlider','type'=>'text','label'=>false)); ?>
							</div>
						</div>
						<div class="row" style="margin-bottom:30px">
							<label for="mp_tiempo_pregunta" class="col-sm-2 control-label"><b>Tiempo preguntas</b><span class="font-normal text-muted f-s-12 clearfix">Segundos</span></label>
							<div class="col-sm-8">
								<?php echo $this->Form->input('Partida.mp_tiempo_pregunta',array('id'=>'tiempoPreguntasSlider','type'=>'text','label'=>false)); ?>
							</div>
						</div>
						<div class="row">
							<input name="data[proximaPagina]" value="" id="proximaPagina" type="hidden" />
							<button class="btn btn-success waves-effect waves-light" onclick="setProximaPagina(1)" type="submit" style="float:right;margin-right:30px">Proximo</button>
							<button class="btn btn-white waves-effect waves-light" onclick="setProximaPagina(0)" type="submit" style="float:right;margin-right:10px">Grabar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
function setProximaPagina(val){
	document.getElementById("proximaPagina").value=val;
}
</script>