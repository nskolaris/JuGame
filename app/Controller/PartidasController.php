<?php
class PartidasController extends AppController {
	var $uses = array('Partida');
	
	function ingresar($partida_id){
		if($this->Partida->ingresarJugadorAPartida($partida_id, $this->loggedUser)){
			$this->redirect(array('controller'=>'partidas','action'=>'jugar'));
		}
	}
	
	function jugar($mode = 'html'){
		Configure::write('debug',0);
		if($partida_id = $this->Partida->PartidaUsuario->getPartidaIdByUserId($this->loggedUser['id'])){
			$partida = $this->Partida->getById($partida_id);
			$this->set('partida_id',$partida_id);
			if($partida['Partida']['usuario_creador_id'] == $this->loggedUser['id']){
				$this->set('own_partida',true);
			}
			if($mode == 'html'){
				$this->layout = 'game';
				$this->view = 'jugar_html';
			}else{
				$this->layout = 'phaser_game';
			}
			
		}else{
			$this->redirect(array('controller'=>'partidas','action'=>'index'));
		}
	}
	
	function crear_individual($juego_id = null){
		if(!empty($this->data)){
			$data = $this->data;
			$data['Partida']['usuario_creador_id'] = $this->loggedUser['id'];
			$data['Partida']['partida_estado_id'] = 0;
			$response = $this->Partida->guardar($data);
			if($response['status']){
				$this->redirect(array('controller'=>'partidas','action'=>'ingresar',$this->Partida->id));
			}
		}
		$this->set('juegosOptions', $this->Partida->Juego->getCombo());
		$this->set('juegos', $this->Partida->Juego->getAll());
	}
	
	function connect(){
		if($partida_id = $this->Partida->PartidaUsuario->getPartidaIdByUserId($this->loggedUser['id'])){
			
			$status = $this->Partida->getStatus($partida_id);

			if(isset($_POST['data'])){
				$data = (array)json_decode($_POST['data']);
				if(isset($data['action'])){
					switch($data['action']){
						case 'request_game_data':
							$response = $this->Partida->getSettings($partida_id,$this->loggedUser['id']);
						break;
						
						case 'select_respuesta':
							$response = $this->Partida->procesarOpcionElegida($this->loggedUser['id'], $partida_id, $data['pregunta_index'], $data['respuesta_id'], $data['seconds_left']);
						break;
						
						case 'request_scoreboard':
							$response = $this->Partida->getScoreboard($partida_id);
						break;
					}
				}
			}else{
				$response = array(
					'status'=>$status['partida_estado_id'],
					'pregunta_index'=>$status['pregunta_activa_id'],
					'time_updated'=>(empty($status['modified'])?$status['created']:$status['modified']),
					'contenido_disponible'=>$status['contenido_disponible']
				);
			}
			echo json_encode($response);
			exit;
		}
	}
	
	function getPartidaStatus($partida_id){
		$status = $this->Partida->getStatus($partida_id);
		$response = array(
			'status'=>$status['partida_estado_id'],
			'pregunta_index'=>$status['pregunta_activa_id'],
			'time_updated'=>(empty($status['modified'])?$status['created']:$status['modified']),
			'contenido_disponible'=>$status['contenido_disponible']
		);
		echo json_encode($response);
		exit;
	}
	
	function index(){
		$this->set('partidas',$this->Partida->getActivas());
	}
	
	//Funciones Administrador
	
	function control_index(){
		$this->set('partidas', $this->Partida->find('all',array('conditions'=>array('Partida.partida_estado_id !='=>5),'recursive'=>0,'fields'=>array('Juego.nombre','PartidaEstado.descripcion','Partida.mp_tiempo_pregunta','Partida.mp_cantidad_preguntas'))));
	}
	
	function control_historial(){
		$this->set('partidas', $this->Partida->find('all',array('conditions'=>array('Partida.partida_estado_id'=>5),'recursive'=>0,'fields'=>array('Juego.nombre','PartidaEstado.descripcion','Partida.mp_tiempo_pregunta','Partida.mp_cantidad_preguntas'))));
	}
	
	function control_crear(){
		if(!empty($this->data)){
			$data = $this->data;
			$data['Partida']['usuario_creador_id'] = $this->loggedUser['id'];
			$data['Partida']['partida_estado_id'] = $this->data['proximaPagina'] ? '1' : '0';
			$response = $this->Partida->guardar($data);
			$this->Session->setFlash($response['message'],'customFlash');
			if($response['status']){
				if($this->data['proximaPagina']){
					$this->redirect(array('controller'=>'partidas','action'=>'control_crearEquipo', $this->Partida->id,'prefix'=>$this->params['prefix']));
				}else{
					$this->redirect(array('controller'=>'partidas','action'=>'index'));
				}
			}
		}
		$this->set('juegos', $this->Partida->Juego->getAll());
		$this->set('grados', $this->Partida->Grado->getComboByEscuelaId($this->loggedUser['escuela_id']));
		$this->view = 'crear';
	}
	
	function control_edit($partida_id){
		$this->data = $this->Partida->getById($partida_id);
		$this->set('juegos', $this->Partida->Juego->getAll());
		$this->set('grados', $this->Partida->Grado->getComboByEscuelaId($this->loggedUser['escuela_id']));
		$this->view = 'crear';
	}
	
	function control_crearEquipo($partida_id){
		$this->set('partida_id', $partida_id);
		$this->set('colores',array('#5FBEAA','#F9F9F9','#5D9CEC','#81C868','#34D3EB','#FFBD4A','#F05050','#4C5667','#7266BA','#FB6D9D'));
	}
	
	function control_gestionar($partida_id){
		$this->data = $this->Partida->getById($partida_id);
		$this->set('estados',$this->Partida->PartidaEstado->getCombo());
	}
	
	function control_ver($partida_id){
		$this->data = $this->Partida->getById($partida_id);
		$this->set('scoreboard',$this->Partida->getScoreboard($partida_id));
	}

	function control_delete($id){
		$this->Partida->delete($id);
		$this->redirect(array('controller'=>'partidas','action'=>'index'));
	}
	
	//Funciones ajax
	
	function control_setEquipoUser(){
		if($this->Partida->setEquipoUser($_POST['partida_id'],$_POST['usuario_id'],$_POST['equipo_id'])){
			echo 'ok';
		}else{
			echo 'error';
		}
		exit;
	}
	
	function control_kickUser(){
		if($this->Partida->kickUser($_POST['partida_id'],$_POST['usuario_id'])){
			echo 'ok';
		}else{
			echo 'error';
		}
		exit;
	}
	
	function control_deleteTeam(){
		if($this->Partida->deleteTeam($_POST['partida_id'],$_POST['equipo_id'])){
			echo 'ok';
		}else{
			echo 'error';
		}
		exit;
	}
	
	function control_createTeam(){
		if($this->Partida->createTeam($_POST['partida_id'],$_POST['nombre'],$_POST['color'])){
			echo 'ok';
		}else{
			echo 'error';
		}
		exit;
	}
	
	function control_getUsuariosInPartida($partida_id){
		$usuarios = $this->Partida->getUsuarios($partida_id,'Usuario.apellido ASC');
		echo json_encode($usuarios);
		exit;
	}
	
	function control_getEquiposByPartida($partida_id){
		$equipos = $this->Partida->getEquipos($partida_id);
		echo json_encode($equipos);
		exit;
	}
	
	function control_getEquiposUsuariosByPartida($partida_id){
		$equipos_usuarios = $this->Partida->getEquiposUsuarios($partida_id);
		echo json_encode($equipos_usuarios);
		exit;
	}
	
	function control_getScoreboard($partida_id){
		$usuarios = $this->Partida->getScoreboard($partida_id);
		echo json_encode($usuarios);
		exit;
	}
	
	function control_setPartidaData($partida_id){
		if(!empty($_POST)){
			$this->Partida->id = $partida_id;
			foreach($_POST as $field => $value){
				$this->Partida->saveField($field,$value);
			}
		}
		exit;
	}
	
	function control_reset($partida_id){
		$this->Partida->reset($partida_id);
		echo 'ok';
		exit;
	}
	
	function control_setupUsuarios($partida_id){
		$this->Partida->setupUsuarios($partida_id);
		exit;
	}
	
	function control_save_equipos(){
		if(!empty($_POST)){
			$partida = $this->Partida->getById($_POST['partida_id']);
			$data['categoria_id'] = $partida['Juego']['categoria_id'];
			$data['grado_id'] = $partida['Partida']['grado_id'];
			$data['equipos'] = json_decode($_POST['equipos'],true);
			App::import('Model','PartidaEquipoUsuarioTemplate');
			$this->template = new PartidaEquipoUsuarioTemplate();
			$this->template->guardar($data);
			echo 'ok'; exit;
		}
		echo 'error';
		exit;
	}
}