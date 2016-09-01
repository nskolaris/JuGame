<?php
class UsuarioLogin extends AppModel{
	var $name = 'UsuarioLogin';
	var $useTable = 'usuario_logins';
	
	var $belongsTo = array(
		'Usuario' => array(
			'className' => 'Usuario',
			'foreignKey' => 'usuario_id',
		)
	);
	
	function registerLogin($usuario_id){
		return $this->save(array('usuario_id'=>$usuario_id));
	}
}