<div class="row">
	<div class="col-sm-12">
		<div class="card-box">
			<h4 class="m-t-0 header-title"><b>Lista grados</b></h4>
			<table class="tablesaw m-t-20 table m-b-0" data-tablesaw-mode="stack">
				<thead>
					<tr>
						<th scope="col" data-tablesaw-sortable-col>ID</th>
						<th scope="col" data-tablesaw-sortable-col>Año</th>
						<th scope="col" data-tablesaw-sortable-col>División</th>
						<th scope="col" data-tablesaw-sortable-col>Cantidad de alumnos</th>
						<th scope="col" data-tablesaw-sortable-col>Acciones</th>
					</tr>
				</thead>
				<tbody>
				<?php
					foreach($grados as $grado){
						echo '<tr>';
						echo '<td>'.$grado['Grado']['id'].'</td>';
						echo '<td>'.$grado['Grado']['ano'].'</td>';
						echo '<td>'.$grado['Grado']['division'].'</td>';
						echo '<td>'.count($grado['Usuario']).'</td>';
						echo 
							'<td>
								<a href="'.$this->Html->url(array('controller'=>'grados','action'=>'modificar',$grado['Grado']['id'])).'" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
								<a href="'.$this->Html->url(array('controller'=>'grados','action'=>'borrar',$grado['Grado']['id'])).'" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
							</td>';
						echo '</tr>';
					}
				?>
				</tbody>
			</table>
		</div>
	</div>
</div>