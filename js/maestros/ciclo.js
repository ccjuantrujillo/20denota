jQuery(document).ready(function(){
//    $('ul li:has(ul)').hover(function(e) {
//         $(this).find('ul').css({display: "block"});
//     },
//     function(e) {
//         $(this).find('ul').css({display: "none"});
//     });

    $("#nuevo").click(function(){
        dataString = "";
        url = base_url+"index.php/maestros/ciclo/editar/n";
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
        url = base_url+"index.php/maestros/ciclo/listar";
        location.href = url;
    });

//    $("#cerrar").click(function(){
//        url = base_url+"index.php/inicio/index";
//        location.href = url;
//    });

    $("body").on('click',"#grabar",function(){
        url = base_url+"index.php/maestros/ciclo/grabar";
        dataString  = $('#frmPersona').serialize();
        $.post(url,dataString,function(data){
            alert('Operacion realizada con exito');
            location.href = base_url+"index.php/maestros/ciclo/listar";
        });
    });

    $("body").on("click","#logo",function(){
        url = base_url+"index.php/inicio/principal";
        location.href = url;
    });

  $("body").on('focus',"#fnacimiento",function(){
       $(this).datepicker({
        dateFormat: "dd/mm/yy",
        changeYear: true,
        yearRange: "1945:2025"
       });
  });
});

function editar(codigo){
    dataString = "codigo="+codigo;
    url = base_url+"index.php/maestros/ciclo/editar/e/"+codigo;
    $.post(url,dataString,function(data){
        $('#basic-modal-content').modal();
        $('#mensaje').html(data);
    });
}

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

function abrir_formulario_ubigeo(){
	ubigeo = $("#cboNacimiento").val();
	url = base_url+"index.php/maestros/ubigeo/formulario_ubigeo/"+ubigeo;
	window.open(url,'Formulario Ubigeo','menubar=no,resizable=no,width=200,height=180');
}

function selecciona_familia(codigo){
    window.opener.selecciona_familia(codigo);
    window.close();
}