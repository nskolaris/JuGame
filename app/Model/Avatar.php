<?php
class Avatar extends AppModel{
	var $name = 'Avatar';
	var $useTable = 'avatares';
	
	function getCombo(){
		return $this->find('list',array('fields'=>array('id','filename')));
	}
}