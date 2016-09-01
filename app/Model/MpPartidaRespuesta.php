<?php
class MpPartidaRespuesta extends AppModel{
	var $name = 'MpPartidaRespuesta';
	var $actsAs = array('Containable');
	
	var $belongsTo = array(
		'Partida' => array(
			'className' => 'Partida',
			'foreignKey' => 'partida_id'
		),
		'Usuario' => array(
			'className' => 'Usuario',
			'foreignKey' => 'usuario_id'
		),
		'MpPregunta' => array(
			'className' => 'MpPregunta',
			'foreignKey' => 'mp_pregunta_id'
		),
		'MpPreguntaOpcion' => array(
			'className' => 'MpPreguntaOpcion',
			'foreignKey' => 'mp_pregunta_opcion_id'
		)
	);
	
	function getRespuestasByPartidaUsuario($partida_id, $usuario_id){
		$respuestas = $this->find('all',array('conditions'=>array('partida_id'=>$partida_id,'usuario_id'=>$usuario_id),'fields'=>array('puntos','puntos_normalizados','pregunta_index'),'recursive'=>-1));
		$data = array();
		foreach($respuestas as $respuesta){
			$data[$respuesta['MpPartidaRespuesta']['pregunta_index']] = $respuesta['MpPartidaRespuesta'];
		}
		return $data;
	}
}