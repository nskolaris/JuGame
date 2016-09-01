<?php
class JuegosController extends AppController{
	
	function index(){
		$this->set('juegos', $this->Juego->find('all',array('contain'=>array('MpPregunta'=>array('id'),'CategoriaJuego'=>array('nombre')),'fields'=>array('Juego.nombre'))));
	}
	
	//Funciones Control

	function control_index(){
		$this->set('juegos', $this->Juego->find('all',array('contain'=>array('MpPregunta'=>array('id'),'CategoriaJuego'=>array('nombre')),'fields'=>array('Juego.nombre'))));
	}
	
	function control_add(){
		if(!empty($this->data)){
			$response = $this->Juego->guardar($this->data);
			$this->Session->setFlash($response['message'],'customFlash');
			if($response['status']){
				$this->redirect(array('controller'=>'juegos','action'=>'index'));
			}
		}
		$this->set('preguntas',$this->Juego->MpPregunta->getCombo());
		$this->set('categorias',$this->Juego->CategoriaJuego->getCombo());
		$this->view = 'add';
	}
	
	function control_edit($juego_id){
		$this->data = $this->Juego->getById($juego_id);
		$this->set('preguntas',$this->Juego->MpPregunta->getCombo());
		$this->set('categorias',$this->Juego->CategoriaJuego->getCombo());
		$this->view = 'add';
	}
	
	function control_delete($juego_id){
		echo $this->Juego->delete($juego_id);
		$this->redirect(array('controller'=>'juegos','action'=>'index'));
	}
	
	//Funciones Director
	
	/*function director_index(){
		$this->set('juegos', $this->Juego->find('all',array('contain'=>array('MpPregunta'=>array('id'),'CategoriaJuego'=>array('nombre')),'fields'=>array('Juego.nombre'))));
		$this->view = 'control_index';
	}
	
	function director_add(){
		if(!empty($this->data)){
			$response = $this->Juego->guardar($this->data);
			$this->Session->setFlash($response['message'],'customFlash');
			if($response['status']){
				$this->redirect(array('controller'=>'juegos','action'=>'index'));
			}
		}
		$this->set('preguntas',$this->Juego->MpPregunta->getCombo());
		$this->set('categorias',$this->Juego->CategoriaJuego->getCombo());
		$this->view = 'add';
	}
	
	function director_edit($juego_id){
		$this->data = $this->Juego->getById($juego_id);
		$this->set('preguntas',$this->Juego->MpPregunta->getCombo());
		$this->set('categorias',$this->Juego->CategoriaJuego->getCombo());
		$this->view = 'add';
	}
	
	function director_delete($juego_id){
		echo $this->Juego->delete($juego_id);
		$this->redirect(array('controller'=>'juegos','action'=>'index','director'=>true));
	}*/
}