jQuery(document).ready(function(){
    $("#nuevo").click(function(){
        dataString = "";
        url = base_url+"index.php/ventas/profesor/editar/n";
        $.post(url,dataString,function(data){
            $('#basic-modal-content').modal();
            $('#mensaje').html(data);
        });

    });

    $('body').on('click',"#cancelar",function(){
        url = base_url+"index.php/ventas/profesor/listar";
        location.href = url;
    });

    $("body").on('click',"#anadir_experiencia",function(){
        $("#accion_exp").val("n");
        $('.tab_experiencia').show();
        
    });

    $("body").on('click',"#grabar",function(){
        url = base_url+"index.php/ventas/profesor/grabar";
        dataString  = $('#frmPersona').serialize();
        $.post(url,dataString,function(data){
            alert('Operacion realizada con exito');
            location.href = base_url+"index.php/ventas/profesor/listar";
        });
    });

    $("body").on('click',"#grabar_experiencia",function(){
        url = base_url+"index.php/ventas/experiencia/grabar";
        profesor = $("#codigo").val();
        dataString  = $('#frm_experiencia').serialize();
        dataString  = dataString+"&profesor="+profesor;
        alert(dataString);
        $.post(url,dataString,function(data){
            alert('Operacion realizada con exito');
            //location.href = base_url+"index.php/ventas/experiencia/listar";
        });
    });

    $("body").on('click',"#grabar_estudio",function(){
        url = base_url+"index.php/ventas/estudios/grabar";
        dataString  = $('#frm_formacion').serialize();
        $.post(url,dataString,function(data){
            alert('Operacion realizada con exito');
            //location.href = base_url+"index.php/ventas/profesor/listar";
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
    url = base_url+"index.php/ventas/profesor/editar/e/"+codigo;
    $.post(url,dataString,function(data){
        $('#basic-modal-content').modal();
        $('#mensaje').html(data);
    });
}

function eliminar(codigo){
    if(confirm('Esta seguro desea eliminar este alumno?')){
        dataString = "codigo="+codigo;
        url = base_url+"index.php/ventas/profesor/eliminar";
        $.post(url,dataString,function(data){
//            if(data=="true"){
                alert("El alumno se borro correctamente");
                url = base_url+"index.php/ventas/profesor/listar";
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

function selecciona_profesor(codigo){
    window.opener.selecciona_profesor(codigo); 
    window.close();
}

function selecciona_profesor2(codigo){
    window.opener.selecciona_profesor2(codigo); 
    window.close();
}
