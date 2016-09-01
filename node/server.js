var app = require('http').createServer(handler);
var url = require('url');
var io = require('socket.io').listen(app);
var fs = require('fs');

function handler(req, res){
	res.setHeader('Access-Control-Allow-Origin', '*');
	res.setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, PATCH, DELETE');
	res.setHeader('Access-Control-Allow-Headers', 'X-Requested-With,content-type');
	
	var hostname = req.headers.host; // hostname = 'localhost:8080'
	var pathname = url.parse(req.url).pathname; // pathname = '/MyApp'
	console.log('http://' + hostname + pathname);

	res.writeHead(200);
	res.end();
}

app.listen(8888);

var sockets_partidas = {};
var status_partidas = {};

io.on('connection', function(socket){
	
	var usuario_id; var partida_id;
	
	socket.on('establishConnection', function(data){
		
		usuario_id = data.usuario_id; partida_id = data.partida_id;
		if(sockets_partidas[partida_id] == null){sockets_partidas[partida_id]={jugadores:{},profesor:{}};}
		
		if(data.profesor != null){
			sockets_partidas[partida_id].profesor[usuario_id] = {status: 'online', socket: socket.id};
			socket.on('statusChange', function(){
				loadPartidaStatus(partida_id, function(){
					sendStatusToPlayers(partida_id);
				});
			});
			sendPlayerList(partida_id);
			console.log('Conectado profesor id '+usuario_id+' con partida id '+partida_id);
		}else{
			sockets_partidas[partida_id].jugadores[usuario_id] = {status: 'online', socket: socket.id};
			socket.on('selectAnswer', function(){
				playerSelectAnswer(partida_id);
			});
			sendPlayerList(partida_id);
			console.log('Conectado usuario id '+usuario_id+' con partida id '+partida_id);
		}
		
		if(status_partidas[partida_id] != null){
			socket.emit('status', status_partidas[partida_id]);
		}else{
			loadPartidaStatus(partida_id, function(){
				socket.emit('status', status_partidas[partida_id]);
			});
		}
		
	});

	socket.on('reEstablishConnection', function(){
		if(sockets_partidas[partida_id] != null && sockets_partidas[partida_id].jugadores[usuario_id] != null && sockets_partidas[partida_id].jugadores[usuario_id].status == 'offline'){
			sockets_partidas[partida_id].jugadores[usuario_id].status = 'online';
			sendPlayerList(partida_id);
			console.log('usuario id '+usuario_id+' online');
		}
	});
	
	socket.on('deEstablishConnection', function(){
		if(sockets_partidas[partida_id] != null && sockets_partidas[partida_id].jugadores[usuario_id] != null && sockets_partidas[partida_id].jugadores[usuario_id].status == 'online'){
			sockets_partidas[partida_id].jugadores[usuario_id].status = 'offline';
			sendPlayerList(partida_id);
			console.log('usuario id '+usuario_id+' offline');
		}
	});
	
	socket.on('disconnection', function(){
		if(sockets_partidas[partida_id] != null && sockets_partidas[partida_id].jugadores[usuario_id] != null){
			delete sockets_partidas[partida_id].jugadores[usuario_id];
			sendPlayerList(partida_id);
			console.log('usuario id '+usuario_id+' desconectado');
		}
	});
	
	socket.on('gameDataChanged', function(data){
		loadPartidaStatus(data.partida_id, function(){
			sendStatusToPlayers(data.partida_id);
		});
	});
	
});

function loadPartidaStatus(partida_id, callback){
	
	/*var post_options = {
		host: '192.168.99.100',
		port: '80',
		path: '/partidas/getPartidaStatus/'+partida_id,
		method: 'POST'
	};

	// Set up the request
	var post_req = app.request(post_options, function(res) {
		res.setEncoding('utf8');
		res.on('data', function (chunk) {
			console.log('Response: ' + chunk);
		});
	});*/
	
	/*app.get({ host: 'http://192.168.99.100', port: 80, path: '/partidas/getPartidaStatus/'+partida_id}, function(response) {
        var data = "";
        response.on('data', function(chunk) {
            data += chunk;
        });
        response.on('end', function() {
            //socket.broadcast(JSON.parse(data));
			console.log(JSON.parse(data));
        });
    });*/
	/*var request = require('request');
	request('http://apps-lanzallamas.com.ar/jugame/partidas/getPartidaStatus/'+partida_id, function(error, response, body){
		if(!error && response.statusCode == 200){
			status_partidas[partida_id] = JSON.parse(body); callback();
		}
	});*/
	status_partidas[partida_id] = {status: 1}; callback();
}

function sendStatusToPlayers(partida_id){
	if(sockets_partidas[partida_id] != null){
		for(usuario_id in sockets_partidas[partida_id].jugadores){
			io.to(sockets_partidas[partida_id].jugadores[usuario_id].socket).emit('status', status_partidas[partida_id]);
		}
	}
}

function playerSelectAnswer(partida_id){
	for(usuario_id in sockets_partidas[partida_id].profesor){
		io.to(sockets_partidas[partida_id].profesor[usuario_id].socket).emit('userAnswer', {data: 'sas'});
	}
}

function sendPlayerList(partida_id){
	for(usuario_id in sockets_partidas[partida_id].profesor){
		io.to(sockets_partidas[partida_id].profesor[usuario_id].socket).emit('playerList', {playerList: sockets_partidas[partida_id].jugadores});
	}
}