var partida = {
	status: 1,
	pregunta_index: 1,
	time_updated: null,
	points: 0,
	contenido_disponible: false
}

var seconds_timer = {
	seconds_left: 0,
	function_per_second: null,
	time_over_callback: null,
	timer: null,
	running: false,
	start: function(seconds,callback,func){
		clearInterval(seconds_timer.timer);
		this.running = true;
		this.seconds_left = seconds;
		this.time_over_callback = callback;
		this.function_per_second = func;
		this.timer = setInterval(function(){
			seconds_timer.seconds_left = seconds_timer.seconds_left - 1;
			seconds_timer.function_per_second(seconds_timer.seconds_left);
			if(seconds_timer.seconds_left == 0){
				clearInterval(seconds_timer.timer);
				seconds_timer.time_over_callback();
			}
		},1000);
		func(seconds);
	},
	stop: function(){
		this.running = false;
		clearInterval(seconds_timer.timer);
	}
}