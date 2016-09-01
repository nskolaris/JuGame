<?php
class GradosController extends AppController {
	public $uses = array('Grado');

	function control_index(){
		if(isset($this->loggedUser['escuela_id'])){
			$this->set('grados',$this->Grado->getGradosByEscuelaId($this->loggedUser['escuela_id']));
		}else{
			$this->set('grados',$this->Grado->getAll());
		}
		$this->view = 'index';
	}
	
	function control_agregar(){
		if(!empty($this->data)){
			$data = $this->data;
			$response = $this->Grado->guardar($data);
			$this->Session->setFlash($response['message'],'customFlash');
			if($response['status']){
				$this->redirect(array('controller'=>'grados','action'=>'index'));
			}else{
				$this->set('errors',$response['errors']);
			}
		}
		$this->set('ciclo_lectivo_id',$this->Grado->CicloLectivo->getCicloActivo());
		
		if(!isset($this->loggedUser['escuela_id'])){
			$this->set('escuelas',$this->Usuario->Escuela->getCombo());
		}
		
		$this->view = 'agregar';
	}
	
	function control_modificar($usuario_id){
		$this->data = $this->Grado->getById($usuario_id);
		$this->set('escuelas',$this->Usuario->Escuela->getCombo());
		$this->view = 'agregar';
	}
	
	function control_borrar($usuario_id){

	}
}