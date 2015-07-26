var base_url;
jQuery(document).ready(function(){
	base_url   = $("#base_url").val();
	$("#nuevoEstablecimiento").click(function(){
		url = base_url+"index.php/maestros/establecimiento/nuevo_establecimiento";
		location.href = url;
	});	
 	$("#grabarEstablecimiento").click(function(){
		$("#frmEstablecimiento").submit();	
	}); 
	$("#limpiarEstablecimiento").click(function(){
            url = base_url+"index.php/maestros/establecimiento/establecimientos";
            $("#txtEstablecimiento").val('');
            location.href=url;
	});
	$("#cancelarEstablecimiento").click(function(){
		url = base_url+"index.php/maestros/establecimiento/establecimientos";
		location.href = url;		
	});
	$("#buscarEstablecimiento").click(function(){
            $("#form_busquedaEstablecimiento").submit();
	});
	$("#frmEstablecimiento").validate({
		event    : "blur",
		rules    : {'txtNombres' : "required"},
		debug    : true,
		errorElement   : "label",
		errorContainer : $("#errores"),
		submitHandler  : function(form){
			nombres    = $("#txtEstablecimiento").val();
			modo       = $("#modo").val();
			codigo     = $("#codigo").val();			
			dataString = "codigo="+codigo+"&nombres="+nombres;
			$('#VentanaTransparente').css("display","block");
			if(modo=='insertar'){
				url = base_url+"index.php/maestros/establecimiento/insertar_establecimiento";
				$.post(url,dataString,function(data){	
					$("#VentanaTransparente").css("display","none");
					alert('Se ha insertado un nuevo establecimiento.');
					location.href = base_url+"index.php/maestros/establecimiento/establecimientos";
				});		
			}
			else if(modo=='modificar'){
				url = base_url+"index.php/maestros/establecimiento/modificar_establecimiento";
				$.post(url,dataString,function(data){	
					$("#VentanaTransparente").css("display","none");
					location.href = base_url+"index.php/maestros/establecimiento/establecimientos";
				});				
			}
		}
	}); 
});
function editar_establecimiento(establecimiento){
	location.href = base_url+"index.php/maestros/establecimiento/editar_establecimiento/"+establecimiento;
}
function eliminar_establecimiento(establecimiento){
	if(confirm('¿Está seguro que desea eliminar este establecimiento?')){
		dataString        = "establecimiento="+establecimiento;
		$.post("eliminar_establecimiento",dataString,function(data){
			location.href = base_url+"index.php/maestros/establecimiento/establecimientos";		
		});			
	}
}
function ver_establecimiento(establecimiento){
	location.href = base_url+"index.php/maestros/establecimiento/ver_establecimiento/"+establecimiento;
}
function atras_establecimiento(){
	location.href = base_url+"index.php/maestros/establecimiento/establecimientos";
}