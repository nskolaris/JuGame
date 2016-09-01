<?php
class ParticipantesController extends AppController {
	function jugar(){
		$this->set('user_token','ASDF!@#$%^&*');
	}
	
	function jugar_phaser(){
		$this->layout = 'phaser_game';
		$this->set('user_token','ASDF!@#$%^&*');
	}
	
	function conn_test(){
		$time_updated = '01:01:01';
		if(isset($_POST['data'])){
			$data = (array)json_decode($_POST['data']);
			if(isset($data['action'])){
				switch($data['action']){
					case 'request_game_data':
						$response = array(
							'tiempo_por_pregunta'=>30,
							'preguntas'=>array(),
							'group_id'=>1,
							'participante_id'=>1,
							'time_updated'=>$time_updated,
							'groups'=>array(
								1=>array(
									'name'=>'Grupo 1',
									'participantes'=>array(
										1=>array('name'=>'sas'),
										2=>array('name'=>'sos'),
										5=>array('name'=>'sus')
									)
								),
								2=>array(
									'name'=>'Grupo 2',
									'participantes'=>array(
										3=>array('name'=>'ses'),
										4=>array('name'=>'sis')
									)
								)
							),
							'preguntas'=>array(
								1=>array(
									'pregunta'=>'¿Dónde nació el Almirante Brown?',
									'respuesta_id'=>1,
									'respuesta'=>'El Almirante Brown nació en Irlanda el 22 de junio de 1777',
									'respuestas'=>array(
										1=>array('respuesta'=>'Irlanda','comentario'=>'Bien Hecho el Almirante Brown nació en Irlanda el 22 de junio de 1777'),
										2=>array('respuesta'=>'Inglaterra','comentario'=>'Error el Almirante Brown nació en Irlanda el 22 de junio de 1777'),
										3=>array('respuesta'=>'Francia','comentario'=>'Error el Almirante Brown nació en Irlanda el 22 de junio de 1777'),
										4=>array('respuesta'=>'Argentina','comentario'=>'Error el Almirante Brown nació en Irlanda el 22 de junio de 1777'),
										5=>array('respuesta'=>'Perú','comentario'=>'Error el Almirante Brown nació en Irlanda el 22 de junio de 1777'),
									)
								),
								2=>array(
									'pregunta'=>'¿Cuándo nació el Almirante Brown?',
									'respuesta_id'=>10,
									'respuesta'=>'El Almirante Brown nació en Irlanda el 22 de junio de 1777',
									'respuestas'=>array(
										6=>array('respuesta'=>'26 de febrero de 1778','comentario'=>'Error el Almirante Brown nació en Irlanda el 22 de junio de 1777'),
										7=>array('respuesta'=>'22 de junio de 1815','comentario'=>'Error el Almirante Brown nació en Irlanda el 22 de junio de 1777'),
										8=>array('respuesta'=>'9 de julio de 1816','comentario'=>'Error el Almirante Brown nació en Irlanda el 22 de junio de 1777'),
										9=>array('respuesta'=>'19 de marzo de 1800','comentario'=>'Error el Almirante Brown nació en Irlanda el 22 de junio de 1777'),
										10=>array('respuesta'=>'22 de junio de 1777','comentario'=>'Bien Hecho el Almirante Brown nació en Irlanda el 22 de junio de 1777'),
									)
								)
							)
						);
					break;
					
					case 'request_scoreboard':
					$response = array(
						1=>array(
							'name'=>'grupo 1',
							'points'=>array(1=>5,2=>10),
							'total_points'=>15,
							'participantes'=>array(
								1=>array(
									'name'=>'sas',
									'points'=>array(1=>2,2=>7),
									'total_points'=>9
								),
								2=>array(
									'name'=>'sos',
									'points'=>array(1=>3,2=>3),
									'total_points'=>6
								)
							)
						),
						2=>array(
							'name'=>'grupo 2',
							'points'=>array(1=>20,2=>30),
							'total_points'=>50
						)
					);
					break;
					
					case 'select_respuesta':
						$response = array('respuesta_id'=>$data['respuesta_id'],'answer_points'=>25,'time_points'=>$data['seconds_left']*2);
						//$response = array('respuesta_id'=>$data['respuesta_id'],'answer_points'=>250,'time_points'=>0);
					break;
				}
			}
		}else{
			//0=no empezado,2=jugando,3=scoreboard
			$response = array('status'=>0,'pregunta_id'=>1,'time_updated'=>$time_updated);
		}
		echo json_encode($response);
		exit;
	}
}