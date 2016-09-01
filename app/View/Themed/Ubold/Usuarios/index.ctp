<div class="row">
	<div class="col-sm-12">
		<div class="card-box">
			<h4 class="m-t-0 header-title"><b>Lista usuarios</b></h4>
			<table class="tablesaw m-t-20 table m-b-0" data-tablesaw-mode="stack">
				<thead>
					<tr>
						<th scope="col" data-tablesaw-sortable-col>ID</th>
						<th scope="col" data-tablesaw-sortable-col>Nombre</th>
						<th scope="col" data-tablesaw-sortable-col>Apellido</th>
						<th scope="col" data-tablesaw-sortable-col>E-mail</th>
						<th scope="col" data-tablesaw-sortable-col>Rol</th>
						<th scope="col" data-tablesaw-sortable-col>Acciones</th>
					</tr>
				</thead>
				<tbody>
				<?php
					foreach($usuarios as $usuario){
						echo '<tr>';
						echo '<td>'.$usuario['Usuario']['id'].'</td>';
						echo '<td>'.$usuario['Usuario']['nombre'].'</td>';
						echo '<td>'.$usuario['Usuario']['apellido'].'</td>';
						echo '<td>'.$usuario['Usuario']['email'].'</td>';
						echo '<td>'.$usuario['Rol']['descripcion'].'</td>';
						echo 
							'<td>
								<a href="'.$this->Html->url(array('controller'=>'usuarios','action'=>'ver',$usuario['Usuario']['id'])).'" class="on-default edit-row"><i class="fa fa-search"></i></a>
								<a href="'.$this->Html->url(array('controller'=>'usuarios','action'=>'modificar',$usuario['Usuario']['id'])).'" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
								<a href="'.$this->Html->url(array('controller'=>'usuarios','action'=>'borrar',$usuario['Usuario']['id'])).'" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
							</td>';
						echo '</tr>';
					}
				?>
				</tbody>
			</table>
		</div>
	</div>
</div>