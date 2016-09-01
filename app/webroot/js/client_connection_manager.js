var client_connection_manager = {
	connection_timer: null,
	base_url: null,
	callback: null,
	received_last_response: true,
	startConnection: function(){
		this.connection_timer = setInterval(this.requestData,2500);
	},
	stopConnection: function(){
		clearInterval(this.connection_timer);
	},
	requestData: function(){
		if(client_connection_manager.received_last_response){
			client_connection_manager.received_last_response = false;
			$.post(client_connection_manager.base_url,function(response){
				client_connection_manager.callback(response);
				client_connection_manager.received_last_response = true;
			});
		}
	},
	sendData: function(data, callback){
		$.post(client_connection_manager.base_url,{data: JSON.stringify(data)},function(response){
			callback(response);
		});
	}
}