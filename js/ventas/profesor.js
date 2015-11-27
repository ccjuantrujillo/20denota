jQuery(document).ready(function(){
    /*Nuevo*/
    $("#nuevo").click(function(){
        dataString = "";
        url = base_url+"index.php/ventas/profesor/editar/n";
        $.post(url,dataString,function(data){
            $('#basic-modal-content').modal();
            $('#mensaje').html(data);
        });
    });

   $("body").on("click","#nueva_experiencia",function(){
        dataString = "";
        url = base_url+"index.php/ventas/experiencia/editar/n/1/2";
        $.post(url,dataString,function(data){
            $('.tab_experiencia').show();
            $('.tab_experiencia').html(data);
        }); 
    });     
    
    $("body").on('click',"#nuevo_idioma",function(){
        dataString = "";
        url = base_url+"index.php/ventas/estudioidiomas/editar/n/1/2";
        $.post(url,dataString,function(data){
            $('.tab_idiomas').show();
            $('.tab_idiomas').html(data);
        });
    });  
    
    $("body").on('click',"#nuevo_estudio",function(){
        dataString = "";
        url = base_url+"index.php/ventas/estudio/editar/n/1/2";
        $.post(url,dataString,function(data){
            $('.tab_estudios').show();
            $('.tab_estudios').html(data);
        });
    });  
    
    $("body").on('click',"#nueva_conferencia",function(){
        dataString = "";
        url = base_url+"index.php/ventas/conferencia/editar/n/1/2";
        $.post(url,dataString,function(data){
            $('.tab_conferencias').show();
            $('.tab_conferencias').html(data);
        });
    });      

    $("body").on('click',"#nueva_sociedad",function(){
        dataString = "";
        url = base_url+"index.php/ventas/profesorsociedad/editar/n/1/2";
        $.post(url,dataString,function(data){
            $('.tab_sociedad').show();
            $('.tab_sociedad').html(data);
        });
    });    

    $("body").on('click',"#nuevo_trabajo",function(){
        dataString = "";
        url = base_url+"index.php/ventas/trabajo/editar/n/1/2";
        $.post(url,dataString,function(data){
            $('.tab_empresa').show();
            $('.tab_empresa').html(data);
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
    
    $("body").on('click',".editar_experiencia",function(){
        codigo = $(this).parent().parent().attr("id");
        dataString = "";    
        url = base_url+"index.php/ventas/experiencia/editar/e/"+codigo;
        $.post(url,dataString,function(data){
            $('.tab_experiencia').show();
            $('.tab_experiencia').html(data); 
        });
    });
    
     $("body").on('click',".editar_estudio",function(){
        codigo = $(this).parent().parent().attr("id");
        dataString = "";
        url = base_url+"index.php/ventas/estudio/editar/e/"+codigo;
        $.post(url,dataString,function(data){
            $('.tab_estudios').show();
            $('.tab_estudios').html(data);
        });
    });       
    
    $("body").on('click',".editar_idioma",function(){
        codigo = $(this).parent().parent().attr("id");
        dataString = "";    
        url = base_url+"index.php/ventas/estudioidiomas/editar/e/"+codigo;
        $.post(url,dataString,function(data){
            $('.tab_idiomas').show();
            $('.tab_idiomas').html(data); 
        });
    });    
    
    $("body").on('click',".editar_conferencia",function(){
        codigo = $(this).parent().parent().attr("id");
        dataString = "";
        url = base_url+"index.php/ventas/conferencia/editar/e/"+codigo;
        $.post(url,dataString,function(data){
            $('.tab_conferencias').show();
            $('.tab_conferencias').html(data);
        });
    });    
    
    $("body").on('click',".editar_sociedad",function(){
        codigo = $(this).parent().parent().attr("id");
        dataString = "";
        url = base_url+"index.php/ventas/profesorsociedad/editar/e/"+codigo;
        $.post(url,dataString,function(data){
            $('.tab_sociedad').show();
            $('.tab_sociedad').html(data);
        });
    });      
    
    $("body").on('click',".editar_trabajo",function(){
        codigo = $(this).parent().parent().attr("id");
        dataString = "";
        url = base_url+"index.php/ventas/trabajo/editar/e/"+codigo;
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
        profesor    = $("#codigo").val();
        universidad = $("#universidad").val();
        mesi        = $("#mesi").val();
        anoi        = $("#anoi").val();
        mesf        = $("#mesf").val();
        anof        = $("#anof").val();        
        dataString  = $('#frm_experiencia').serialize();
        dataString  = dataString+"&profesor="+profesor;
        if(universidad=0){
            alert("Debe seleccionar una institucion");
        }
        else if(mesi=="00" || mesf=="00"){
            alert("Debe seleccionar un mes");
        }        
        else if(anoi==0 || anof==0){
            alert("Debe seleccionar un año");
        }
        else{
            $.post(url,dataString,function(data){
                //alert('Operacion realizada con exito');
                url2 = base_url+"index.php/ventas/experiencia/listar/"+profesor;
                $.post(url2,"",function(data2){
                    $('#experiencia').html(data2); 
                });
            }); 
        }
    });

    $("body").on('click',"#grabar_estudio",function(){
        url = base_url+"index.php/ventas/estudio/grabar";
        profesor = $("#codigo").val();
        universidad = $("#universidadestudio").val();
        grado       = $("#grado").val();
        mesi        = $("#mesi").val();
        anoi        = $("#anoi").val();
        mesf        = $("#mesf").val();
        anof        = $("#anof").val();         
        dataString  = $('#frm_formacion').serialize();
        dataString  = dataString+"&profesor="+profesor;
        if(universidad==0){
            alert("Debe seleccionar una universidad");
        }
        else if(grado==0){
            alert("Debe seleccionar un nivel de estudios");
        }        
        else if(mesi=="00" || mesf=="00"){
            alert("Debe seleccionar un mes");
        }        
        else if(anoi==0 || anof==0){
            alert("Debe seleccionar un año");
        }        
        else{
            $.post(url,dataString,function(data){
                //alert('Operacion realizada con exito');
                url2 = base_url+"index.php/ventas/estudio/listar/"+profesor;
                $.post(url2,"",function(data2){
                    $('#estudios').html(data2); 
                });
            });   
        }
    });

    $("body").on('click',"#grabar_idioma",function(){
        url = base_url+"index.php/ventas/estudioidiomas/grabar";
        profesor    = $("#codigo").val();
        idioma      = $("#idioma").val();
        nivel       = $("#nivel").val();
        mesi        = $("#mesi").val();
        anoi        = $("#anoi").val();
        mesf        = $("#mesf").val();
        anof        = $("#anof").val();         
        dataString  = $('#frm_idioma').serialize();
        dataString  = dataString+"&profesor="+profesor;
        if(idioma==0){
            alert("Debe seleccionar un idioma");
        }
        else if(nivel==0){
            alert("Debe seleccionar un nivel");
        }        
        else if(mesi=="00" || mesf=="00"){
            alert("Debe seleccionar un mes");
        }        
        else if(anoi==0 || anof==0){
            alert("Debe seleccionar un año");
        }           
        else{
            $.post(url,dataString,function(data){
                //alert('Operacion realizada con exito');
                url2 = base_url+"index.php/ventas/estudioidiomas/listar/"+profesor;
                $.post(url2,"",function(data2){
                    $('#idiomas').html(data2); 
                });
            });            
        }
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
        empresa  = $("#empresa").val();
        mesi     = $("#mesi").val();
        anoi     = $("#anoi").val();
        mesf     = $("#mesf").val();
        anof     = $("#anof").val();          
        dataString = $('#frm_empresa').serialize();
        dataString = dataString+"&profesor="+profesor;    
        if(mesi=="00" || mesf=="00"){
            alert("Debe seleccionar un mes");
        }        
        else if(anoi=="00" || anof=="00"){
            alert("Debe seleccionar un año");
        }   
        else{
            $.post(url,dataString,function(data){
                //alert('Operacion realizada con exito');
                url2 = base_url+"index.php/ventas/trabajo/listar/"+profesor;
                $.post(url2,"",function(data2){
                    $('#empresa').html(data2); 
                });
            });            
        }
    });

    /*Eliminar*/
    $("body").on("click",".eliminar",function(){
       if(confirm('Esta seguro desea eliminar este profesor?, todos los registros asociados al profesor seran borrados.')){
            coddetalle = $(this).parent().parent().attr("id");
            dataString = "codigo="+coddetalle;
            url = base_url+"index.php/ventas/profesor/borrar";
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
    
    $("body").on('click',".eliminar_experiencia",function(){
        if(confirm('Esta seguro desea eliminar esta experiencia?')){
            codigo = $(this).parent().parent().attr("id");  
            url = base_url+"index.php/ventas/experiencia/eliminar/";
            profesor = $("#codigo").val();
            objRes = new Object();
            objRes.experiencia = codigo;
            dataString   = {objeto: JSON.stringify(objRes)};             
            $.post(url,dataString,function(data){
                url2 = base_url+"index.php/ventas/experiencia/listar/"+profesor;
                $.post(url2,"",function(data2){
                    $('#experiencia').html(data2); 
                });
            });            
        }
    });    
    
    $("body").on('click',".eliminar_estudio",function(){
        if(confirm('Esta seguro desea eliminar este estudio?')){
            codigo = $(this).parent().parent().attr("id");  
            url = base_url+"index.php/ventas/estudio/eliminar/";
            profesor = $("#codigo").val();
            objRes = new Object();
            objRes.estudio = codigo;
            dataString   = {objeto: JSON.stringify(objRes)};             
            $.post(url,dataString,function(data){
                url2 = base_url+"index.php/ventas/estudio/listar/"+profesor;
                $.post(url2,"",function(data2){
                    $('#estudios').html(data2); 
                });
            });            
        }
    });      

    $("body").on('click',".eliminar_idioma",function(){
        if(confirm('Esta seguro desea eliminar este idioma?')){
            codigo = $(this).parent().parent().attr("id");  
            url = base_url+"index.php/ventas/estudioidiomas/eliminar/";
            profesor = $("#codigo").val();
            objRes = new Object();
            objRes.estudioidioma = codigo;
            dataString   = {objeto: JSON.stringify(objRes)};             
            $.post(url,dataString,function(data){
                url2 = base_url+"index.php/ventas/estudioidiomas/listar/"+profesor;
                $.post(url2,"",function(data2){
                    $('#idiomas').html(data2); 
                });
            });            
        }
    });    
    
    $("body").on('click',".eliminar_conferencia",function(){
        if(confirm('Esta seguro desea eliminar esta conferencia?')){
            codigo = $(this).parent().parent().attr("id");  
            url = base_url+"index.php/ventas/conferencia/eliminar/";
            profesor = $("#codigo").val();
            objRes = new Object();
            objRes.conferencia = codigo;
            dataString   = {objeto: JSON.stringify(objRes)};             
            $.post(url,dataString,function(data){
                url2 = base_url+"index.php/ventas/conferencia/listar/"+profesor;
                $.post(url2,"",function(data2){
                    $('#conferencias').html(data2); 
                });
            });            
        }
    });       

    $("body").on('click',".eliminar_sociedad",function(){
        if(confirm('Esta seguro desea eliminar esta sociedad?')){
            codigo = $(this).parent().parent().attr("id");  
            url = base_url+"index.php/ventas/profesorsociedad/eliminar/";
            profesor = $("#codigo").val();
            objRes = new Object();
            objRes.profesorsociedad = codigo;
            dataString   = {objeto: JSON.stringify(objRes)};             
            $.post(url,dataString,function(data){
                url2 = base_url+"index.php/ventas/profesorsociedad/listar/"+profesor;
                $.post(url2,"",function(data2){
                    $('#sociedades').html(data2); 
                });
            });            
        }
    });  
    
    $("body").on('click',".eliminar_trabajo",function(){
        if(confirm('Esta seguro desea eliminar esta empresa?')){
            codigo = $(this).parent().parent().attr("id");  
            url = base_url+"index.php/ventas/trabajo/eliminar/";
            profesor = $("#codigo").val();
            objRes = new Object();
            objRes.trabajo = codigo;
            dataString   = {objeto: JSON.stringify(objRes)};             
            $.post(url,dataString,function(data){
                url2 = base_url+"index.php/ventas/trabajo/listar/"+profesor;
                $.post(url2,"",function(data2){
                    $('#empresa').html(data2); 
                });
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
    
    $("body").on('click',"#tab-2",function(){
        codigo = $("#codigo").val();
        if(codigo==""){
            $("#content-2").css("opacity",0);
            $("#content-1").css("opacity",1);            
            alert('Primero debe grabar los datos principales');   
        }
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
