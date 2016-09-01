<script>

	$(document).ready(function(){
		getScoreboard();
	});

	function getScoreboard(){
		
		var cantidad_preguntas = <?php echo $this->data['Partida']['mp_cantidad_preguntas']; ?>;
		
		data = JSON.parse('<?php echo json_encode($scoreboard); ?>');
		
		var html = '<tr><th>Jugador / N° Pregunta</th>';
		html += '<?php for($i=1;$i<=$this->data['Partida']['mp_cantidad_preguntas'];$i++){echo '<th class="pregunta pregunta-'.$i.'">'.$i.'</th>';} ?><th>Total</th>';
		
		for(var pos=0;pos<Object.keys(data).length;pos++){
			$.each(data,function(equipo_id,equipo){
				if(equipo.pos == pos){
					
					html += '<tr class="equipo-'+equipo_id+' equipo-nombre" style="background-color: '+equipo.color+';">';
					html += '<td>'+equipo.nombre+'</td>';
					
					for(var i = 1; i <= cantidad_preguntas; i++){
						html += '<td class="pregunta pregunta-'+i+'">';
						if(equipo.preguntas[i] != null){
							html += equipo.preguntas[i].puntos;
						}else{
							html += '';
						}
						html += '</td>';
					}
					

					html += '<td>'+equipo.puntos+' ('+equipo.puntos_normalizados+')</td></tr>';

					
					if(equipo.Usuarios != null){
												
						$.each(equipo.Usuarios,function(index, usuario){

							function_url = "window.location = '<?php echo $this->Html->Url(array('controller'=>'usuarios','action'=>'ver')); ?>/"+usuario.id+"';";
						
							html += '<tr class="equipo-'+equipo_id+' jugador" id="jugador_'+usuario.id+'"><td class="nombre-jugador" onClick="'+function_url+'">'+usuario.nombre+' '+usuario.apellido+'</td>';
							
							for(var i = 1; i <= cantidad_preguntas; i++){
								html += '<td class="pregunta pregunta-'+i+'">';
								if(usuario.preguntas[i] != null){
									html += usuario.preguntas[i].puntos;
								}else{
									html += '';
								}
								html += '</td>';
							}
							

							html += '<td>'+usuario.puntos+' ('+usuario.puntos_normalizados+')</td></tr>';
							
							
						});
					}
				}
			});
		}
		$('#scoreboard').html(html);
	}

</script>
<style>
	#scoreboard .equipo-nombre{font-weight: bold;}
	#scoreboard tr{background-opacity: 0.5;}
	#scoreboard td{color: black;}
	#scoreboard td.nombre-jugador{cursor: pointer; color: #1e1e6c; font-weight: bold;}
	.acciones button{font-size: 22px;}
</style>
<div class="row">
	<div class="col-sm-12">
		<div class="card-box">
			<h4 class="m-t-0 header-title"><b><?php echo 'Historial partida ID '.$this->data['Partida']['id']; ?></b></h4>
			<p class="text-muted m-b-30 font-13">
			</p>
			<div class="row">
				<div class="col-md-12">
					<table id="scoreboard" class="table"></table>
				</div>
			</div>
		</div>
	</div>
</div>