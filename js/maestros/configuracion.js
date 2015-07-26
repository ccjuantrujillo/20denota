jQuery(document).ready(function(){
	base_url   = $("#base_url").val();
 	$("#imgGuardarConfiguracion").click(function(){
		$("#frmConfiguracion").submit();
	}); 
	$("#imgLimpiarConfiguracion").click(function(){
		url = base_url+"index.php/maestros/configuracion";
		location.href = url;	
	});
	$("#imgCancelarConfiguracion").click(function(){
		url = base_url+"index.php/maestros/configuracion";
		location.href = url;		
	});	
});
function cargar_configuracion_detalle(compania){
     dataString = "compania="+compania;
	 if(compania!=''){
		 url = base_url+"index.php/maestros/configuracion/cargar_configuracion_detalle";
		 $.post(url,dataString,function(data){
			  $("#divSecundario").html(data);
		 });
	 }
	 else{
		alert("Debe seleccionar una empresa.");
	 }
}