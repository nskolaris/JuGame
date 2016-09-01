<?php echo $this->Form->create('Usuario',array('action'=>'login')); ?>
<?php echo $this->Form->input('Usuario.email',array('label'=>'E-mail')); ?>
<?php echo $this->Form->input('Usuario.password',array('label'=>'Contraseña','type'=>'password')); ?>
<?php echo $this->Form->end('Ingresar'); ?>