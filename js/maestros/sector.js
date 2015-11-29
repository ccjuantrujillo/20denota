jQuery(document).ready(function(){
    $("#nuevo").click(function(){
        dataString = "";
        url = base_url+"index.php/maestros/sector/editar/n";
        $.post(url,dataString,function(data){
            $('#basic-modal-content').modal();
            $('#mensaje').html(data);
        });

    });

//    $("#imprimir").click(function(){
//        codigo   = $("#codigo").val();
//        url = base_url+"index.php/ventas/cliente/ver/"+codigo;
//        window.open(url, this.target, 'width=800,height=400,top=150,left=200');
//    });

    $('body').on('click',"#cancelar",function(){
        url = base_url+"index.php/maestros/sector/listar";
        location.href = url;
    });

  $("body").on("click",".editar",function(){
        codigo = $(this).parent().parent().attr("id");
        dataString = "";    
        url = base_url+"index.php/maestros/sector/editar/e/"+codigo;
        $.post(url,dataString,function(data){
            $('#basic-modal-content').modal();
            $('#mensaje').html(data);
        });      
    });  

    $("body").on('click',"#grabar",function(){
        url = base_url+"index.php/maestros/ciclo/grabar";
        dataString  = $('#frmPersona').serialize();
        $.post(url,dataString,function(data){
            alert('Operacion realizada con exito');
            location.href = base_url+"index.php/maestros/ciclo/listar";
        });
    });

});

//function editar(codigo){
//    dataString = "codigo="+codigo;
//    url = base_url+"index.php/maestros/ciclo/editar/e/"+codigo;
//    $.post(url,dataString,function(data){
//        $('#basic-modal-content').modal();
//        $('#mensaje').html(data);
//    });
//}

function eliminar(codigo){
    if(confirm('Esta seguro desea eliminar este ciclo?')){
        dataString = "codigo="+codigo;
        url = base_url+"index.php/maestros/ciclo/eliminar";
        $.post(url,dataString,function(data){
//            if(data=="true"){
                alert("El ciclo se borro correctamente");
                url = base_url+"index.php/maestros/ciclo/listar";
                location.href = url;
//            }
//            else{
//                alert("No es posible eliminar a este alumno,\n esta matriculado en al menos 1 curso");
//            }
        });
    }
}