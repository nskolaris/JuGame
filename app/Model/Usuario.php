<?php
class Usuario extends AppModel{
	var $name = 'Usuario';
	var $actsAs = array('Containable');
	var $virtualFields = array('nombreCompleto' => 'CONCAT(Usuario.nombre, " ", Usuario.apellido)');

	var $belongsTo = array(
		'Rol' => array(
			'className' => 'Rol',
			'foreignKey' => 'rol_id',
		),
		'Avatar' => array(
			'className' => 'Avatar',
			'foreignKey' => 'avatar_id',
		),
		'Escuela' => array(
			'className' => 'Escuela',
			'foreignKey' => 'escuela_id',
		)
	);
	
	var $hasMany = array(
		'PartidaUsuario' => array(
			'className' => 'PartidaUsuario',
            'foreignKey' => 'usuario_id'
		),
		'MpPartidaRespuesta' => array(
            'className' => 'MpPartidaRespuesta',
            'foreignKey' => 'usuario_id'
        ),
		'UsuarioLogin' => array(
            'className' => 'UsuarioLogin',
            'foreignKey' => 'usuario_id'
        )
    );
	
	var $hasAndBelongsToMany = array(
        'Grado' => array(
			'className' => 'Grado',
			'joinTable' => 'grados_usuarios',
			'foreignKey' => 'usuario_id',
			'associationForeignKey' => 'grado_id',
			'order'=>'Grado.id DESC'
		)
    );
	
	function getById($id){
		return $this->find('first',array('conditions'=>array('Usuario.id'=>$id)));
	}

	function getByEmail($email){
		return $this->find('first',array('conditions'=>array('Usuario.email'=>$email)));
	}
	
	function beforeSave($options = array()){
		if(!empty($this->data['Usuario']['password'])){
			$this->data['Usuario']['password'] = md5($this->data['Usuario']['password']);
		}
		return true;
	}
	
	function login($email, $password){
		if($user = $this->find('first',array('conditions'=>array('Usuario.email'=>$email,'Usuario.password'=>md5($password)),'contain'=>array('Avatar','Rol'=>array('level'))))){
			$this->UsuarioLogin->registerLogin($user['Usuario']['id']);
			return $user;
		}else{
			return $this->find('first',array('conditions'=>array('Usuario.email'=>$email,'rol_id'=>3),'contain'=>array('Avatar','Rol'=>array('level'))));
		}
	}
	
	function getAll(){
		$usuarios = $this->find('all',array(
			'conditions'=>	array(),
			'contain'=>		array('Rol'=>array('descripcion'),'Grado'),
			'fields'=>		array('nombre','apellido','email','gender')
		));
		return $usuarios;
	}
	
	function getUsuariosByEscuelaId($escuela_id, $rol_level){
		$usuarios = $this->find('all',array(
			'conditions'=>	array('Usuario.escuela_id'=>$escuela_id,'Rol.level <='=>$rol_level),
			'contain'=>		array('Rol'=>array('descripcion'),'Grado'),
			'fields'=>		array('nombre','apellido','email','gender')
		));
		return $usuarios;
	}
	
	function guardar($data){
	
		if(isset($data['Usuario']['grado_id'])){
			$data['Grado'] = array('Grado'=>array($data['Usuario']['grado_id']));
		}
		
		$response = array('status'=>false,'message'=>'No se pudo guardar el usuario','errors'=>null);

		if(empty($data['Usuario']['id'])){
			$data['Usuario']['avatar_id'] = 1;
			if($data['Usuario']['gender'] != 'male'){
				$data['Usuario']['avatar_id'] = 2;
			}
		}
		
		if(isset($data['Usuario']['password'])){
			$data['Usuario']['password'] = md5($data['Usuario']['password']);
		}
		
		if($this->save($data)){
			$response['status'] = true;
			$response['message'] = 'El usuario fue guardado con éxito';
		}else{
			$response['errors'] = $this->invalidFields;
		}
		return $response;
	}
}