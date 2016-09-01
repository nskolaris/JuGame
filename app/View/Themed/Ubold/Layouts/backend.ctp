<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
		<meta name="author" content="Coderthemes">

		<link rel="shortcut icon" href="images/favicon_1.ico">

		<title>Juegos educativos</title>

		<script>
			var mensajes = new Array();
		</script>
		
		<link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>plugins/jquery.steps/demo/css/jquery.steps.css" />
		
		<link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>plugins/ion-rangeslider/ion.rangeSlider.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>plugins/ion-rangeslider/ion.rangeSlider.skinFlat.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>plugins/seiyria-bootstrap-slider/dist/css/bootstrap-slider.min.css">
		
		<link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>plugins/tablesaw/dist/tablesaw.css" />
		
		<link href="<?php echo $this->webroot; ?>plugins/dropzone/dist/dropzone.css" rel="stylesheet" type="text/css" />
		
		<?php
			echo $this->Html->css('bootstrap.min.css');
			echo $this->Html->css('core.css');
			echo $this->Html->css('components.css');
			echo $this->Html->css('multi-select.css');
			echo $this->Html->css('icons.css');
			echo $this->Html->css('pages.css');
			echo $this->Html->css('responsive.css');
			echo $this->Html->script('modernizr.min.js');
			echo $this->Html->script('jquery.min.js');
			echo $this->Html->script('socket.io-1.4.5');
		?>

	</head>

	<body class="fixed-left">

		<!-- Begin page -->
		<div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                       <!-- <a href="index.html" class="logo"><i class="icon-magnet icon-c-logo"></i><span>Ub<i class="md md-album"></i>ld</span></a>-->
                        <a href="javascript:void(0);" class="logo"><i class="icon-magnet icon-c-logo"></i><span>Jugame</span></a>
                    </div>
                </div>

                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">
                            <div class="pull-left">
                                <button class="button-menu-mobile open-left">
                                    <i class="ion-navicon"></i>
                                </button>
                                <span class="clearfix"></span>
                            </div>
                            <ul class="nav navbar-nav navbar-right pull-right">
                                <li class="dropdown">
                                    <a href="page-starter.html" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true"><img src="<?php echo $this->webroot.'img/avatars/'.(isset($usuario['avatar'])?$usuario['avatar']:''); ?>" alt="user-img"> </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="javascript:void(0)"><i class="ti-user m-r-5"></i> Profile</a></li>
                                        <li><a href="javascript:void(0)"><i class="ti-settings m-r-5"></i> Settings</a></li>
                                        <li><a href="javascript:void(0)"><i class="ti-lock m-r-5"></i> Lock screen</a></li>
                                        <li><a href="<?php echo $this->Html->url(array('controller'=>'usuarios','action'=>'login','control'=>false)); ?>"><i class="ti-power-off m-r-5"></i> Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </div>
            </div>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->

            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                    <!--- Divider -->
                    <div id="sidebar-menu">
                        <ul>
                            <!--<li class="has_sub">
                                <a href="<?php echo $this->Html->url(array("controller" => "usuarios","action" => "index")); ?>" class="waves-effect"><i class="ti-home"></i><span>Index</span></a>
                            </li>-->
							<li class="has_sub">
                                <a href="#" class="waves-effect"><i class="ti-menu-alt"></i><span>Escuelas</span></a>
								<ul class="list-unstyled">
									<li><a href="<?php echo $this->Html->url(array("controller" => "escuelas","action" => "index")); ?>">Lista Escuelas</a></li>
                                    <li><a href="<?php echo $this->Html->url(array("controller" => "escuelas","action" => "add")); ?>">Agregar Escuela</a></li>
								</ul>
                            </li>
                            <li class="has_sub">
                                <a href="#" class="waves-effect"><i class="ti-menu-alt"></i><span>Juegos</span></a>
								<ul class="list-unstyled">
									<li><a href="<?php echo $this->Html->url(array("controller" => "juegos","action" => "index")); ?>">Lista Juegos</a></li>
                                    <li><a href="<?php echo $this->Html->url(array("controller" => "juegos","action" => "add")); ?>">Agregar Juego</a></li>
								</ul>
                            </li>
							<li class="has_sub">
                                <a href="#" class="waves-effect"><i class="ti-menu-alt"></i><span>Partidas</span></a>
								<ul class="list-unstyled">
									<li><a href="<?php echo $this->Html->url(array("controller" => "partidas","action" => "index")); ?>">Lista Partidas</a></li>
									<li><a href="<?php echo $this->Html->url(array("controller" => "partidas","action" => "historial")); ?>">Historial Partidas</a></li>
                                    <li><a href="<?php echo $this->Html->url(array("controller" => "partidas","action" => "crear")); ?>">Agregar Partida</a></li>
								</ul>
                            </li>
							<li class="has_sub">
                                <a href="#" class="waves-effect"><i class="ti-menu-alt"></i><span>Usuarios</span></a>
								<ul class="list-unstyled">
									<li><a href="<?php echo $this->Html->url(array("controller"=>"usuarios","action"=>"index")); ?>">Lista Usuarios</a></li>
                                    <li><a href="<?php echo $this->Html->url(array("controller"=>"usuarios","action"=>"agregar")); ?>">Agregar Usuario</a></li>
								</ul>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
			<!-- Left Sidebar End -->

			<!-- ============================================================== -->
			<!-- Start right Content here -->
			<!-- ============================================================== -->
			<div class="content-page">
				<!-- Start content -->
				<div class="content">
					<div class="container">
						<!-- Page-Title -->
						<div class="row">
							<div class="col-sm-12">
								<?php echo $this->Session->flash(); ?>
								<?php echo $this->fetch('content'); ?>
							</div>
						</div>
                    </div> <!-- container -->
                               
                </div> <!-- content -->

                <footer class="footer"></footer>

            </div>
            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->
        </div>
        <!-- END wrapper -->

        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
		<?php
			echo $this->Html->script('bootstrap.min.js');
			echo $this->Html->script('detect.js');
			echo $this->Html->script('fastclick.js');
			echo $this->Html->script('jquery.slimscroll.js');
			echo $this->Html->script('jquery.blockUI.js');
			echo $this->Html->script('waves.js');
			echo $this->Html->script('wow.min.js');
			echo $this->Html->script('jquery.nicescroll.js');
			echo $this->Html->script('jquery.multi-select.js');
			echo $this->Html->script('jquery.scrollTo.min.js');
		?>
			<script type="text/javascript" src="<?php echo $this->webroot; ?>plugins/tablesaw/dist/tablesaw.js"></script>
			<script type="text/javascript" src="<?php echo $this->webroot; ?>plugins/tablesaw/dist/tablesaw-init.js"></script>
			
			<script type="text/javascript" src="<?php echo $this->webroot; ?>plugins/notifyjs/dist/notify.min.js"></script>
			<script type="text/javascript" src="<?php echo $this->webroot; ?>plugins/notifications/notify-metro.js"></script>
			
			<script type="text/javascript" src='<?php echo $this->webroot; ?>plugins/ion-rangeslider/ion.rangeSlider.min.js'></script>
			<script type="text/javascript" src='<?php echo $this->webroot; ?>plugins/seiyria-bootstrap-slider/dist/bootstrap-slider.min.js'></script>

			<script type="text/javascript" src="<?php echo $this->webroot; ?>plugins/jquery.steps/build/jquery.steps.min.js" ></script>
			
			<script type="text/javascript" src="<?php echo $this->webroot; ?>plugins/jquery-validation/dist/jquery.validate.min.js"></script>
			<script type="text/javascript" src="<?php echo $this->webroot; ?>pages/jquery.wizard-init.js" ></script>
				
			<script src="<?php echo $this->webroot; ?>plugins/dropzone/dist/dropzone.js"></script>
		<?php
			echo $this->Html->script('jquery.core.js');
			echo $this->Html->script('jquery.app.js');
		?>
		<script>
			if(mensajes.length)
			{
				$.each(mensajes, function(key, mensaje){	
					$.Notification.notify(mensaje.tipo,mensaje.position,mensaje.titulo,mensaje.texto);
				})
			}
		</script>
	</body>
</html>