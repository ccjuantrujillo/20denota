jQuery(document).ready(function(){
//    $('ul li:has(ul)').hover(function(e) {
//         $(this).find('ul').css({display: "block"});
//     },
//     function(e) {
//         $(this).find('ul').css({display: "none"});
//     });        
    
    $("body").on("click","#nuevo",function(){
        dataString = "";
        url = base_url+"index.php/almacen/semana/editar/n";
        $.post(url,dataString,function(data){
            $('#basic-modal-content').modal();
            $('#mensaje').html(data);
        });             
    }); 

    $("body").on("click","#limpiar",function(){
        url = base_url+"index.php/almacen/curso/listar";
        location.href=url;
    });
    
    $("body").on("click","#grabar",function(){
        url = base_url+"index.php/almacen/semana/grabar";
        dataString  = $('#frmPersona').serialize();
        $.post(url,dataString,function(data){
            alert('Operacion realizada con exito');
            location.href = base_url+"index.php/almacen/semana/listar";
        });        
        
    });
    
    $("body").on("click","#cancelar",function(){
        url = base_url+"index.php/almacen/semana/listar";
        location.href = url;
    });  
    
   $("body").on('change',"#ciclo",function(){
       accion      = $("#accion").val();
       codigo      = $("#codigo").val();
       dataString  = $('#frmPersona').serialize();
       url = base_url+"index.php/almacen/semana/editar/"+accion+"/"+codigo;
       $.post(url,dataString,function(data){
           $('#mensaje').html(data);
       });             
   });      
   
    $("body").on('focus',"#finicio",function(){
         $(this).datepicker({
          dateFormat: "dd/mm/yy",
          changeYear: true,
          yearRange: "1945:2025"
         });
    });   
    
    $("body").on('focus',"#ffin",function(){
         $(this).datepicker({
          dateFormat: "dd/mm/yy",
          changeYear: true,
          yearRange: "1945:2025"
         });
    });       
});

function editar(codigo){
    dataString = "codigo="+codigo;    
    url = base_url+"index.php/almacen/semana/editar/e/"+codigo;
    $.post(url,dataString,function(data){
        $('#basic-modal-content').modal();
        $('#mensaje').html(data);
    });           
}

function eliminar(codigo){
    if(confirm('Esta seguro desea eliminar esta semana?')){
        dataString = "codigo="+codigo;
        url = base_url+"index.php/almacen/semana/eliminar";
        $.post(url,dataString,function(data){
            obj = jQuery.parseJSON(data);
            if(obj){
                alert('Operacion realizada con exito');  
                url = base_url+"index.php/almacen/semana/listar";
                location.href = url;                
            }
            else{
                alert("No se puede eliminar el registro,\nel video tiene preguntas ingresadas");
            }
        });
    }
}