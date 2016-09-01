<?php
class Partida extends AppModel{
	var $name = 'Partida';
	var $actsAs = array('Containable');
	
	var $belongsTo = array(
		'Juego' => array(
			'className' => 'Juego',
			'foreignKey' => 'juego_id'
		),
		'Grado' => array(
			'className' => 'Grado',
			'foreignKey' => 'grado_id'
		),
		'PartidaEstado' => array(
			'className' => 'PartidaEstado',
			'foreignKey' => 'partida_estado_id'
		),
		'Usuario' => array(
			'className' => 'Usuario',
			'foreignKey' => 'usuario_creador_id'
		)
	);
	
	var $hasAndBelongsToMany = array(
        'MpPregunta' => array(
			'className' => 'MpPregunta',
			'joinTable' => 'mp_partidas_preguntas',
			'foreignKey' => 'partida_id',
			'associationForeignKey' => 'mp_pregunta_id'
		)
    );
	
	var $hasMany = array(
		'PartidaEquipo' => array(
			'className' => 'PartidaEquipo',
            'foreignKey' => 'partida_id'
		),		
        'PartidaUsuario' => array(
            'className' => 'PartidaUsuario',
            'foreignKey' => 'partida_id'
        ),
		'PartidaEquiposUsuario' => array(
            'className' => 'PartidaEquiposUsuario',
            'foreignKey' => 'partida_id'
        ),
		'MpPartidaRespuesta' => array(
            'className' => 'MpPartidaRespuesta',
            'foreignKey' => 'partida_id'
        )
    );
	
	function getActivas(){
		$partidas = $this->find('all',array(
			'conditions'=>array('Partida.partida_estado_id'=>1,'Partida.deleted'=>null),
			'contain'=>array('Juego'=>array('nombre'),'PartidaUsuario'=>array('id')),
			'fields'=>array('mp_tiempo_pregunta','mp_cantidad_preguntas')
		));
		return $partidas;
	}
	
	function getById($partida_id){
		$partida = $this->find('first',array('conditions'=>array('Partida.id'=>$partida_id),'contain'=>array('Juego')));
		return $partida;
	}
	
	function getStatus($partida_id){
		$partida = $this->find('first',array(
			'conditions'=>array('Partida.id'=>$partida_id),
			'fields'=>array('partida_estado_id','pregunta_activa_id','modified','created','contenido_disponible'),
			'recursive'=>-1
		));
		return $partida['Partida'];
	}

	function getScoreboard($partida_id){
		$data = array('usuarios'=>array(),'equipos'=>array());

		$usuarios = $this->getUsuarios($partida_id);
		foreach($usuarios as $usuario){
			$respuestas = $this->MpPartidaRespuesta->getRespuestasByPartidaUsuario($partida_id, $usuario['Usuario']['id']);
			$data['usuarios'][$usuario['Usuario']['id']] = array(
				'id'=>$usuario['Usuario']['id'],
				'nombre'=>$usuario['Usuario']['nombre'],
				'apellido'=>$usuario['Usuario']['apellido'],
				'preguntas'=>$respuestas,
				'puntos'=>$usuario['PartidaUsuario']['puntos'],
				'puntos_normalizados'=>$usuario['PartidaUsuario']['puntos_normalizados']
			);
		}
		
		$equipos = $this->getEquipos($partida_id);
		foreach($equipos as $pos => $equipo){
			$data['equipos'][$equipo['PartidaEquipo']['id']] = $equipo['PartidaEquipo'];
			$data['equipos'][$equipo['PartidaEquipo']['id']]['preguntas'] = array();
			$data['equipos'][$equipo['PartidaEquipo']['id']]['pos'] = $pos;
		}
		
		$equipos_usuarios = $this->getEquiposUsuarios($partida_id);
		foreach($data['usuarios'] as $usuario_id => $usuario){
			if(isset($equipos_usuarios[$usuario_id])){
				$equipo_id = $equipos_usuarios[$usuario_id];
				
				//$data['equipos'][$equipo_id]['Usuarios'][$usuario_id] = $usuario;
				$data['equipos'][$equipo_id]['Usuarios'][] = $usuario;
				
				foreach($usuario['preguntas'] as $index_pregunta => $respuesta){
					if(!isset($data['equipos'][$equipo_id]['preguntas'][$index_pregunta])){
						$data['equipos'][$equipo_id]['preguntas'][$index_pregunta] = array('puntos'=>0,'puntos_normalizados'=>0,'cant'=>0);
					}
					$data['equipos'][$equipo_id]['preguntas'][$index_pregunta]['puntos'] += $respuesta['puntos'];
					$data['equipos'][$equipo_id]['preguntas'][$index_pregunta]['cant'] ++;
				}
				foreach($data['equipos'][$equipo_id]['preguntas'] as $index_pregunta => $pregunta){
					$data['equipos'][$equipo_id]['preguntas'][$index_pregunta]['puntos_normalizados'] = $pregunta['puntos_normalizados'] / $pregunta['cant'];
				}
			}
		}

		return (!empty($data['equipos'])?$data['equipos']:$data['usuarios']);
	}
	
	function getUsuarios($partida_id, $order = 'puntos DESC'){
		$usuarios = $this->PartidaUsuario->find('all',array(
			'conditions'=>array('PartidaUsuario.partida_id'=>$partida_id),
			'contain'=>array('Usuario'=>array('nombre','apellido')),
			'fields'=>array('id','puntos','puntos_normalizados','last_connection'),
			'order'=>$order
		));
		return $usuarios;
	}
	
	function getEquipos($partida_id){
		$equipos = $this->PartidaEquipo->find('all',array(
			'conditions'=>array('PartidaEquipo.partida_id'=>$partida_id),
			'contain'=>array(),
			'fields'=>array('id','nombre','puntos','puntos_normalizados','color'),
			'order'=>'puntos DESC'
		));
		return $equipos;
	}
	
	function getEquiposUsuarios($partida_id){
		$equipos_usuarios = $this->PartidaEquiposUsuario->find('list',array(
			'conditions'=>array('PartidaEquiposUsuario.partida_id'=>$partida_id),
			'contain'=>array(),
			'fields'=>array('usuario_id','equipo_id')
		));
		return $equipos_usuarios;
	}
	
	function getSettings($partida_id, $usuario_id){
		$partida = $this->find('first',array(
			'conditions'=>array('Partida.id'=>$partida_id),
			'fields'=>array('mp_tiempo_pregunta','mp_cantidad_preguntas'),
			'contain'=>array('Juego'=>array('nombre','contenido','MpPregunta'=>array('id','texto','comentario','MpPreguntaOpcion'=>array('id','texto','es_correcta','puntos','comentario'))))
		));
		
		$partida['Partida']['preguntas'] = array();
		shuffle($partida['Juego']['MpPregunta']);

		$i = 1;
		foreach($partida['Juego']['MpPregunta'] as $pregunta){
			$opciones = array();
			foreach($pregunta['MpPreguntaOpcion'] as $opcion){
				$opciones[$opcion['id']] = $opcion;
				if($opcion['es_correcta'] == 1){
					$pregunta['opcion_correcta_id'] = $opcion['id'];
				}
			}
			shuffle($opciones);
			$pregunta['opciones'] = $opciones;
			unset($pregunta['MpPartidasPregunta']); unset($pregunta['MpPreguntaOpcion']);
			$partida['Partida']['preguntas'][$i] = $pregunta;
			$i++;
			if($i > $partida['Partida']['mp_cantidad_preguntas']){break;}
		}
		unset($partida['Juego']['MpPregunta']);
		
		$partida['Partida']['equipo'] = $this->PartidaEquiposUsuario->getByUsuarioPartidaId($usuario_id, $partida_id);
		$partida['Partida']['nombre_juego'] = $partida['Juego']['nombre'];
		$partida['Partida']['contenido'] = $partida['Juego']['contenido'];
		
		$usuario = $this->PartidaUsuario->getByUserId($usuario_id);
		$partida['Partida']['points'] = $usuario['PartidaUsuario']['puntos'];

		return $partida['Partida'];
	}

	function procesarOpcionElegida($usuario_id, $partida_id, $preguinta_index, $opcion_id, $seconds_left){
		
		$partida = $this->getById($partida_id);
		$opcion = $this->Juego->MpPregunta->MpPreguntaOpcion->getById($opcion_id);
		
		$answer_points = (!empty($opcion)?$opcion['MpPreguntaOpcion']['puntos']:0);
		
		$time_points = 0;
		if($answer_points > 0){
			$time_points = $this->getPointsByTime($partida['Partida']['mp_tiempo_pregunta'],$seconds_left);
			$total_points = $answer_points + $time_points;
			$puntos_normalizados = 6 + (($seconds_left*4)/$partida['Partida']['mp_tiempo_pregunta']);
		}else{
			$total_points = $answer_points;
			if($answer_points < 0){
				$puntos_normalizados = 6 - ((($answer_points*-1)*5)/10);
			}else{
				$puntos_normalizados = 5;
			}
			
		}

		$data_respuesta = array(
			'partida_id' => $partida_id,
			'usuario_id' => $usuario_id,
			'pregunta_index' => $preguinta_index,
			'mp_pregunta_id' => (!empty($opcion)?$opcion['MpPreguntaOpcion']['mp_pregunta_id']:0),
			'mp_pregunta_opcion_id' => $opcion_id,
			'segundos_respuesta' => $partida['Partida']['mp_tiempo_pregunta'] - $seconds_left,
			'puntos' => $total_points,
			'puntos_normalizados' => $puntos_normalizados
		);

		$this->MpPartidaRespuesta->save($data_respuesta);
		$this->PartidaUsuario->calculatePoints($usuario_id, $partida_id);
		
		return array('answer_points'=>intval($answer_points),'time_points'=>intval($time_points));
	}
	
	function getPointsByTime($seconds_total,$seconds_left){
		return (1 + ($seconds_left / $seconds_total)) * 100;
	}

	function ingresarJugadorAPartida($partida_id, $usuario, $check = true){
		$data['PartidaUsuario'] = array(
			'partida_id' => $partida_id,
			'usuario_id' => $usuario['id'],
			'rol_id' => $usuario['rol_id']
		);
		
		if($check){
			if($existe = $this->PartidaUsuario->getByUserId($usuario['id'])){
				if($existe['PartidaUsuario']['partida_id'] == $partida_id){
					return true;
				}else{
					$this->PartidaEquiposUsuario->deleteAll(array('PartidaEquiposUsuario.usuario_id'=>$usuario['id']));
					$this->PartidaUsuario->deleteAll(array('PartidaUsuario.usuario_id'=>$usuario['id']));
				}
			}
		}
		$this->PartidaUsuario->create();
		return $this->PartidaUsuario->save($data);
	}
	
	function kickUser($partida_id, $usuario_id){
		$this->id = $partida_id;
		$this->PartidaUsuario->deleteAll(array('PartidaUsuario.partida_id'=>$partida_id,'PartidaUsuario.usuario_id'=>$usuario_id));
		$this->PartidaEquiposUsuario->deleteAll(array('PartidaEquiposUsuario.partida_id'=>$partida_id,'PartidaEquiposUsuario.usuario_id'=>$usuario_id));
		$this->saveField('modified',date('Y-m-d h:i:s'));
		return true;
	}
	
	function guardar($data){
		$response = array('status'=>false,'message'=>'No se pudo guardar la partida','error'=>null);
		if($this->save($data)){
			if(empty($data['Partida']['id'])){
				$this->setupUsuarios($this->id);
			}
			$response['status'] = true;
			$response['message'] = 'La partida fué guardado correctamente';
		}else{
			$response['error'] = $this->invalidFields();
		}
		return $response;
	}
	
	function delete($partida_id = NULL, $cascade = true){
		$this->id = $partida_id;
		//return $this->saveField('deleted',date('Y-m-d h:i:s'));
		return $this->delete();
	}
	
	function reset($partida_id){
		$this->id = $partida_id;
		$this->saveField('partida_estado_id',1);
		$this->saveField('pregunta_activa_id',1);
		$this->saveField('contenido_disponible',1);
		$equipos = $this->PartidaEquipo->getAll($partida_id);
		foreach($equipos as $equipo){
			$this->PartidaEquipo->id = $equipo['PartidaEquipo']['id'];
			$this->PartidaEquipo->saveField('puntos',0);
			$this->PartidaEquipo->saveField('puntos_normalizados',0);
		}
		$jugadores = $this->PartidaUsuario->getAll($partida_id);
		foreach($jugadores as $jugador){
			$this->PartidaUsuario->id = $jugador['PartidaUsuario']['id'];
			$this->PartidaUsuario->saveField('puntos',0);
			$this->PartidaUsuario->saveField('puntos_normalizados',0);
		}
		$this->MpPartidaRespuesta->deleteAll(array('partida_id'=>$partida_id));
	}

	function setEquipoUser($partida_id, $usuario_id, $equipo_id){
		$this->id = $partida_id;
		if($this->PartidaEquiposUsuario->agregar($usuario_id, $equipo_id)){
			$this->saveField('modified',date('Y-m-d h:i:s'));
			return true;
		}
		return false;
	}
	
	function deleteTeam($partida_id, $equipo_id){
		$this->id = $partida_id;
		$this->PartidaEquipo->deleteAll(array('PartidaEquipo.id'=>$equipo_id));
		$this->PartidaEquiposUsuario->deleteAll(array('PartidaEquiposUsuario.equipo_id'=>$equipo_id));
		$this->saveField('modified',date('Y-m-d h:i:s'));
		return true;
	}
	
	function createTeam($partida_id, $nombre, $color){
		$this->id = $partida_id;
		$this->PartidaEquipo->create();
		if($this->PartidaEquipo->save(array('partida_id'=>$partida_id,'nombre'=>$nombre,'color'=>$color))){
			$this->saveField('modified',date('Y-m-d h:i:s'));
			return true;
		}
		return false;
	}
	
	function setupUsuarios($partida_id){
		App::import('Model','PartidaEquipoUsuarioTemplate');
		$this->template = new PartidaEquipoUsuarioTemplate();
		
		$partida = $this->find('first',array(
			'conditions'=>array('Partida.id'=>$partida_id),
			'fields'=>array('id'),
			'contain'=>array('Grado'=>array('Usuario'=>array('id','rol_id')),'Juego'=>array('categoria_id'))
		));

		$lista_usuarios = array();
		if(isset($partida['Grado']['Usuario'])){
			foreach($partida['Grado']['Usuario'] as $usuario){
				$lista_usuarios[$usuario['id']] = array('id'=>$usuario['id'],'rol_id'=>$usuario['rol_id']);
			}
			$templates = $this->template->find('all',array('conditions'=>array('categoria_id'=>$partida['Juego']['categoria_id'],'usuario_id'=>array_keys($lista_usuarios))));
		
			if(!empty($templates)){
				$this->PartidaEquipo->deleteAll(array('PartidaEquipo.partida_id'=>$partida_id));
				$this->PartidaEquiposUsuario->deleteAll(array('PartidaEquiposUsuario.partida_id'=>$partida_id));
				$this->PartidaUsuario->deleteAll(array('PartidaUsuario.partida_id'=>$partida_id));

				$equipos_creados = array();
				foreach($templates as $template){
					if(!isset($equipos_creados[$template['PartidaEquipoUsuarioTemplate']['equipo_nombre']])){
						if($this->createTeam($partida_id, $template['PartidaEquipoUsuarioTemplate']['equipo_nombre'], $template['PartidaEquipoUsuarioTemplate']['equipo_color'])){
							$equipos_creados[$template['PartidaEquipoUsuarioTemplate']['equipo_nombre']] = $this->PartidaEquipo->id;
						}
					}
					if($this->ingresarJugadorAPartida($partida_id, $lista_usuarios[$template['PartidaEquipoUsuarioTemplate']['usuario_id']], false)){
						$this->setEquipoUser($partida_id, $template['PartidaEquipoUsuarioTemplate']['usuario_id'], $equipos_creados[$template['PartidaEquipoUsuarioTemplate']['equipo_nombre']]);
						unset($lista_usuarios[$template['PartidaEquipoUsuarioTemplate']['usuario_id']]);
					}
				}
			}
			
			foreach($lista_usuarios as $usuario){
				$this->ingresarJugadorAPartida($partida_id, $usuario, false);
			}
		}
	}
}