<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="mobile-web-app-capable" content="yes">
	<title>
		Juegos Educativos
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('juego.css');
		
		echo $this->Html->script('jquery.min.js');
		echo $this->Html->script('socket.io-1.4.5');
		echo $this->Html->script('bootstrap.min');
		
		echo $this->Html->script('client_connection_manager');
		echo $this->Html->script('client_connection_parser');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body style="margin:0;">
	<div id="container">
		<div id="header"></div>
		<div id="content">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer"></div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
