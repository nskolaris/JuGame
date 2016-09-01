<div class="row">
	<div class="col-sm-12">
		<div class="card-box">
			<h4 class="m-t-0 header-title"><b>Lista de escuelas</b></h4>
			<table class="tablesaw m-t-20 table m-b-0" data-tablesaw-mode="stack">
				<thead>
					<tr>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">ID</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-sortable-default-col data-tablesaw-priority="3">Nombre</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="5">Código</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="4">Acciones</th>
					</tr>
				</thead>
				<tbody>
				<?php
					foreach($escuelas as $escuela){
						echo '<tr>';
						echo '<td>'.$escuela['Escuela']['id'].'</td>';
						echo '<td>'.$escuela['Escuela']['nombre'].'</td>';
						echo '<td>'.$escuela['Escuela']['codigo'].'</td>';
						echo 
							'<td>
								<a href="'.$this->Html->url(array('controller'=>'escuelas','action'=>'edit',$escuela['Escuela']['id'])).'" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
							</td>';
						echo '</tr>';
					}
				?>
				</tbody>
			</table>
		</div>
	</div>
</div>