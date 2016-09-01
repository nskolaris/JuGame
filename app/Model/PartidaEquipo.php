<?php
class PartidaEquipo extends AppModel{
	var $name = 'PartidaEquipo';
	var $useTable = 'partida_equipos';
	var $actsAs = array('Containable');
	
	var $belongsTo = array(
		'Partida' => array(
			'className' => 'Partida',
			'foreignKey' => 'partida_id'
		)
	);
	
	function grabar($data){
		$save = array(
			'partida_id' => $data['PartidaEquipo']['partida_id'],
			'nombre' => $data['PartidaEquipo']['nombre']
		);
		return $this->save($save);
	}
	
	function addPoints($equipo_id, $points, $puntos_normalizados){
		$equipo = $this->find('first',array('conditions'=>array('id'=>$equipo_id),'fields'=>array('id','puntos'),'recursive'=>-1));
		$puntos = $equipo['PartidaEquipo']['puntos'];
		$this->id = $equipo_id;
		$this->saveField('puntos_normalizados', $puntos_normalizados);
		return $this->saveField('puntos',($puntos + $points));
	}
	
	function calculatePoints($equipo_id){
		$usuarios = $this->Partida->PartidaEquiposUsuario->getPartidaUsuarios($equipo_id);
		$puntos = 0;
		$puntos_normalizados = 0;
		foreach($usuarios as $usuario){
			$puntos += $usuario['PartidaUsuario']['puntos'];
			$puntos_normalizados += $usuario['PartidaUsuario']['puntos_normalizados'];
		}
		//$puntos = $puntos / count($usuarios);
		$puntos_normalizados = $puntos_normalizados / count($usuarios);
		$this->id = $equipo_id;
		$this->saveField('puntos',$puntos);
		$this->saveField('puntos_normalizados',$puntos_normalizados);
	}
	
	function getById($id){
		return $this->find('first',array('conditions'=>array('PartidaEquipo.id'=>$id),'recursive'=>-1));
	}
	
	function getAll($partida_id){
		return $this->find('all',array('conditions'=>array('partida_id'=>$partida_id),'recursive'=>-1));
	}
}