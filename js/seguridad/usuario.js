jQuery(document).ready(function(){
    
//    $('ul li:has(ul)').hover(function(e) {
//         $(this).find('ul').css({display: "block"});
//     },
//     function(e) {
//         $(this).find('ul').css({display: "none"});
//     });   
     
$(".nav li").hover(function(){
   $(this).find('ul:first:hidden').css({visibility: "visible",display: "none"}).slideDown(600);    
 },function(){
	 $(this).find('ul:first').slideUp(100);  });      
     
    $("#nuevo").click(function(){
        dataString = "";
        url = base_url+"index.php/seguridad/usuario/editar/n";
        $.post(url,dataString,function(data){
            $('#basic-modal-content').modal();
            $('#mensaje').html(data);
        });             
    });	
    
    $("#grabar").click(function(){
        url = base_url+"index.php/seguridad/usuario/grabar";
        dataString  = $('#form1').serialize();
        $.post(url,dataString,function(data){
            alert('Operacion realizada con exito');
            location.href = base_url+"index.php/seguridad/usuario/listar";
        });          
    });    
    
    $("#limpiar").click(function(){
        url = base_url+"index.php/seguridad/usuario/listar";
        $("#nombre_unidadmedida").val('');
        $("#simbolo").val('');
        location.href=url;
    });
    
    $("#cancelar").click(function(){
        url = base_url+"index.php/seguridad/usuario/listar";
        location.href = url;
    });  
    
    $("#buscar").click(function(){
	$("#frmBusqueda").submit();
    });	    
    
    $("#salir").click(function(){
        window.close();
    });   
});
function editar(codigo){
    dataString = "codigo="+codigo;    
    url = base_url+"index.php/seguridad/usuario/editar/e/"+codigo;
    $.post(url,dataString,function(data){
        $('#basic-modal-content').modal();
        $('#mensaje').html(data);
    }); 
}
function eliminar(codigo){
    if(confirm('Esta seguro desea eliminar este unidad de medida?')){
        dataString = "codigo="+codigo;
        url = base_url+"index.php/seguridad/usuario/eliminar";
        $.post(url,dataString,function(data){
            url = base_url+"index.php/seguridad/usuario/listar";
            location.href = url;
        });
    }
}