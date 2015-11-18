jQuery(document).ready(function(){
    $("#nuevo").click(function(){
        dataString = "";
        url = base_url+"index.php/ventas/profesor/editar/n";
        $.post(url,dataString,function(data){
            $('#basic-modal-content').modal();
            $('#mensaje').html(data);
        });

    });

    /*Ediciones*/
   $("body").on("click",".editar",function(){
        codigo = $(this).parent().parent().attr("id");
        dataString = "";    
        url = base_url+"index.php/ventas/profesor/editar/e/"+codigo;
        $.post(url,dataString,function(data){
            $('#basic-modal-content').modal();
            $('#mensaje').html(data);
        });  
    });       
    
    $("body").on('click',"#editar_experiencia",function(){
        dataString = "";
        url = base_url+"index.php/ventas/experiencia/editar/n/1/2";
        $.post(url,dataString,function(data){
            $('.tab_experiencia').show();
            $('.tab_experiencia').html(data);
        });
    });
    
    $("body").on('click',"#editar_estudios",function(){
        dataString = "";
        url = base_url+"index.php/ventas/estudio/editar/n/1/2";
        $.post(url,dataString,function(data){
            $('.tab_estudios').show();
            $('.tab_estudios').html(data);
        });
    });    
    
    $("body").on('click',"#editar_idiomas",function(){
        dataString = "";
        url = base_url+"index.php/ventas/estudioidiomas/editar/n/1/2";
        $.post(url,dataString,function(data){
            $('.tab_idiomas').show();
            $('.tab_idiomas').html(data);
        });
    });       
    
    $("body").on('click',"#editar_conferencia",function(){
        dataString = "";
        url = base_url+"index.php/ventas/conferencia/editar/n/1/2";
        $.post(url,dataString,function(data){
            $('.tab_conferencias').show();
            $('.tab_conferencias').html(data);
        });
    });    
    
    $("body").on('click',"#editar_sociedad",function(){
        dataString = "";
        url = base_url+"index.php/ventas/profesorsociedad/editar/n/1/2";
        $.post(url,dataString,function(data){
            $('.tab_sociedad').show();
            $('.tab_sociedad').html(data);
        });
    });      
    
    $("body").on('click',"#editar_empresa",function(){
        dataString = "";
        url = base_url+"index.php/ventas/trabajo/editar/n/1/2";
        $.post(url,dataString,function(data){
            $('.tab_empresa').show();
            $('.tab_empresa').html(data);
        });
    });         
    
    $('body').on('click',"#cancelar",function(){
        url = base_url+"index.php/ventas/profesor/listar";
        location.href = url;
    });

    $("body").on('mouseenter ',".lst_esperiencia ul,.lst_idiomas ul",function(){
        $(this).children().children().attr("style","background:#DCDCDC;");
    }); 
    
    $("body").on('mouseleave ',".lst_esperiencia ul,.lst_idiomas ul",function(){
        $(this).children().children().attr("style","background:#f4f7ff;");
    });    
    
    /*Grabaciones*/
    $("body").on('click',"#grabar",function(){
        url = base_url+"index.php/ventas/profesor/grabar";
        dataString  = $('#frmPersona').serialize();
        $.post(url,dataString,function(data){
            alert('Operacion realizada con exito');
            location.href = base_url+"index.php/ventas/profesor/listar/";  
        });
    });

    $("body").on('click',"#grabar_experiencia",function(){
        url = base_url+"index.php/ventas/experiencia/grabar";
        profesor = $("#codigo").val();
        dataString  = $('#frm_experiencia').serialize();
        dataString  = dataString+"&profesor="+profesor;
        $.post(url,dataString,function(data){
            //alert('Operacion realizada con exito');
            url2 = base_url+"index.php/ventas/experiencia/listar/"+profesor;
            $.post(url2,"",function(data2){
                $('#experiencia').html(data2); 
            });
        });
    });

    $("body").on('click',"#grabar_estudio",function(){
        url = base_url+"index.php/ventas/estudio/grabar";
        profesor = $("#codigo").val();
        dataString  = $('#frm_formacion').serialize();
        dataString  = dataString+"&profesor="+profesor;
        $.post(url,dataString,function(data){
            //alert('Operacion realizada con exito');
            url2 = base_url+"index.php/ventas/estudio/listar/"+profesor;
            $.post(url2,"",function(data2){
                $('#estudios').html(data2); 
            });
        });
    });

    $("body").on('click',"#grabar_idioma",function(){
        url = base_url+"index.php/ventas/estudioidiomas/grabar";
        profesor = $("#codigo").val();
        dataString  = $('#frm_idioma').serialize();
        dataString  = dataString+"&profesor="+profesor;
        $.post(url,dataString,function(data){
            //alert('Operacion realizada con exito');
            url2 = base_url+"index.php/ventas/estudioidiomas/listar/"+profesor;
            $.post(url2,"",function(data2){
                $('#idiomas').html(data2); 
            });
        });
    });

    $("body").on('click',"#grabar_conferencia",function(){
        url = base_url+"index.php/ventas/conferencia/grabar";
        profesor = $("#codigo").val();
        dataString  = $('#frm_conferencia').serialize();
        dataString  = dataString+"&profesor="+profesor;
        $.post(url,dataString,function(data){
            //alert('Operacion realizada con exito');
            url2 = base_url+"index.php/ventas/conferencia/listar/"+profesor;
            $.post(url2,"",function(data2){
                $('#conferencias').html(data2); 
            });
        });
    });

    $("body").on('click',"#grabar_sociedad",function(){
        url = base_url+"index.php/ventas/profesorsociedad/grabar";
        profesor = $("#codigo").val();
        dataString  = $('#frm_sociedades').serialize();
        dataString  = dataString+"&profesor="+profesor;
        $.post(url,dataString,function(data){
            //alert('Operacion realizada con exito');
            url2 = base_url+"index.php/ventas/profesorsociedad/listar/"+profesor;
            $.post(url2,"",function(data2){
                $('#sociedades').html(data2); 
            });
        });
    });

    $("body").on('click',"#grabar_trabajo",function(){
        url = base_url+"index.php/ventas/trabajo/grabar";
        profesor = $("#codigo").val();
        dataString  = $('#frm_empresa').serialize();
        dataString  = dataString+"&profesor="+profesor;
        $.post(url,dataString,function(data){
            //alert('Operacion realizada con exito');
            url2 = base_url+"index.php/ventas/trabajo/listar/"+profesor;
            $.post(url2,"",function(data2){
                $('#empresa').html(data2); 
            });
        });
    });

    /*Eliminar*/
    $("body").on("click",".eliminar",function(){
       if(confirm('Esta seguro desea eliminar este profesor?')){
            coddetalle = $(this).parent().parent().attr("id");
            dataString = "codigo="+coddetalle;
            url = base_url+"index.php/ventas/profesor/eliminar";
            $.post(url,dataString,function(data){
    //            if(data=="true"){
                    alert("El profesor se borro correctamente");
                    url = base_url+"index.php/ventas/profesor/listar";
                    location.href = url;
    //            }
    //            else{
    //                alert("No es posible eliminar a este alumno,\n esta matriculado en al menos 1 curso");
    //            }
            });         
       }        
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
    
    $("body").on('focus',"#fconferencia",function(){
         $(this).datepicker({
          dateFormat: "dd/mm/yy",
          changeYear: true,
          yearRange: "1945:2025"
         });
    });    
    
    $("body").on('focus',"#fafiliacion",function(){
         $(this).datepicker({
          dateFormat: "dd/mm/yy",
          changeYear: true,
          yearRange: "1945:2025"
         });
    });       
});

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
