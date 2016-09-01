<div class="row">
	<div class="col-sm-12">
		<div class="card-box">
			<h4 class="m-t-0 header-title"><b>Lista juegos</b></h4>
			<table class="tablesaw m-t-20 table m-b-0" data-tablesaw-mode="stack">
				<thead>
					<tr>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-sortable-default-col data-tablesaw-priority="3">Nombre</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">Cantidad de preguntas relacionadas</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="4">Acciones</th>
					</tr>
				</thead>
				<tbody>
				<?php
					foreach($juegos as $juego){
						echo '<tr>';
						echo '<td>'.$juego['Juego']['nombre'].'</td>';
						echo '<td>'.count($juego['MpPregunta']).'</td>';
						echo 
							'<td>
								<a href="'.$this->Html->url(array('controller'=>'partidas','action'=>'crear_individual',$juego['Juego']['id'])).'" class="on-default edit-row"><i class="fa fa-play-circle"></i></a>
							</td>';
						echo '</tr>';
					}
				?>
				</tbody>
			</table>
		</div>
	</div>
</div>