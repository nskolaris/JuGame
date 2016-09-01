<?php
class Escuela extends AppModel{
	var $name = 'Escuela';
	var $actsAs = array('Containable');
	
	var $hasMany = array(
		'Grado' => array(
			'className' => 'Grado',
            'foreignKey' => 'escuela_id'
		)
    );
	
	function getCombo(){
		return $this->find('list',array('fields'=>array('id','nombre')));
	}
	
	function getById($escuela_id){
		$escuela = $this->find('first',array('conditions'=>array('Escuela.id'=>$escuela_id),'contain'=>array('Grado')));
		return $escuela;
	}
	
	function guardar($data){
		$response = array('status'=>false,'message'=>'No se pudo guardar la escuela','error'=>null);
		
		if(!isset($data['Escuela']['id']) || empty($data['Escuela']['id'])){
			$data['Escuela']['codigo'] = md5($data['Escuela']['nombre']);
		}
		
		if($this->save($data)){
			$response['status'] = true;
			$response['message'] = 'LA escuela fué guardada correctamente';
		}else{
			$response['error'] = $this->invalidFields();
		}
		return $response;
	}
	
	function delete($escuela_id = NULL, $cascade = true){
		$this->id = $escuela_id;
		return $this->saveField('deleted',date('Y-m-d h:i:s'));
	}
}