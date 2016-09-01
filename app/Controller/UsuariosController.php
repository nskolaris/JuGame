<?php
class UsuariosController extends AppController {
	public $uses = array('Usuario');
	
	function login(){
		$this->layout = 'login';
		$this->logout();
		if(!empty($this->data['Usuario']['email'])){
			if($user = $this->Usuario->login($this->data['Usuario']['email'],$this->data['Usuario']['password'])){
				$this->registerLogin($user);
				$this->redirectPorRol();
			}
		}
	}
	function AjaxLogin(){
		$this->autoRender = false;

		$usuario = $this->request->data;
		if(!empty($usuario['user']) && !empty($usuario['pass']))
		{
			if($user = $this->Usuario->login($usuario['user'], $usuario['pass']))
			{
				$this->registerLogin($user);
				$part = $this->Usuario->PartidaUsuario->getPartidaIdByUserId($this->loggedUser['id']);
				$datos = array( 'user' => $user, 'partida' => $part);
		 		echo json_encode($datos);
		 		exit;
			}
			else
			{
				echo json_encode(1);
				exit;
			}
		}/*
		else{

			echo json_encode(2);
			exit;
		}
*/
		
	}
	function control_login(){
		$this->redirect(array('controller'=>'usuarios','action'=>'login','control'=>false));
	}

	function modificar(){
		if(!empty($this->data)){
			$data = $this->data;
			$data['Usuario']['id'] = $this->loggedUser['id'];
			if($this->Usuario->save($data)){
				$this->registerLogin($this->Usuario->getById($this->loggedUser['id']));
				$this->Session->setFlash('Datos modificados','customFlash');
			}else{
				$this->Session->setFlash('No se pudo guardar los datos','customFlash');
			}
		}
		$usuario = $this->Usuario->getById($this->loggedUser['id']);
		$this->data = $usuario;
		$this->set('avatares',$this->Usuario->Avatar->getCombo());
	}
	
	
	//Funciones Administrador
	
	function control_index(){
		if(isset($this->loggedUser['escuela_id'])){
			$this->set('usuarios',$this->Usuario->getUsuariosByEscuelaId($this->loggedUser['escuela_id'],$this->loggedUser['rol_level']));
		}else{
			$this->set('usuarios',$this->Usuario->getAll());
		}
		$this->view = 'index';
	}
	
	function control_ver($usuario_id){
		$this->data = $this->Usuario->getById($usuario_id);
		$this->view = 'ver';
	}
	
	function control_agregar(){
		if(!empty($this->data)){
			$data = $this->data;
			$data['Usuario']['usuario_creador_id'] = $this->loggedUser['id'];
			$response = $this->Usuario->guardar($data);
			$this->Session->setFlash($response['message'],'customFlash');
			if($response['status']){
				$this->redirect(array('controller'=>'usuarios','action'=>'index'));
			}else{
				$this->set('errors',$response['errors']);
			}
		}
		
		$this->set('roles',$this->Usuario->Rol->getCombo());
		
		if(!isset($this->loggedUser['escuela_id'])){
			$this->set('escuelas',$this->Usuario->Escuela->getCombo());
		}else{
			$this->set('grados',$this->Usuario->Grado->getComboByEscuelaId($this->loggedUser['escuela_id']));
		}
		
		$this->view = 'agregar';
	}
	
	function control_modificar($usuario_id){
		$this->data = $this->Usuario->getById($usuario_id);
		$this->set('roles',$this->Usuario->Rol->getCombo());
		if(!isset($this->loggedUser['escuela_id'])){
			$this->set('escuelas',$this->Usuario->Escuela->getCombo());
		}else{
			$this->set('grados',$this->Usuario->Grado->getComboByEscuelaId($this->loggedUser['escuela_id']));
		}
		$this->view = 'agregar';
	}
	
	function control_borrar($usuario_id){

	}
}