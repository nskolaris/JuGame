<?php
class EscuelasController extends AppController{
	
	//Funciones Control

	function control_index(){
		$this->set('escuelas', $this->Escuela->find('all',array('contain'=>array())));
		$this->view = 'index';
	}
	
	function control_add(){
		if(!empty($this->data)){
			$response = $this->Escuela->guardar($this->data);
			$this->Session->setFlash($response['message'],'customFlash');
			if($response['status']){
				$this->redirect(array('controller'=>'juegos','action'=>'index'));
			}
		}
		$this->view = 'add';
	}
	
	function control_edit($juego_id){
		$this->data = $this->Escuela->getById($juego_id);
		$this->view = 'add';
	}
	
	function control_delete($juego_id){
		echo $this->Escuela->delete($juego_id);
		$this->redirect(array('controller'=>'escuelas','action'=>'index'));
	}
}