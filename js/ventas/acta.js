jQuery(document).ready(function(){     
   $("body").on("click","#buscar",function(){
        $("#form_busqueda").submit();
    });
    
    $("body").on("click","#nuevo",function(){
        dataString = "";
        url = base_url+"index.php/ventas/acta/editar/n";
        $.post(url,dataString,function(data){
            $('#basic-modal-content').modal();
            $('#mensaje').html(data);
        });          
    });
    
    $("body").on('click',"#agregar",function(){
        n      = $("#tabla_detalle tr").length - 1;
        if($('#curso').val()!=0){
            fila   = "<tr>";
            fila  += "<td align='center'><input type='hidden' id='codigodetalle["+n+"]' name='codigodetalle["+n+"]' value=''>"+(parseInt(n)+1)+"</td>";
            fila  += "<td align='center'><input type='text' class='cajaMedia' name='nombre["+n+"]' id='nombre["+n+"]' value=''></td>";
            fila  += "<td align='left' valgin='top'><textarea name='acuerdo["+n+"]' id='acuerdo["+n+"]' placeholder='Acuerdos de la reunion' cols='53' rows='1'></textarea></td>";
            fila  += "<td align='center'><a href='#'>Editar</a>&nbsp;<a href='#' class='eliminardetalle'>Eliminar</a></td>";
            fila  += "</tr>";
            $("#tabla_detalle").append(fila);           
        }
        else{
            alert("Primero debe seleccinar un curso");
        }
    });    
    
//    $("body").on('click',"#ver_cliente",function(){
//        url = base_url+"index.php/ventas/alumno/buscar";
//        window.open(url,"_blank","width=700,height=400,scrollbars=yes,status=yes,resizable=yes,screenx=0,screeny=0");          
//    });    
    
    $("body").on('click',"#ver_asistentes",function(){
        if($('#codigo').val()!=""){
            curso = $("#curso").val();
            acta  = $("#codigo").val();
            url = base_url+"index.php/ventas/actaprofesor/editartodos/"+curso+"/"+acta;
            window.open(url,"_blank","width=850,height=400,scrollbars=yes,status=yes,resizable=yes,screenx=0,screeny=0");                      
        }
        else{
            alert("Primero debe guardar el acta");
        }
    });      
    
   $("body").on('change',"#ciclo",function(){
       accion      = $("#accion").val();
       codigo      = $("#codigo").val();
       dataString  = $('#frmPersona').serialize();
       url = base_url+"index.php/ventas/acta/editar/"+accion+"/"+codigo;
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
        url = base_url+"index.php/ventas/acta/ver/"+codigo;
        window.open(url, this.target, 'width=800,height=400,top=150,left=200');
    });    
    
    $("body").on('click',"#cancelar",function(){
        url = base_url+"index.php/ventas/acta/listar";
        location.href = url;
    });      
    
    $("body").on('click',"#grabar",function(){
        url        = base_url+"index.php/ventas/acta/grabar";
        clave      = $("#clave").val();
        $('#profesor').removeAttr('disabled');
        $('#tipoestudio').removeAttr('disabled');
        dataString = $('#frmPersona').serialize();
        if(clave != ""){
            $.post(url,dataString,function(data){
                if(data=="true"){
                    alert('Operacion realizada con exito');    
                    location.href = base_url+"index.php/ventas/acta/listar";
                }
                else if(data=="false"){
                    alert('El usuario ya esta actado en el curso');
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
            url = base_url+"index.php/ventas/acta/eliminardetalle";
            $.post(url,dataString,function(data){
                if(data=="true"){
//                    alert('Operacion realizada con exito');  
                    accion      = $("#accion").val();
                    codigo      = $("#codigo").val();
                    dataString  = $('#frmPersona').serialize();
                    url = base_url+"index.php/ventas/acta/editar/"+accion+"/"+codigo;
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
        url = base_url+"index.php/ventas/acta/obtenerdetalle";
        objRes = new Object();
        objRes.actadetalle = codigodetalle;
        dataString   = {objeto: JSON.stringify(objRes)}; 
        $.post(url,dataString,function(data){
            tr.empty();              
            tr.append("<td align='center'><input type='hidden' id='codigodetalle["+n+"]' name='codigodetalle["+n+"]' value='"+codigodetalle+"'>"+(parseInt(n)+1)+"</td>");
            tr.append("<td align='center'><input type='text' class='cajaMedia' name='nombre["+n+"]' id='nombre["+n+"]' value='"+data["ACTADETC_Nombre"]+"'></td>");
            tr.append("<td align='left' valgin='top'><textarea name='acuerdo["+n+"]' id='acuerdo["+n+"]' placeholder='Acuerdos de la reunion' cols='53' rows='1'>"+data["ACTADETC_Observacion"]+"</textarea></td>");
            tr.append("<td align='center'><a href='#' class='editardetalle'>Editar</a>&nbsp;<a href='#' class='eliminardetalle'>Eliminar</a></td>");
        },"json");          
     });    
    
    $("body").on("click",".eliminar",function(){
       if(confirm('Esta seguro desea eliminar este registro?')){
            coddetalle = $(this).parent().parent().attr("id");
            dataString = "codigo="+coddetalle;
            url = base_url+"index.php/ventas/acta/eliminar";
            $.post(url,dataString,function(data){
                if(data=="true"){
                    //alert('Operacion realizada con exito');  
                    url = base_url+"index.php/ventas/acta/listar";
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
        url = base_url+"index.php/ventas/acta/editar/e/"+codigo;
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
});
//
//function addToList(id1,id2) {
//    var comp = document.getElementById(id1);
//    var comp2 = document.getElementById(id2);
//    var value = comp.options[comp.selectedIndex].value;
//    var text = comp.options[comp.selectedIndex].text;
//    var selectedOption = comp.options[comp.selectedIndex];
//    var optn = document.createElement("option");
//    optn.text = text;
//    optn.value = value;
//    comp2.options.add(optn);
//    selectedOption.parentNode.removeChild(selectedOption);
//}
//
//function removeFromList(combo2,combo1) {
//    var comp2 = document.getElementById(combo2); //combo1
//    var comp1 = document.getElementById(combo1); //combo2
//    var value = comp2.options[comp2.selectedIndex].value;
//    var text = comp2.options[comp2.selectedIndex].text;
//    var selectedOption = comp2.options[comp2.selectedIndex];
////    window.alert(value + ", " + text);
////    return;
////    var pos = comp2.options[comp.selectedIndex].id;
//    var optn = document.createElement("option");
//    optn.text = text;
//    optn.value = value;
//    
////    comp.options[index] = new Option(myobject[index], index);
//    comp1.appendChild(optn);
//    selectedOption.parentNode.removeChild(selectedOption);
//}