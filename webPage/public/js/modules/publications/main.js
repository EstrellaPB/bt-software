$(document).ready(function() {
	jQuery.validator.addMethod("macFormat", function(value, element) {
	  return /^([0-9A-F]{2}:){5}[0-9A-F]{2}$/.test(value);
	}, "Ingrese una dirección MAC válida");


});
	