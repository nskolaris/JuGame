<div class="row">
	<div class="col-sm-12">
		<div class="card-box">
			<h4 class="m-t-0 header-title"><b>Lista partidas</b></h4>
			<table class="tablesaw m-t-20 table m-b-0" data-tablesaw-mode="stack">
				<thead>
					<tr>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">Juego</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-sortable-default-col data-tablesaw-priority="3">Estado partida</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">Tiempo por pregunta (en segundos)</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="1">Cantidad de preguntas por partida</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="4">Acciones</th>
					</tr>
				</thead>
				<tbody>
				<?php
					foreach($partidas as $partida)
					{
						echo '<tr>';
						echo '<td>'.$partida['Juego']['nombre'].'</td>';
						echo '<td>'.$partida['PartidaEstado']['descripcion'].'</td>';
						echo '<td>'.$partida['Partida']['mp_tiempo_pregunta'].'</td>';
						echo '<td>'.$partida['Partida']['mp_cantidad_preguntas'].'</td>';
						echo 
							'<td>
								<a href="'.$this->Html->url(array('controller'=>'partidas','action'=>'edit',$partida['Partida']['id'])).'" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
								<a href="'.$this->Html->url(array('controller'=>'partidas','action'=>'crearEquipo',$partida['Partida']['id'])).'" class="on-default remove-row"><i class="fa fa-users"></i></a>
								<a href="'.$this->Html->url(array('controller'=>'partidas','action'=>'gestionar',$partida['Partida']['id'])).'" class="on-default remove-row"><i class="fa fa-play"></i></a>
								<a href="'.$this->Html->url(array('controller'=>'partidas','action'=>'delete',$partida['Partida']['id'])).'" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
							</td>';
						echo '</tr>';
					}
				?>
				</tbody>
			</table>
		</div>
	</div>
</div>