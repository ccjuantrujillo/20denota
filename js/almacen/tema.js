jQuery(document).ready(function(){
//    $('ul li:has(ul)').hover(function(e) {
//         $(this).find('ul').css({display: "block"});
//     },
//     function(e) {
//         $(this).find('ul').css({display: "none"});
//     });       
     
    $("body").on("click","#nuevo",function(){
        dataString = "";
        url = base_url+"index.php/almacen/tema/editar/n";
        $.post(url,dataString,function(data){
            $('#basic-modal-content').modal();
            $('#mensaje').html(data);
        });             
    });     

    $("body").on("click","#limpiar",function(){
        url = base_url+"index.php/almacen/tema/listar";
        location.href=url;
    });
    
    $("body").on("click","#grabar",function(){
        url = base_url+"index.php/almacen/tema/grabar";
        dataString  = $('#frmPersona').serialize();
        $.post(url,dataString,function(data){
            alert('Operacion realizada con exito');
            location.href = base_url+"index.php/almacen/tema/listar";
        });        
        
    });
    
    $("body").on("click","#cancelar",function(){
        url = base_url+"index.php/almacen/tema/listar";
        location.href = url;
    });  
    
   $("body").on('change',"select",function(){
       accion      = $("#accion").val();
       codigo      = $("#codigo").val();
       dataString  = $('#frmPersona').serialize();
       url = base_url+"index.php/almacen/tema/editar/"+accion+"/"+codigo;
       $.post(url,dataString,function(data){
           $('#mensaje').html(data);
       });             
   });      
   
//   $("body").on('change',"#curso",function(){
//       accion      = $("#accion").val();
//       codigo      = $("#codigo").val();
//       dataString  = $('#frmPersona').serialize();
//       url = base_url+"index.php/almacen/tema/editar/"+accion+"/"+codigo;
//       $.post(url,dataString,function(data){
//           $('#mensaje').html(data);
//       });             
//   });     
//   
//   $("body").on('change',"#tipoestudio",function(){
//       accion      = $("#accion").val();
//       codigo      = $("#codigo").val();
//       dataString  = $('#frmPersona').serialize();
//       url = base_url+"index.php/almacen/tema/editar/"+accion+"/"+codigo;
//       $.post(url,dataString,function(data){
//           $('#mensaje').html(data);
//       });             
//   });      
});

function editar(codigo){
    dataString = "codigo="+codigo;    
    url = base_url+"index.php/almacen/tema/editar/e/"+codigo;
    $.post(url,dataString,function(data){
        $('#basic-modal-content').modal();
        $('#mensaje').html(data);
    });           
}

function eliminar(codigo){
    if(confirm('Esta seguro desea eliminar este tema?')){
        dataString = "codigo="+codigo;
        url = base_url+"index.php/almacen/tema/eliminar";
        $.post(url,dataString,function(data){
            url = base_url+"index.php/almacen/tema/listar";
            location.href = url;
        });
    }
}