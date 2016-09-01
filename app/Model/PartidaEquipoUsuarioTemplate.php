<?php
class PartidaEquipoUsuarioTemplate extends AppModel{
	var $name = 'PartidaEquipoUsuarioTemplate';
	var $useTable = 'partida_equipos_usuarios_templates';
	
	function getByNombreGradoCategoria($equipo_nombre, $grado_id, $categoria_id){
		return $this->find('all',array('conditions'=>array('equipo_nombre'=>$equipo_nombre, 'grado_id'=>$grado_id, 'categoria_id'=>$categoria_id)));
	}
	
	function guardar($data){
		$this->deleteAll(array('grado_id'=>$data['grado_id'],'categoria_id'=>$data['categoria_id']));
		foreach($data['equipos'] as $equipo){
			foreach($equipo['usuarios'] as $usuario){
				$this->create();
				$this->save(array(
					'grado_id'=>$data['grado_id'],
					'usuario_id'=>$usuario['id'],
					'categoria_id'=>$data['categoria_id'],
					'equipo_nombre'=>$equipo['nombre'],
					'equipo_color'=>$equipo['color']
				));
			}
		}
	}
}