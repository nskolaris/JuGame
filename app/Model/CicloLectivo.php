<?php
class CicloLectivo extends AppModel{
	var $name = 'CicloLectivo';
	var $useTable = 'ciclos_lectivos';
	
	var $hasMany = array(
		'Grado' => array(
			'className' => 'Grado',
            'foreignKey' => 'ciclo_lectivo_id'
		)
    );
	
	function getCicloActivo(){
		$ciclo = $this->find('first',array('conditions'=>array('activo'=>1),'fields'=>array('id'),'order'=>'id DESC'));
		return $ciclo['CicloLectivo']['id'];
	}
}