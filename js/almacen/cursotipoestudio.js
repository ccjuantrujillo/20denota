jQuery(document).ready(function(){
    $('ul li:has(ul)').hover(function(e) {
         $(this).find('ul').css({display: "block"});
     },
     function(e) {
         $(this).find('ul').css({display: "none"});
     });   
     
    $("body").on("click","#nuevo",function(){
        dataString = "";
        url = base_url+"index.php/almacen/cursotipoestudio/editar/n";
        $.post(url,dataString,function(data){
            $('#basic-modal-content').modal();
            $('#mensaje').html(data);
        });             
    });
   
    $("body").on("click","#buscar",function(){
	$("#frmBusqueda").submit();
    });	

    $("body").on("click","#limpiar",function(){
        url = base_url+"index.php/almacen/cursotipoestudio/listar";
        location.href=url;
    });
    
    $("body").on("click","#grabar",function(){
        url = base_url+"index.php/almacen/cursotipoestudio/grabar";
        dataString  = $('#frmPersona').serialize();
        //alert(dataString);
        $.post(url,dataString,function(data){
            alert('Operacion realizada con exito');
            location.href = base_url+"index.php/almacen/cursotipoestudio/listar";
        });        
        
    });    
    
    $("body").on("click","#cancelar",function(){
        url = base_url+"index.php/almacen/cursotipoestudio/listar";
        location.href = url;
    }); 

   $("body").on('change',"#ciclo",function(){
       accion      = $("#accion").val();
       codigo      = $("#codigo").val();
       dataString  = $('#frmPersona').serialize();
       url = base_url+"index.php/almacen/cursotipoestudio/editar/"+accion+"/"+codigo;
       $.post(url,dataString,function(data){
           $('#mensaje').html(data);
       });             
   });        
});

function ver_familia(){
    url           = base_url+"index.php/almacen/familia/nuevo";
    window.open(url,"_blank","width=500,height=400,scrollbars=yes,status=yes,resizable=yes,screenx=0,screeny=0");
}

function editar(codigo){
    dataString = "codigo="+codigo;    
    url = base_url+"index.php/almacen/cursotipoestudio/editar/e/"+codigo;
    $.post(url,dataString,function(data){
        $('#basic-modal-content').modal();
        $('#mensaje').html(data);
    }); 
}

function eliminar(codigo){
    if(confirm('Esta seguro desea eliminar este curso?')){
        dataString = "codigo="+codigo;
        url = base_url+"index.php/almacen/cursotipoestudio/eliminar";
        $.post(url,dataString,function(data){
            obj = jQuery.parseJSON(data);
            if(obj){
                //alert('Operacion realizada con exito');  
                url = base_url+"index.php/almacen/cursotipoestudio/listar";
                location.href = url;                
            }
            else{
                alert("No puede eliminar un video que tiene cursos ingresados.");
            }
        });
    }
}

function isImage(extension){
    switch(extension.toLowerCase()) 
    {
        case 'jpg': case 'gif': case 'png': case 'jpeg':
            return true;
        break;
        default:
            return false;
        break;
    }
}