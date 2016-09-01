<h1><?php echo $usuario['Usuario']['nombre'].' '.$usuario['Usuario']['apellido']; ?></h1>
Partidas jugadas: <?php echo count($usuario['PartidaUsuario']); ?><br>
Nota promedio partidas: <?php $suma = 0; foreach($usuario['PartidaUsuario'] as $partida){$suma += $partida['puntos_normalizados'];} $suma = $suma/count($usuario['PartidaUsuario']); echo $suma; ?><br>
<?php var_dump($usuario); ?>