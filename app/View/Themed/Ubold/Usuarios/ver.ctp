
<?php var_dump($this->data); ?>

<?php switch($this->data['Usuario']['rol_id']){
	case 1:
	?><h1><?php echo $this->data['Usuario']['nombre'].' '.$this->data['Usuario']['apellido']; ?></h1><?php
	break;
	
	case 2:
	?><h1><?php echo $this->data['Usuario']['nombre'].' '.$this->data['Usuario']['apellido']; ?></h1><?php
	break;
	
	case 3:
	?><h1><?php echo $this->data['Usuario']['nombre'].' '.$this->data['Usuario']['apellido']; ?></h1><?php
	break;
	
	case 4:
	?><h1><?php echo $this->data['Usuario']['nombre'].' '.$this->data['Usuario']['apellido']; ?></h1><?php
	break;
} ?>