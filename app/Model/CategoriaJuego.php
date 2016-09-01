<?php
class CategoriaJuego extends AppModel{
	var $name = 'CategoriaJuego';
	var $useTable = 'categorias_juegos';
	
	/*var $hasMany = array(
		'Juego' => array(
			'className' => 'Juego',
            'foreignKey' => 'categoria_id'
		)
    );*/
	
	function getCombo(){
		return $this->find('list',array('fields'=>array('id','nombre')));
	}
}