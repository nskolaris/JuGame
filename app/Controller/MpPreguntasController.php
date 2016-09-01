<?php
class MpPreguntasController extends AppController{
	public $uses = array('MpPregunta');
	
	function control_index(){
		debug($this->data);
		
		if(!empty($this->data['file']))
		{
			debug($file);
		}
	}
	
	function control_add(){
		if(!empty($_POST)){
			$data = array('MpPregunta'=>array('texto'=>$_POST['texto'],'mp_pregunta_tipo_id'=>1));
			$response = $this->MpPregunta->agregar($data);
			if($response['status'] && isset($_POST['juego_id'])){
				App::import('Model','Juego');
				$this->Juego = new Juego();
				$this->Juego->id = $_POST['juego_id'];
				$preguntas_ids = $this->Juego->getPreguntasIdById($_POST['juego_id']);
				$preguntas_ids[] = $response['MpPregunta']['id'];
				$this->Juego->save(array('MpPregunta'=>array('MpPregunta'=>array($preguntas_ids))));
			}
			echo json_encode($response);
		}
		exit;
	}
	
	function control_delete($pregunta_id){
		if($this->MpPregunta->borrar($pregunta_id)){
			echo 'ok'; exit;
		}
		echo 'error';
		exit;
	}
	
	function control_add_opcion(){
		if(!empty($_POST)){
			$data = array('MpPreguntaOpcion'=>array(
				'mp_pregunta_id'=>$_POST['mp_pregunta_id'],
				'texto'=>$_POST['texto'],
				'es_correcta'=>($_POST['es_correcta']=='true'?1:0),
				'puntos'=>$_POST['puntos'],
				'comentario'=>$_POST['comentario']
			));
			$response = $this->MpPregunta->MpPreguntaOpcion->agregar($data);
			echo json_encode($response);
		}
		exit;
	}
	
	function control_set_opcion_correcta(){
		if(isset($_POST['opcion_id'])){
			$this->MpPregunta->MpPreguntaOpcion->id = $_POST['opcion_id'];
			if($this->MpPregunta->MpPreguntaOpcion->saveField('es_correcta',($_POST['es_correcta']=='true'?1:0))){
				echo 'ok'; exit;
			}
		}
		echo 'error'; exit;
	}
	
	function control_delete_opcion($opcion_id){
		if($this->MpPregunta->MpPreguntaOpcion->borrar($opcion_id)){
			echo 'ok'; exit;
		}
		echo 'error';
		exit;
	}
}