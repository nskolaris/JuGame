<?php
 header("Access-Control-Allow-Origin: *");
App::uses('Controller', 'Controller');
class AppController extends Controller{
	public $uses = array();
	public $helpers = array();

	var $loggedUser = null;
	
	function beforeFilter(){
		parent::beforeFilter();
		$this->theme = 'ubold';
		$this->layout = 'frontend';
		$allowed_actions = array('login','control_login','getPartidaStatus', 'Ajaxlogin');
		if(!in_array($this->request->params['action'],$allowed_actions)){
			if($this->checkLogin()){
				$this->set('loggedUser',$this->loggedUser);
				$this->setLayout();
				if($this->params['prefix'] != null){
					$this->managePrefix($this->params['prefix']);
				}
			}else{
				$this->Session->write('attempted_url',$this->params->url);
				$this->redirect(array('controller'=>'usuarios','action'=>'login','control'=>false));
			}
		}
	}
	
	function managePrefix($prefix){
		switch($prefix){
			case 'control':
				if(!$this->checkControl()){
					$this->redirectPorRol();
				}
			break;
			case 'director' :
				if(!$this->checkRoleLevel(20)){
					$this->redirectPorRol();
				}
			break;
		}
	}
	
	function logout(){
		$this->Session->write('loggedUser',null);
	}
	
	function registerLogin($user){
		$user['Usuario']['avatar'] = $user['Avatar']['filename'];
		$user['Usuario']['rol_level'] = $user['Rol']['level'];
		$this->Session->write('loggedUser',$user['Usuario']);
		$this->loggedUser = $user['Usuario'];
	}
	
	function checkLogin(){
		$this->loggedUser = $this->Session->read('loggedUser');
		$this->set('usuario',$this->loggedUser);
		if(empty($this->loggedUser)){
			return false;
		}
		return true;
	}
	
	function checkControl(){
		return in_array($this->loggedUser['rol_id'],array(1,2,4));
	}
	
	function checkRoleLevel($level){
		return ($this->loggedUser['rol_level'] >= $level);
	}
	
	function setLayout(){
		switch($this->loggedUser['rol_id']){
			case 1:
				$this->layout = 'backend';
			break;
			case 2:
				$this->layout = 'frontend_profesor';
			break;
			case 3:
				$this->layout = 'frontend';
			break;
			case 4:
				$this->layout = 'frontend_director';
			break;
		}
	}
	
	function redirectPorRol(){
		switch($this->loggedUser['rol_id']){
			case 1:
				$this->redirect(array('controller'=>'partidas','action'=>'index','control'=>true));
			break;
			case 2:
				$this->redirect(array('controller'=>'partidas','action'=>'index','control'=>true));
			break;
			case 3:
				$this->redirect(array('controller'=>'partidas','action'=>'jugar'));
			break;
			case 4:
				$this->redirect(array('controller'=>'usuarios','action'=>'index','control'=>true));
			break;
		}
	}
}