<?php
class PartidaUsuario extends AppModel{
	var $name = 'PartidaUsuario';
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
		'Rol' => array(
			'className' => 'Rol',
			'foreignKey' => 'rol_id'
		)
	);
	
	function getAll($partida_id){
		return $this->find('all',array('conditions'=>array('partida_id'=>$partida_id),'recursive'=>-1));
	}
	
	function getPartidaIdByUserId($usuario_id){
		if($partida = $this->find('first',array('conditions'=>array('PartidaUsuario.usuario_id'=>$usuario_id,'Partida.partida_estado_id >'=>0,'Partida.partida_estado_id <'=>5),'fields'=>array('id','partida_id'),'contain'=>array('Partida'),'order'=>'PartidaUsuario.id DESC'))){
			//$this->id = $partida['PartidaUsuario']['id'];
			//$this->saveField('last_connection',date('Y-m-d h:i:s'));
			return $partida['PartidaUsuario']['partida_id'];
		}elseif($partida = $this->find('first',array('conditions'=>array('PartidaUsuario.usuario_id'=>$usuario_id,'Partida.usuario_creador_id'=>$usuario_id,'Partida.partida_estado_id <'=>5),'fields'=>array('id','partida_id'),'contain'=>array('Partida'),'order'=>'PartidaUsuario.id DESC'))){
			return $partida['PartidaUsuario']['partida_id'];
		}
		return false;
	}
	
	function getByUserId($usuario_id){
		return $this->find('first',array('conditions'=>array('usuario_id'=>$usuario_id),'recursive'=>-1,'order'=>'id DESC'));
	}
	
	function getPointsByUserId($usuario_id){
		$usuario = $this->find('first',array('conditions'=>array('usuario_id'=>$usuario_id),'fields'=>array('puntos'),'recursive'=>-1));
		return $usuario['PartidaUsuario']['puntos'];
	}
	
	function calculatePoints($usuario_id, $partida_id){
		$data = $this->find('first',array('conditions'=>array('usuario_id'=>$usuario_id,'partida_id'=>$partida_id),'fields'=>array('id'),'recursive'=>-1));
		$respuestas = $this->Partida->MpPartidaRespuesta->getRespuestasByPartidaUsuario($partida_id, $usuario_id);
		$puntos = 0;
		$puntos_normalizados = 0;
		foreach($respuestas as $respuesta){
			$puntos += $respuesta['puntos'];
			$puntos_normalizados += $respuesta['puntos_normalizados'];
		}
		$puntos_normalizados = $puntos_normalizados / count($respuestas);
		$this->id = $data['PartidaUsuario']['id'];
		$this->saveField('puntos',$puntos);
		$this->saveField('puntos_normalizados',$puntos_normalizados);
		
		$equipo_ids = $this->Partida->PartidaEquiposUsuario->getEquipoIds($usuario_id, $partida_id);
		foreach($equipo_ids as $equipo_id){
			$this->Partida->PartidaEquipo->calculatePoints($equipo_id);
		}
	}
}