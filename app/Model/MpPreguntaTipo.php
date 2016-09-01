<?php
class MpPreguntaTipo extends AppModel{
	var $name = 'MpPreguntaTipo';
	
	function getCombo(){
		return $this->find('list',array('fields'=>array('id','descripcion')));
	}
}
