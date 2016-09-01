<?php
class PartidaEquiposUsuario extends AppModel{
	var $name = 'PartidaEquiposUsuario';
	var $actsAs = array('Containable');
	
	var $belongsTo = array(
		'Partida' => array(
			'className' => 'Partida',
			'foreignKey' => 'partida_id'
		),
		'PartidaEquipo' => array(
			'className' => 'PartidaEquipo',
			'foreignKey' => 'equipo_id'
		),
		'Usuario' => array(
			'className' => 'Usuario',
			'foreignKey' => 'usuario_id'
		)
	);
	
	function getByUsuarioId($usuario_id){
		$data = $this->find('first',array(
			'conditions'=>array('PartidaEquiposUsuario.usuario_id'=>$usuario_id),
			'fields'=>array('equipo_id'),
			'contain'=>array('PartidaEquipo'=>array('id','nombre'))
		));
		
		if(isset($data['PartidaEquipo'])){
			$usuarios = $this->find('all',array(
				'conditions'=>array('PartidaEquiposUsuario.equipo_id'=>$data['PartidaEquipo']['id']),
				'fields'=>array('usuario_id'),
				'contain'=>array('Usuario'=>array('nombre','apellido'))
			));
			
			$equipo = array('nombre'=>$data['PartidaEquipo']['nombre'],'integrantes'=>array(),'id'=>$data['PartidaEquipo']['id']);
			foreach($usuarios as $usuario){
				$equipo['integrantes'][$usuario['Usuario']['id']] = $usuario['Usuario'];
			}
			
			return $equipo;
		}
		return false;
	}
	
	function getByUsuarioPartidaId($usuario_id, $partida_id){
		$data = $this->find('first',array(
			'conditions'=>array('PartidaEquiposUsuario.usuario_id'=>$usuario_id,'PartidaEquiposUsuario.partida_id'=>$partida_id,),
			'fields'=>array('equipo_id'),
			'contain'=>array('PartidaEquipo'=>array('id','nombre','color'))
		));
		
		if(isset($data['PartidaEquipo'])){
			$usuarios = $this->find('all',array(
				'conditions'=>array('PartidaEquiposUsuario.equipo_id'=>$data['PartidaEquipo']['id']),
				'fields'=>array('usuario_id'),
				'contain'=>array('Usuario'=>array('nombre','apellido','Avatar'=>array('filename')))
			));
			
			$equipo = array('id'=>$data['PartidaEquipo']['id'],'nombre'=>$data['PartidaEquipo']['nombre'],'color'=>$data['PartidaEquipo']['color'],'integrantes'=>array());
			foreach($usuarios as $usuario){
				$equipo['integrantes'][$usuario['Usuario']['id']] = $usuario['Usuario'];
			}
			
			return $equipo;
		}
		return false;
	}
	
	function getEquipoIds($usuario_id, $partida_id){
		return $this->find('list',array('conditions'=>array('usuario_id'=>$usuario_id, 'partida_id'=>$partida_id),'fields'=>array('equipo_id')));
	}
	
	function getPartidaUsuarios($equipo_id){
		$data = $this->find('all',array('conditions'=>array('PartidaEquiposUsuario.equipo_id'=>$equipo_id),'recursive'=>-1));
		$usuarios = array();
		foreach($data as $dat){
			$usuarios[$dat['PartidaEquiposUsuario']['usuario_id']] = $this->Partida->PartidaUsuario->find('first',array('conditions'=>array('partida_id'=>$dat['PartidaEquiposUsuario']['partida_id'],'usuario_id'=>$dat['PartidaEquiposUsuario']['usuario_id'])));
		}
		return $usuarios;
	}

	function agregar($usuario_id, $equipo_id){
		if($equipo = $this->PartidaEquipo->getById($equipo_id)){
			$existe = $this->find('first',array('conditions'=>array('partida_id'=>$equipo['PartidaEquipo']['partida_id'],'usuario_id'=>$usuario_id),'recursive'=>-1));
			if($existe){
				$this->id = $existe['PartidaEquiposUsuario']['id'];
			}else{
				$this->create();
			}
			$data = array(
				'partida_id' => $equipo['PartidaEquipo']['partida_id'],
				'equipo_id' => $equipo_id,
				'usuario_id' => $usuario_id,
			);
			return $this->save($data);
		}
		return false;
	}
}