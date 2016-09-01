<?php
class MpPreguntaOpcion extends AppModel{
	var $name = 'MpPreguntaOpcion';
	var $useTable = 'mp_pregunta_opciones';
	
	function getById($opcion_id){
		return $this->find('first',array('conditions'=>array('id'=>$opcion_id)));
	}
	
	function agregar($data){
		$response = array('status'=>false,'message'=>'La opción no pudo ser agregada','error'=>null,'MpPreguntaOpcion'=>null);
		if($this->save($data)){
			$response['status'] = true;
			$response['message'] = 'La opción fue agregada con éxito';
			$response['MpPreguntaOpcion'] = $data['MpPreguntaOpcion'];
			$response['MpPreguntaOpcion']['id'] = $this->id;
		}else{
			$response['error'] = $this->invalidFields;
		}
		return $response;
	}
	
	function borrar($opcion_id, $perma = true){
		if(!$perma){
			$this->id = $opcion_id;
			return $this->saveField('deleted',date('Y-m-d'));
		}else{
			return $this->delete($opcion_id,true);
		}
	}
}