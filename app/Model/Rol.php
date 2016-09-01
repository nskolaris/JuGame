<?php
class Rol extends AppModel{
	var $name = 'Rol';
	var $useTable = 'roles';
	
	function getCombo($rol_level = null){
		if($rol_level != null){
			$roles = $this->find('list',array('conditions'=>array('level <'=>$rol_level),'fields'=>array('id','descripcion')));
		}else{
			$roles = $this->find('list',array('fields'=>array('id','descripcion')));
		}
		return $roles;
	}
}