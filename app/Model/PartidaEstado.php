<?php
class PartidaEstado extends AppModel{
	var $name = 'PartidaEstado';
	
	function getCombo(){
		return $this->find('list',array('fields'=>array('id','descripcion')));
	}
}