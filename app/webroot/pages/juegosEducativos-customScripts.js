$(document).ready(function () {
	$("#cantidadPreguntasSlider").ionRangeSlider({
        min: 1,
        max: 10,
		step: 1
    });
	
	$("#tiempoPreguntasSlider").ionRangeSlider({
        min: 30,
        max: 120,
		step: 30
    });
});