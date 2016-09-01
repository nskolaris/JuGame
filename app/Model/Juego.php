<?php
class Juego extends AppModel{
	var $name = 'Juego';
	var $actsAs = array('Containable');
	
	var $hasAndBelongsToMany = array(
        'MpPregunta' => array(
			'className' => 'MpPregunta',
			'joinTable' => 'mp_juegos_preguntas',
			'foreignKey' => 'juego_id',
			'associationForeignKey' => 'mp_pregunta_id'
		)
    );
	
	var $hasOne = array(
        'Partida' => array(
            'className' => 'Partida',
            'foreignKey' => 'juego_id'
        )
    );
	
	var $belongsTo = array(
		'CategoriaJuego' => array(
			'className' => 'CategoriaJuego',
			'foreignKey' => 'categoria_id'
		)
	);
	
	function getJuegosSinPartidas(){
		$output = array();
		$juegos = $this->find('all', array('fields'=>array('Juego.id','Juego.nombre','Partida.id'), 'conditions'=>array('Partida.id'=>NULL)));
		foreach($juegos as $juego){
			$output[$juego['Juego']['id']] = $juego['Juego']['nombre'];
		}
		return $output;
	}
	
	function getById($juego_id){
		$juego = $this->find('first',array('conditions'=>array('Juego.id'=>$juego_id),'contain'=>array('MpPregunta'=>array('MpPreguntaOpcion'),'CategoriaJuego'=>array('nombre'))));
		return $juego;
	}
	
	function getPreguntasIdById($juego_id){
		$juego = $this->find('first',array('conditions'=>array('Juego.id'=>$juego_id),'contain'=>array('MpPregunta'=>array('id')),'fields'=>array('id')));
		$ids = array();
		foreach($juego['MpPregunta'] as $pregunta){
			$ids[] = $pregunta['id'];
		}
		return $ids;
	}
	
	function getCombo(){
		return $this->find('list',array('fields'=>array('id','nombre'),'conditions'=>array('deleted'=>null)));
	}
	
	function getAll(){
		return $this->find('all',array('fields'=>array('id','nombre'),'contain'=>array('MpPregunta'=>array('id'),'CategoriaJuego'=>array('nombre'))));
	}
	
	function guardar($data){
		$response = array('status'=>false,'message'=>'No se pudo guardar el juego','error'=>null);
		if($this->save($data)){
			$response['status'] = true;
			$response['message'] = 'El juego fué guardado correctamente';
		}else{
			$response['error'] = $this->invalidFields();
		}
		return $response;
	}
	
	function delete($juego_id = NULL, $cascade = true){
		$this->id = $juego_id;
		return $this->saveField('deleted',date('Y-m-d h:i:s'));
	}
}