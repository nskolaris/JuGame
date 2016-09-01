<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="assets/images/favicon_1.ico">

        <title>Ubold - Responsive Admin Dashboard Template</title>
		
		<?php
			echo $this->Html->css('bootstrap.min.css');
			echo $this->Html->css('core.css');
			echo $this->Html->css('components.css');
			echo $this->Html->css('icons.css');
			echo $this->Html->css('pages.css');
			echo $this->Html->css('responsive.css');
		?>

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <?php
			echo $this->Html->script('modernizr.min.js');
		?>
<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-69506598-1', 'auto');
    ga('send', 'pageview');
</script>
        
    </head>
    <body>

        <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">
        	<div class=" card-box">
            <div class="panel-heading"> 
                <h3 class="text-center"> Ingresar </h3>
            </div> 


            <div class="panel-body">
			<?php
				echo $this->Form->create('Usuarios',array('class'=>'form-horizontal m-t-20'));
			?>                
                <div class="form-group ">
                    <div class="col-xs-12">
						<input name="data[Usuario][email]" class="form-control" placeholder="Email" id="email" type="text">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
						<input name="data[Usuario][password]" class="form-control" placeholder="Password" id="password" type="password">
                    </div>
                </div>

                <div class="form-group ">
                    <div class="col-xs-12">
                        <div class="checkbox checkbox-primary">
                            <input id="checkbox-signup" type="checkbox">
                            <label for="checkbox-signup">
                                Recuérdame
                            </label>
                        </div>
                        
                    </div>
                </div>
                
                <div class="form-group text-center m-t-40">
                    <div class="col-xs-12">
                        <button class="btn btn-pink btn-block text-uppercase waves-effect waves-light" type="submit">Acceder</button>
                    </div>
                </div>

                <div class="form-group m-t-30 m-b-0">
                    <div class="col-sm-12">
                        <a href="page-recoverpw.html" class="text-dark"><i class="fa fa-lock m-r-5"></i> ¿Olvidaste tu contraseña?</a>
                    </div>
                </div>
            </form> 
            
            </div>   
            </div>                              
                <div class="row">
					<div class="col-sm-12 text-center">
						<p>¿No tenés una cuenta? <a href="page-register.html" class="text-primary m-l-5"><b>Regístrate</b></a></p>
                    </div>
            </div>
            
        </div>
        
    	<script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
		<?php
			echo $this->Html->script('jquery.min.js');
			echo $this->Html->script('bootstrap.min.js');
			echo $this->Html->script('detect.js');
			echo $this->Html->script('fastclick.js');
			echo $this->Html->script('jquery.slimscroll.js');
			echo $this->Html->script('jquery.blockUI.js');
			echo $this->Html->script('waves.js');
			echo $this->Html->script('wow.min.js');
			echo $this->Html->script('jquery.nicescroll.js');
			echo $this->Html->script('jquery.scrollTo.min.js');
			echo $this->Html->script('jquery.core.js');
			echo $this->Html->script('jquery.app.js');
		?>
	
	</body>
</html>