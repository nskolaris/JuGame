<?php
class MpPregunta extends AppModel{
	var $name = 'MpPregunta';
	var $actsAs = array('Containable');
	
	var $belongsTo = array(
		'MpPreguntaTipo' => array(
			'className' => 'MpPreguntaTipo',
			'foreignKey' => 'mp_pregunta_tipo_id'
		)
	);
	
	var $hasMany = array(
        'MpPreguntaOpcion' => array(
            'className' => 'MpPreguntaOpcion',
            'foreignKey' => 'mp_pregunta_id'
        )
    );

	function getCombo(){
		return $this->find('list',array('fields'=>array('id','texto')));
	}
	
	function agregar($data){
		$response = array('status'=>false,'message'=>'La pregunta no pudo ser agregada','error'=>null,'MpPregunta'=>null);
		if($this->save($data)){
			$response['status'] = true;
			$response['message'] = 'La pregunta fue agregada con éxito';
			$response['MpPregunta'] = $data['MpPregunta'];
			$response['MpPregunta']['id'] = $this->id;
		}else{
			$response['error'] = $this->invalidFields;
		}
		return $response;
	}
	
	function borrar($pregunta_id, $perma = true){
		if(!$perma){
			$this->id = $pregunta_id;
			return $this->saveField('deleted',date('Y-m-d'));
		}else{
			return $this->delete($pregunta_id,true);
		}
	}
}