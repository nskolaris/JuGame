<?php
class Grado extends AppModel{
	var $name = 'Grado';
	var $actsAs = array('Containable');
	
	var $belongsTo = array(
		'CicloLectivo' => array(
			'className' => 'CicloLectivo',
			'foreignKey' => 'ciclo_lectivo_id'
		),
		'Escuela' => array(
			'className' => 'Escuela',
			'foreignKey' => 'escuela_id'
		)
	);
	
	var $hasAndBelongsToMany = array(
        'Usuario' => array(
			'className' => 'Usuario',
			'joinTable' => 'grados_usuarios',
			'foreignKey' => 'grado_id',
			'associationForeignKey' => 'usuario_id'
		)
    );
	
	function getById($id){
		return $this->find('first',array('conditions'=>array('Grado.id'=>$id)));
	}
	
	function getAll(){
		$ciclo_activo = $this->CicloLectivo->getCicloActivo();
		$grados = $this->find('all',array(
			'conditions'=>	array('Grado.ciclo_lectivo_id'=>$ciclo_activo),
			'contain'=>		array('Usuario'=>array('id'),'Escuela'),
			'fields'=>		array('id','ano','division')
		));
		return $grados;
	}
	
	function getGradosByEscuelaId($escuela_id){
		$ciclo_activo = $this->CicloLectivo->getCicloActivo();
		$grados = $this->find('all',array(
			'conditions'=>	array('Grado.escuela_id'=>$escuela_id,'Grado.ciclo_lectivo_id'=>$ciclo_activo),
			'contain'=>		array('Usuario'=>array('id')),
			'fields'=>		array('id','ano','division')
		));
		return $grados;
	}
	
	function getComboByEscuelaId($escuela_id){
		$ciclo_activo = $this->CicloLectivo->getCicloActivo();
		$grados = $this->find('all',array(
			'conditions'=>	array('Grado.escuela_id'=>$escuela_id,'Grado.ciclo_lectivo_id'=>$ciclo_activo),'recursive'=>-1,'fields'=>array('id','ano','division')
		));
		$combo = array();
		foreach($grados as $grado){
			$combo[$grado['Grado']['id']] = $grado['Grado']['ano'].'°'.$grado['Grado']['division'];
		}
		return $combo;
	}
	
	function guardar($data){
		$response = array('status'=>false,'message'=>'No se pudo guardar el grado','errors'=>null);

		if($this->save($data)){
			$response['status'] = true;
			$response['message'] = 'El grado fue guardado con éxito';
		}else{
			$response['errors'] = $this->invalidFields;
		}
		return $response;
	}
}