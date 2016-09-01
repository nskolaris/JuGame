<script>
	$('tr.partida td').click(function(){
		console.log($(this).attr('id'));
		if($(this).attr('id') != null){
			
			window.location.href = "<?php echo $this->Html->Url(array('controller'=>'partidas','action'=>'ingresar')); ?>/"+$(this).attr('id');
		}
	});
</script>
<style>
	tr.partida{cursor: pointer;}
</style>
<h1>Lista de partidas disponibles</h1>
<table>
	<tr><th>N°</th><th>Nombre del Juego</th><th>Cantidad de preguntas</th><th>Tiempo por pregunta(segundos)</th><th>Jugadores</th></tr>
	<div class="table-data">
	<?php foreach($partidas as $partida){ ?>
		<a href="<?php echo $this->Html->Url(array('controller'=>'partidas','action'=>'ingresar',$partida['Partida']['id'])); ?>"><tr class="partida" id="<?php echo $partida['Partida']['id']; ?>">
			<td><?php echo $partida['Partida']['id']; ?></td>
			<td><?php echo $partida['Juego']['nombre']; ?></td>
			<td><?php echo $partida['Partida']['mp_cantidad_preguntas']; ?></td>
			<td><?php echo $partida['Partida']['mp_tiempo_pregunta']; ?></td>
			<td><?php echo count($partida['PartidaUsuario']); ?></td>
		</tr></a>
	<?php } ?>
	</div>
</table>