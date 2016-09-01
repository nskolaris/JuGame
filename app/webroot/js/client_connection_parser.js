var client_connection_parser = {
	parseData: function(response){
		if(typeof response == 'string'){
			data = JSON.parse(response);
		}else{
			data = response;
		}
		
		if(data.contenido_disponible){
			$('#show_contenido_button').attr('disabled',false);
		}else{
			if($("#contenido_a_estudiar").is(":visible")){
				toggleContenidoEstudiarGUI();
			}
			$('#show_contenido_button').attr('disabled',true);
		}
		partida.contenido_disponible = data.contenido_disponible
		
		if(partida.status != data.status){
			switch(parseInt(data.status)){
				case 1:
					location.reload();
				break;
				
				case 2:
					client_connection_parser.requestGameData();
					startGameCountdown(5);
				break;
					
				case 3:
					partida.pregunta_index = data.pregunta_index;
					if(partida.preguntas != null){
						showPregunta();
					}else{
						partida.status = data.status;
						client_connection_parser.requestGameData();
					}
				break;
					
				case 4:
					if(partida.preguntas != null){
						client_connection_parser.requestScoreBoard();
					}else{
						partida.status = data.status;
						client_connection_parser.requestGameData();
					}
				break;
				
				case 5:
					location.reload();
				break;
			}
			partida.status = data.status;
		}
		if(data.status == 1 && data.time_updated != partida.time_updated){
			client_connection_parser.requestGameData();
			partida.time_updated = data.time_updated;
		}
	},
	selectRespuesta: function(pregunta_index, respuesta_id, seconds_left){
		client_connection_manager.sendData({action: 'select_respuesta', pregunta_index: pregunta_index, respuesta_id: respuesta_id, seconds_left: seconds_left},function(response){
			data = JSON.parse(response);
			addPoints(data.answer_points,data.time_points);
		});
	},
	requestScoreBoard: function(){
		client_connection_manager.sendData({action: 'request_scoreboard'},function(response){
			data = JSON.parse(response);
			showScoreBoard(data);
		});
	},
	requestGameData: function(){
		client_connection_manager.sendData({action: 'request_game_data'},function(response){
			data = JSON.parse(response);
			partida.preguntas = null;
			partida = $.extend(true,partida,data);
			if(partida.status == 1){
				refreshGameData();
			}else if(partida.status == 3){
				showPregunta();
			}else if(partida.status == 4){
				client_connection_parser.requestScoreBoard();
			}
		});
	}
}