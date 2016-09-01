<script>
	$(document).ready(function(){
		$('tbody tr').click(function(){
			if($(this).attr('id') != null){
				window.location.href = "<?php echo $this->Html->Url(array('controller'=>'partidas','action'=>'ingresar')); ?>/"+$(this).attr('id');
			}
		});
	});
	
</script>
<style>
	tbody tr{cursor: pointer;}
	tbody tr:hover{background-color: #BFBFBF;}
</style>
<div class="row">
	<div class="col-sm-12">
		<div class="card-box">
			<h4 class="m-t-0 header-title"><b>Listado de partidas disponibles</b></h4>
			<table class="tablesaw m-t-20 table m-b-0" data-tablesaw-mode="stack"><thead>
				<tr>
					<th scope="col" data-tablesaw-sortable-col>N°</th>
					<th scope="col" data-tablesaw-sortable-col>Nombre del Juego</th>
					<th scope="col" data-tablesaw-sortable-col>Cantidad de preguntas</th>
					<th scope="col" data-tablesaw-sortable-col>Tiempo por pregunta (segundos)</th>
					<th scope="col" data-tablesaw-sortable-col>Jugadores</th>
				</tr>
			</thead><tbody>
				<?php foreach($partidas as $partida){ ?>
					<tr id="<?php echo $partida['Partida']['id']; ?>">
						<td><?php echo $partida['Partida']['id']; ?></td>
						<td><?php echo $partida['Juego']['nombre']; ?></td>
						<td><?php echo $partida['Partida']['mp_cantidad_preguntas']; ?></td>
						<td><?php echo $partida['Partida']['mp_tiempo_pregunta']; ?></td>
						<td><?php echo count($partida['PartidaUsuario']); ?></td>
					</tr>
				<?php } ?>
			</tbody></table>
		</div>
	</div>
</div>