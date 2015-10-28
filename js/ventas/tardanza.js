jQuery(document).ready(function(){
    $("#nuevo").click(function(){
        dataString = "";
        url = base_url+"index.php/ventas/tardanza/editar/n";
        $.post(url,dataString,function(data){
            $('#basic-modal-content').modal();
            $('#mensaje').html(data);
        });
    });

    $("body").on('click',"#ver_profesor",function(){
        url = base_url+"index.php/ventas/profesor/buscar";
        window.open(url,"_blank","width=700,height=400,scrollbars=yes,status=yes,resizable=yes,screenx=0,screeny=0");          
    }); 

    $("body").on('click',"#ver_reemplazo",function(){
        url = base_url+"index.php/ventas/profesor/buscar2";
        window.open(url,"_blank","width=700,height=400,scrollbars=yes,status=yes,resizable=yes,screenx=0,screeny=0");          
    });     

    $('body').on('click',"#cancelar",function(){
        url = base_url+"index.php/ventas/tardanza/listar";
        location.href = url;
    });

    $("body").on('click',"#grabar",function(){
        url = base_url+"index.php/ventas/tardanza/grabar";
        dataString  = $('#frmPersona').serialize();
        $.post(url,dataString,function(data){
            alert('Operacion realizada con exito');
            location.href = base_url+"index.php/ventas/tardanza/listar";
        });
    });

    $("body").on("click","#logo",function(){
        url = base_url+"index.php/inicio/principal";
        location.href = url;
    });

    $("body").on('focus',"#fecha",function(){
         $(this).datepicker({
          dateFormat: "dd/mm/yy",
          changeYear: true,
          yearRange: "1945:2025"
         });
    });  
    
     $("body").on('change',"#local",function(){
        url    = base_url+"index.php/maestros/aula/obtener/";
        objRes = new Object();
        objRes.local = $("#local").val();
        dataString   = {objeto: JSON.stringify(objRes)};
        $("#aula").children().remove().end().append("<option value='0'>:: Seleccione ::</option>");
       $.post(url,dataString,function(data){
            $.each(data, function(item,value){
               opt       = document.createElement('option');
               opt.value = value.AULAP_Codigo;
               opt.appendChild(document.createTextNode(value.AULAC_Nombre));
               $('#aula').append(opt);
           });
       },"json");             
   });   
   
   $("body").on("click",".editar",function(){
        codigo = $(this).parent().parent().attr("id");
        dataString = "";    
        url = base_url+"index.php/ventas/tardanza/editar/e/"+codigo;
        $.post(url,dataString,function(data){
            $('#basic-modal-content').modal();
            $('#mensaje').html(data);
        });  
    });    
    
    $("body").on("click",".eliminar",function(){
       if(confirm('Esta seguro desea eliminar este registro?')){
            coddetalle = $(this).parent().parent().attr("id");
            dataString = "codigo="+coddetalle;
            url = base_url+"index.php/ventas/tardanza/eliminar";
            $.post(url,dataString,function(data){
                if(data=="true"){
                    url = base_url+"index.php/ventas/tardanza/listar";
                    location.href = url;
                }
                else if(data=="false"){
                    alert("No se puede eliminar el registro");
                }
            });           
       }        
    });        
});
function abrir_formulario_ubigeo(){
	ubigeo = $("#cboNacimiento").val();
	url = base_url+"index.php/maestros/ubigeo/formulario_ubigeo/"+ubigeo;
	window.open(url,'Formulario Ubigeo','menubar=no,resizable=no,width=200,height=180');
}

function selecciona_familia(codigo){
    window.opener.selecciona_familia(codigo);
    window.close();
}

function selecciona_profesor(codigo){
    url    = base_url+"index.php/ventas/profesor/obtener/";
    objRes = new Object();
    objRes.profesor = codigo;
    dataString   = {objeto: JSON.stringify(objRes)};
    $.post(url,dataString,function(data){
        $.each(data, function(item,value){
            nombres = value.PERSC_Nombre+' '+value.PERSC_ApellidoPaterno+' '+value.PERSC_ApellidoMaterno;
            $("#nombres").val(nombres);            
            $("#profesor").val(value.PROP_Codigo); 
        });
    },"json");
}

function selecciona_profesor2(codigo){
    url    = base_url+"index.php/ventas/profesor/obtener/";
    objRes = new Object();
    objRes.profesor = codigo;
    dataString   = {objeto: JSON.stringify(objRes)};
    $.post(url,dataString,function(data){
        $.each(data, function(item,value){
            nomper = value.PERSC_ApellidoPaterno+' '+value.PERSC_ApellidoMaterno+' '+value.PERSC_Nombre;
            $("#reemplazo").val(value.PROP_Codigo);
            $("#nombres_reemp").val(nomper);           
        });
    },"json");
}