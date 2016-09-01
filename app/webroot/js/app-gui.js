var mainBoxObj = {
	id: 'mainBox',
	component: 'Window',
	skin: 'bgLoco',
	padding: 0,
	width: 800,
	height: 500,
	children: [
		//Status Bar
		{
			id: 'status_bar',
			component: 'Layout',
			skin: 'lightYellowContainer',
			position: {x: 5, y: 5},
		    width: 790,
		    height: 80,
			padding: 0,
			children: [
				{
					id: 'seconds_time',
					component: 'Text',
					skin: 'yellowContainer',
					text: '',
					font: {
						size: '30px',
						family: 'Skranji',
						color: '#fff'
					},
					position: {x: 15, y: 10},
					width: 60,
					height: 60
				},
				{
					id: 'time_progress_container',
					component: 'Layout',
					skin: 'yellowContainer',
					position: {x: 95, y: 20},
					width: 400,
					height: 40,
					padding: 5,
					children: [
						{
							id: 'time_progress_bar',
							component: 'Layout',
							skin: 'darkOrangeContainer',
							position: {x: 0, y: 0},
							width: 400,
							height: 40
						}
					]
				},
				{
					id: 'pregunta_index',
					component: 'Text',
					skin: 'yellowContainer',
					text: '',
					font: {
						size: '30px',
						family: 'Skranji',
						color: '#fff'
					},
					position: {x: 515, y: 10},
					width: 120,
					height: 60
				},
				{
					id: 'puntaje_counter',
					component: 'Text',
					skin: 'yellowContainer',
					text: '',
					font: {
						size: '30px',
						family: 'Skranji',
						color: '#fff'
					},
					position: {x: 655, y: 10},
					width: 120,
					height: 60
				},
				{
					id: 'points_gained',
					component: 'Text',
					text: '',
					font: {
						size: '30px',
						family: 'Skranji',
						color: '#fff'
					},
					position: {x: 655, y: 10},
					width: 120,
					height: 60
				},
				{
					id: 'time_points_gained',
					component: 'Text',
					text: '',
					font: {
						size: '20px',
						family: 'Skranji',
						color: '#fff'
					},
					position: {x: 105, y: 30},
					width: 120,
					height: 20
				}
			]
		},
		
		//Game Data
		{
			id: 'game_data',
			component: 'Layout',
			skin: 'lightYellowContainer',
			position: {x: 50, y: 50},
			width: 700,
		    height: 400,
			padding: 0,
			children: [
				{
					id: 'game_data_title',
					text: 'Datos del juego',
					font:{
						size: '40px',
						family: 'Skranji',
						color: '#fff'
					},
					component: 'Header',
					position: {x: 0, y: 0},
					width: 700,
					height: 100,
				},
				{
					id: 'game_data_center_text',
					text: 'Esperando a todos los jugadores',
					font:{
						size: '25px',
						family: 'Skranji',
						color: '#fff'
					},
					component: 'Text',
					position: {x: 0, y: 100},
					width: 700,
					height: 100,
				},
				{
					id: 'game_data_text',
					text: 'Tiempo por pregunta: 60\nMi Grupo (TEST): j1, j2, j3',
					font: {
						size: '30px',
						family: 'Skranji',
						color: '#fff'
					},
					component: 'Text',
					position: {x: 25, y: 200},
					width: 325,
					height: 200
				},
				{
					id: 'game_data_equipo',
					text: 'Equipo 1\nj1\nj2\j3\j4\j5',
					font: {
						size: '20px',
						family: 'Skranji',
						color: '#fff'
					},
					component: 'Text',
					position: {x: 375, y: 200},
					width: 325,
					height: 200
				},
				{
					id: 'start_timer',
					skin: 'darkOrangeContainer',
					text: 'El juego comenzara en 5 segundos...',
					font: {
						size: '20px',
						family: 'Skranji',
						color: '#fff'
					},
					component: 'Text',
					position: {x: 0, y: 360},
					width: 700,
					height: 40
				},
			]
		},
		
		//Pregunta
		{
			id: 'pregunta',
			component: 'Layout',
			position: {x: 100, y: 100},
		    width: 600,
		    height: 375,
			padding: 0,
			children: [
				{
					id: 'pregunta_text',
					component: 'Header',
					text: 'Pregunta 1',
					font:{
						size: '30px',
						family: 'Skranji',
						color: '#fff'
					},
					position: {x: 0, y: 0},
					width: 600,
					height: 80,
					z: 1
				},
				{
					id: 'respuestas_container',
					component: 'Layout',
					skin: 'lightYellowContainer',
					position: {x: 50, y: 70},
					width: 500,
					height: 305,
					padding: 0,
					children: [
						{
							id: 'respuesta_1',
							text: 'Respuesta 1',
							component: 'Button',
							font:{size: '20px', family: 'Calibri'},
							skin: 'orangeContainer',
							position: {x: 50, y: 20},
							width: 400,
							height: 47,
							padding: 0,
						},
						{
							id: 'respuesta_2',
							text: 'Respuesta 2',
							component: 'Button',
							font:{size: '20px', family: 'Calibri'},
							skin: 'orangeContainer',
							position: {x: 50, y: 75},
							width: 400,
							height: 47,
							padding: 0,
						},
						{
							id: 'respuesta_3',
							text: 'Respuesta 3',
							component: 'Button',
							font:{size: '20px', family: 'Calibri'},
							skin: 'orangeContainer',
							position: {x: 50, y: 130},
							width: 400,
							height: 47,
							padding: 0,
						},
						{
							id: 'respuesta_4',
							text: 'Respuesta 4',
							component: 'Button',
							font:{size: '20px', family: 'Calibri'},
							skin: 'orangeContainer',
							position: {x: 50, y: 185},
							width: 400,
							height: 47,
							padding: 0,
						},{
							id: 'respuesta_5',
							text: 'Respuesta 5',
							component: 'Button',
							font:{size: '20px', family: 'Calibri'},
							skin: 'orangeContainer',
							position: {x: 50, y: 240},
							width: 400,
							height: 47,
							padding: 0,
						},
					]
				}
			]
		},
		
		//Score Board
		{
			id: 'scoreboard',
			component: 'Layout',
			position: {x: 50, y: 0},
		    width: 700,
		    height: 500,
			padding: 0,
			children: [
				{
					id: 'scoreboard_text',
					text: 'Tabla de resultados',
					font:{
						size: '40px',
						family: 'Skranji',
						color: '#fff'
					},
					component: 'Text',
					position: {x: 0, y: 25},
					width: 700,
					height: 50,
				},
				{
					id: 'scoreboard_tab_buttons',
					component: 'Layout',
					position: {x: 0, y: 100},
					width: 700,
					height: 40,
					padding: 0,
					children: [
						{
							id: 'general_button',
							text: 'General',
							component: 'Button',
							font:{
								size: '14px',
							},
							skin: 'darkOrangeContainer',
							position: {x: 0, y: 0},
							width: 150,
							height: 40,
						},
						{
							id: 'group_button',
							text: 'Grupo',
							component: 'Button',
							font:{
								size: '14px',
							},
							skin: 'orangeContainer',
							position: {x: 150, y: 0},
							width: 150,
							height: 40,
						},
					]
				},
				{
					id: 'table_general',
					component: 'Layout',
					position: {x: 0, y: 140},
					width: 700,
					height: 280,
					skin: 'lightYellowContainer',
					padding: 0,
					children: [
						{
							id: 'table_general_header',
							component: 'Layout',
							position: {x: 0, y: 0},
							width: 700,
							height: 40,
							skin: 'darkOrangeContainer',
							padding: 0,
							children: [
								{
									id: 'table_general_header_grupo',
									text: 'Grupo',
									font: {size: '20px',family: 'Skranji',color: '#fff'},
									component: 'Text',
									position: {x: 0, y: 0},
									width: 200,
									height: 40
								},
								{
									id: 'table_general_header_puntaje',
									text: 'Puntaje',
									font: {size: '20px',family: 'Skranji',color: '#fff'},
									component: 'Text',
									position: {x: 200, y: 0},
									width: 200,
									height: 40
								},
								{
									id: 'table_general_header_puntaje_total',
									text: 'Puntaje Total',
									font: {size: '20px',family: 'Skranji',color: '#fff'},
									component: 'Text',
									position: {x: 400, y: 0},
									width: 200,
									height: 40
								},
							]
						},
						{
							id: 'columna_grupos',
							text: 'Grupo1\nGrupo2\nGrupo3',
							font: {
								size: '20px',
								family: 'Skranji',
								color: '#fff'
							},
							component: 'Text',
							anchor: {x: 0.5, y: 0},
							position: {x: 0, y: 60},
							width: 200,
							height: 270
						},
						{
							id: 'columna_puntaje_grupos',
							text: '10\n20\n30',
							font: {
								size: '20px',
								family: 'Skranji',
								color: '#fff'
							},
							component: 'Text',
							anchor: {x: 0.5, y: 0},
							position: {x: 200, y: 60},
							width: 200,
							height: 270
						},
						{
							id: 'columna_puntaje_total_grupos',
							text: '20\n40\n60',
							font: {
								size: '20px',
								family: 'Skranji',
								color: '#fff'
							},
							component: 'Text',
							anchor: {x: 0.5, y: 0},
							position: {x: 400, y: 60},
							width: 200,
							height: 270
						}
					]
				},
				{
					id: 'table_grupo',
					component: 'Layout',
					position: {x: 700, y: 140},
					width: 700,
					height: 280,
					skin: 'lightYellowContainer',
					padding: 0,
					children: [
						{
							id: 'table_grupo_header',
							component: 'Layout',
							position: {x: 0, y: 0},
							width: 700,
							height: 40,
							skin: 'darkOrangeContainer',
							padding: 0,
							children: [
								{
									id: 'table_grupo_header_jugador',
									text: 'Jugador',
									font: {size: '20px',family: 'Skranji',color: '#fff'},
									component: 'Text',
									position: {x: 0, y: 0},
									width: 200,
									height: 40
								},
								{
									id: 'table_grupo_header_puntaje',
									text: 'Puntaje',
									font: {size: '20px',family: 'Skranji',color: '#fff'},
									component: 'Text',
									position: {x: 200, y: 0},
									width: 200,
									height: 40
								},
								{
									id: 'table_grupo_header_puntaje_total',
									text: 'Puntaje Total',
									font: {size: '20px',family: 'Skranji',color: '#fff'},
									component: 'Text',
									position: {x: 400, y: 0},
									width: 200,
									height: 40
								},
							]
						},
						{
							id: 'columna_jugadores',
							text: 'Pepe\nPepo\nPepu',
							font: {
								size: '20px',
								family: 'Skranji',
								color: '#fff'
							},
							
							component: 'Text',
							anchor: {x: 0.5, y: 0},
							position: {x: 0, y: 60},
							width: 200,
							height: 270
						},
						{
							id: 'columna_puntaje_jugadores',
							text: '10\n20\n30',
							font: {
								size: '20px',
								family: 'Skranji',
								color: '#fff'
							},
							component: 'Text',
							anchor: {x: 0.5, y: 0},
							position: {x: 200, y: 60},
							width: 200,
							height: 270
						},
						{
							id: 'columna_puntaje_total_jugadores',
							text: '20\n40\n60',
							font: {
								size: '20px',
								family: 'Skranji',
								color: '#fff'
							},
							component: 'Text',
							anchor: {x: 0.5, y: 0},
							position: {x: 400, y: 60},
							width: 200,
							height: 270
						}
					]
				}
			]
		},
	
		//After Pregunta
		{
			id: 'after_pregunta',
			component: 'Layout',
			skin: 'lightYellowContainer',
			position: {x: 100, y: 100},
			width: 600,
			height: 350,
			padding: 0,
			z:10,
			children: [
				{
					id: 'after_pregunta_header',
					component: 'Header',
					text: 'Respuesta correcta',
					font:{
						size: '25px',
						family: 'Skranji',
						color: '#fff'
					},
					position: {x: 0, y: 0},
					width: 600,
					height: 50,
				},
				{
					id: 'after_pregunta_text_container',
					component: 'Layout',
					position: {x: 25, y: 75},
					width: 550,
					height: 175,
					padding: 0,
					children: [
						{
							id: 'after_pregunta_text',
							component: 'Text',
							text: '',
							font:{
								size: '20px',
								family: 'Skranji',
								color: '#fff'
							},
							position: {x: 175, y: 0},
							width: 375,
							height: 175,
						},
						{
							id: 'after_pregunta_image',
							component: 'Layout',
							skin: 'thumbsDown',
							position: {x: 25, y: 25},
							width: 125,
							height: 125,
						}
					]
				},
				{
					id: 'after_pregunta_points',
					component: 'Text',
					text: 'Ganaste 70 puntos!',
					font:{
						size: '20px',
						family: 'Skranji',
						color: '#fff'
					},
					skin: 'orangeContainer',
					position: {x: 25, y: 275},
					width: 550,
					height: 50,
				}
			]
		},
		
		//Overlay
		{
			id: 'black_overlay',
			component: 'Layout',
			skin: 'blackAlphaOverlay',
			position: {x: 0, y: 0},
		    width: 800,
		    height: 500
		},
		
		//Active User
		{
			id: 'usuario_activo',
			text: 'Usuario',
			font: {size: '20px',family: 'Skranji',color: '#fff'},
			component: 'Text',
			anchor: {x: 1, y: 0},
			position: {x: 50, y: 460},
			width: 690,
			height: 40
		},
		
		//Refresh Button
		{
			id: 'refresh_button',
			text: '↻',
			component: 'Button',
			position: {x: 5, y: 455},
			width: 40,
			height: 40
		},
		
		//Refresh Button
		{
			id: 'logout_button',
			text: '↩',
			component: 'Button',
			position: {x: 755, y: 455},
			width: 40,
			height: 40
		},
	]
}