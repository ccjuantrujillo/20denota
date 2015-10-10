jQuery(document).ready(function(){     
   $("body").on("click","#buscar",function(){
        $("#form_busqueda").submit();
    });
    
    $("body").on("click","#nuevo",function(){
        dataString = "";
        url = base_url+"index.php/ventas/vigilancia/editar/n";
        $.post(url,dataString,function(data){
            $('#basic-modal-content').modal();
            $('#mensaje').html(data);
        });          
    });
    
    $("body").on('click',"#agregar",function(){
        n      = $("#tabla_detalle tr").length - 1;
        fila   = "<tr>";
        fila  += "<td align='center'><input type='hidden'  value='' id='codigodetalle["+n+"]' name='codigodetalle["+n+"]'>"+(parseInt(n)+1)+"</td>";
        fila  += "<td align='center'><select class='comboMedio' name='curso["+n+"]' id='curso["+n+"]' onchange='selectTema("+n+");'><option value='0'>::Seleccione::</option></select></td>";
        fila  += "<td align='center'><select class='comboGrande' name='profesor["+n+"]' id='profesor["+n+"]'><option value='0'>::Seleccione::</option></select></td>";
        fila  += "<td align='center'><a href='#'>Editar</a>&nbsp;<a href='#' class='eliminardetalle'>Eliminar</a></td>";
        fila  += "</tr>";
        $("#tabla_detalle").append(fila);
        selectCurso(n);  
        selectProfesor(n);           
    });       
    
   $("body").on('change',"#ciclo",function(){
       accion      = $("#accion").val();
       codigo      = $("#codigo").val();
       dataString  = $('#frmPersona').serialize();
       url = base_url+"index.php/ventas/vigilancia/editar/"+accion+"/"+codigo;
       $.post(url,dataString,function(data){
           $('#mensaje').html(data);
       });             
   });     
   
     $("body").on('change',"#curso",function(){
        url    = base_url+"index.php/ventas/profesor/obtener/";
        objRes = new Object();
        objRes.curso = $("#curso").val();
        dataString   = {objeto: JSON.stringify(objRes)};
        $("#profesor").children().remove().end().append("<option value='0'>:: Seleccione ::</option>");
       $.post(url,dataString,function(data){
            $.each(data, function(item,value){
               opt       = document.createElement('option');
               opt.value = value.PROP_Codigo;
               opt.appendChild(document.createTextNode(value.PERSC_ApellidoPaterno+' '+value.PERSC_ApellidoMaterno+' '+value.PERSC_Nombre));
               $('#profesor').append(opt);
           });
       },"json");             
   });    
    
    $("body").on('click',"#imprimir",function(){
        codigo   = $("#codigo").val();
        url = base_url+"index.php/ventas/vigilancia/ver/"+codigo;
        window.open(url, this.target, 'width=800,height=400,top=150,left=200');
    });    
    
    $("body").on('click',"#cancelar",function(){
        url = base_url+"index.php/ventas/vigilancia/listar";
        location.href = url;
    });      
    
    $("body").on('click',"#grabar",function(){
        url        = base_url+"index.php/ventas/vigilancia/grabar";
        clave      = $("#clave").val();
        $('#profesor').removeAttr('disabled');
        $('#ciclo').removeAttr('disabled');
        $('#tipotarea').removeAttr('disabled');
        dataString = $('#frmPersona').serialize();
        if(clave != ""){
            $.post(url,dataString,function(data){
                if(data=="true"){
                    alert('Operacion realizada con exito');    
                    location.href = base_url+"index.php/ventas/vigilancia/listar";
                }
                else if(data=="false"){
                    alert('El usuario ya esta vigilanciado en el curso');
                }
            });            
        }
        else{
            alert("Debe escribir una clave");
        }
    }); 
    
   $("body").on("click",".eliminardetalle",function(){
        if(confirm('Esta seguro desea eliminar este registro?')){
            coddetalle = $(this).parent().parent().attr("id");
            dataString = "codigo="+coddetalle;
            url = base_url+"index.php/ventas/vigilancia/eliminardetalle";
            $.post(url,dataString,function(data){
                if(data=="true"){
//                    alert('Operacion realizada con exito');  
                    accion      = $("#accion").val();
                    codigo      = $("#codigo").val();
                    dataString  = $('#frmPersona').serialize();
                    url = base_url+"index.php/ventas/vigilancia/editar/"+accion+"/"+codigo;
                    $.post(url,dataString,function(data2){
                        $('#mensaje').html(data2);
                    });                                          
                }
                else if(data=="false"){
                    alert("No se puede eliminar el registro,\nel usuario ha visualizado los videos");
                }
            });
        }        
    });    
    
    $("body").on("click",".editardetalle",function(){ 
    tr = $(this).parent().parent();  
    n  = tr.children("td")[0].innerHTML - 1;        
    codigodetalle = $(this).parent().parent().attr("id"); 
    url = base_url+"index.php/ventas/vigilancia/obtenerdetalle";
    objRes = new Object();
    objRes.vigilanciadetalle = codigodetalle;
    dataString   = {objeto: JSON.stringify(objRes)}; 
    $.post(url,dataString,function(data){
        tr.empty();              
        tr.append("<td align='center'><input type='hidden' id='codigodetalle["+n+"]' name='codigodetalle["+n+"]' value='"+codigodetalle+"'>"+(parseInt(n)+1)+"</td>");
        tr.append("<td align='center'><select class='comboMedio' name='tipoestudiociclo["+n+"]' id='tipoestudiociclo["+n+"]' onchange='selectTema("+n+");'><option value='0'>::Seleccione::</option></select></td>");
        tr.append("<td align='center'><select class='comboGrande' name='tema["+n+"]' id='tema["+n+"]'><option value='0'>::Seleccione::</option></select></td>");
        tr.append("<td align='center'><select class='comboGrande' name='responsable["+n+"]' id='responsable["+n+"]'><option value='0'>::Seleccione::</option></select></td>");        
        tr.append("<td align='left'><input type='text' class='cajaMinima' name='cantidad["+n+"]' id='cantidad["+n+"]' value='"+data["TAREADETC_Cantidad"]+"'></td>");                
        tr.append("<td align='left'><input type='text' class='cajaMinima' maxlength='10' name='fentrega["+n+"]' id='fentrega["+n+"]' onmousedown='$(this).datepicker({dateFormat: \"dd/mm/yy\",changeYear: true,yearRange: \"1945:2025\"});' value='"+data["fentrega"]+"'></td>");        
        tr.append("<td align='center'><a href='#' class='editardetalle'>Editar</a>&nbsp;<a href='#' class='eliminardetalle'>Eliminar</a></td>");
        selectTipoestudiociclo(n,data["TIPCICLOP_Codigo"]);  
        selectTema(n,data["TIPCICLOP_Codigo"],data["PRODATRIBDET_Codigo"]);  
        selectResponsable(n,data["PROP_Codigo"]);  
     },"json");              
     });    
    
    $("body").on("click",".eliminar",function(){
       if(confirm('Esta seguro desea eliminar este registro?')){
            coddetalle = $(this).parent().parent().attr("id");
            dataString = "codigo="+coddetalle;
            url = base_url+"index.php/ventas/vigilancia/eliminar";
            $.post(url,dataString,function(data){
                if(data=="true"){
                    //alert('Operacion realizada con exito');  
                    url = base_url+"index.php/ventas/vigilancia/listar";
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
        url = base_url+"index.php/ventas/vigilancia/editar/e/"+codigo;
        $.post(url,dataString,function(data){
            $('#basic-modal-content').modal();
            $('#mensaje').html(data);
        });  
    });        
    
  $("body").on('focus',"#fecha",function(){
       $(this).datepicker({
        dateFormat: "dd/mm/yy",
        changeYear: true,
        yearRange: "1945:2025"
       });
  });

  $("body").on('focus',"#fechaentrega",function(){
       $(this).datepicker({
        dateFormat: "dd/mm/yy",
        changeYear: true,
        yearRange: "1945:2025"
       });
  });    
});

function selectProfesor(n,valor){
    valor = (valor) ? valor : null;
    a      = "profesor["+n+"]";
    url    = base_url+"index.php/ventas/profesor/obtener";
    select_a = document.getElementById(a);
    objRes = new Object();
    //objRes.curso = $("#curso").val();
    dataString   = {objeto: JSON.stringify(objRes)};
    $.post(url,dataString,function(data){
        $.each(data, function(item,value){
            opt       = document.createElement('option');
            opt.value = value.PROP_Codigo;
            if(valor==value.PROP_Codigo){opt.selected=true;}
            texto     = value.PERSC_ApellidoPaterno+' '+value.PERSC_ApellidoMaterno+' '+value.PERSC_Nombre;
            opt.appendChild(document.createTextNode(texto));
            select_a.appendChild(opt);
        });
    },"json");
}

function selectCurso(n,valor){
    valor = (valor) ? valor : null;
    b      = "curso["+n+"]";
    url    = base_url+"index.php/almacen/curso/obtener";
    select_b = document.getElementById(b);
    objRes = new Object();
    dataString   = {objeto: JSON.stringify(objRes)};
    $.post(url,dataString,function(data){
        $.each(data, function(item,value){
            opt       = document.createElement('option');
            opt.value = value.PROD_Codigo;
            if(valor==value.PROD_Codigo){opt.selected=true;}
            texto     = value.PROD_Nombre;
            opt.appendChild(document.createTextNode(texto));
            select_b.appendChild(opt);
        });
    },"json");
}