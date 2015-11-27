jQuery(document).ready(function(){
    
    $("body").on("click","#nuevo",function(){
        dataString = "";
        url = base_url+"index.php/maestros/empresa/editar/n";
        $.post(url,dataString,function(data){
            $('#basic-modal-content').modal();
            $('#mensaje').html(data);
        });
    });
    
   $("body").on("click",".editar",function(){
        codigo = $(this).parent().parent().attr("id");
        dataString = "";    
        url = base_url+"index.php/maestros/empresa/editar/e/"+codigo;
        $.post(url,dataString,function(data){
            $('#basic-modal-content').modal();
            $('#mensaje').html(data);
        });  
    });   
    
    $("body").on("click",".eliminar",function(){
       if(confirm('Esta seguro desea eliminar esta empresa?')){
            codigo = $(this).parent().parent().attr("id");
            url = base_url+"index.php/maestros/empresa/eliminar";
            objRes = new Object();
            objRes.empresa = codigo;
            dataString   = {objeto: JSON.stringify(objRes)};                
            $.post(url,dataString,function(data){
                location.href = base_url+"index.php/maestros/empresa/listar";
            });         
       }        
    });     
    
    $('body').on('click',"#cancelar",function(){
        url = base_url+"index.php/maestros/empresa/listar";
        location.href = url;
    });  

    $("body").on('click',"#grabar",function(){
        url = base_url+"index.php/maestros/empresa/grabar";
        dataString  = $('#frmEmpresa').serialize();
        $.post(url,dataString,function(data){
            alert('Operacion realizada con exito');
            location.href = base_url+"index.php/maestros/empresa/listar/";  
        });
    });
 
    $("body").on('focus',"#fecha",function(){
         $(this).datepicker({
          dateFormat: "dd/mm/yy",
          changeYear: true,
          yearRange: "1945:2025"
         });
    });   
  
});