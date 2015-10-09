jQuery(document).ready(function(){     
   $("body").on("click","#buscar",function(){
        $("#form_busqueda").submit();
    });    
    
    $("body").on('click',"#imprimir",function(){
        codigo   = $("#codigo").val();
        url = base_url+"index.php/ventas/acta/ver/"+codigo;
        window.open(url, this.target, 'width=800,height=400,top=150,left=200');
    });    
    
    $("body").on('click',"#cancelar",function(){
        window.close();
    });      
    
    $("body").on('click',"#grabar",function(){
        url        = base_url+"index.php/ventas/actaprofesor/grabar";
        dataString = $('#frmPersona').serialize();
        $.post(url,dataString,function(data){
            if(data=="true"){
                alert('Operacion realizada con exito');    
                window.close();
            }
            else if(data=="false"){
                alert('Hubo problemas con la grabación, vuelva a intentarlo.');
            }
        });            
    }); 
    
    $("body").on("click",".eliminar",function(){
       if(confirm('Esta seguro desea eliminar este registro?')){
            coddetalle = $(this).parent().parent().attr("id");
            dataString = "codigo="+coddetalle;
            url = base_url+"index.php/ventas/acta/eliminar";
            $.post(url,dataString,function(data){
                if(data=="true"){
                    //alert('Operacion realizada con exito');  
                    url = base_url+"index.php/ventas/acta/listar";
                    location.href = url;
                }
                else if(data=="false"){
                    alert("No se puede eliminar el registro");
                }
            });           
       }        
    });           
    
   $("body").on("click",".editar",function(){
        codigo = $(this).parent().parent().attr("id");
        dataString = "";    
        url = base_url+"index.php/ventas/acta/editar/e/"+codigo;
        $.post(url,dataString,function(data){
            $('#basic-modal-content').modal();
            $('#mensaje').html(data);
        });  
    });        
});