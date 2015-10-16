jQuery(document).ready(function(){    
   $("body").on("click","#buscar",function(){
        $("#form_busqueda").submit();
    });
    
    $("body").on("click","#nuevo",function(){
        dataString = "";
        url = base_url+"index.php/ventas/tareo/editar/n";
        $.post(url,dataString,function(data){
            $('#basic-modal-content').modal();
            $('#mensaje').html(data);
        });          
    });
    
    $("body").on('click',"#agregar",function(){
        n      = $("#tabla_detalle tr").length - 1;
        fila   = "<tr>";
        fila  += "<td align='center'><input type='hidden' id='codigodetalle["+n+"]' name='codigodetalle["+n+"]' value=''>"+(parseInt(n)+1)+"</td>";
        fila  += "<td align='center' valgin='top'><select name='profesor["+n+"]' id='profesor["+n+"]' class='comboGrande'><option value='0'>::Seleccione::</option></select></td>";
        fila  += "<td align='center'><input id='hinicio["+n+"]' type='time' maxlength='5' name='hinicio["+n+"]' value='' class='cajaReducida' onblur='valida(this.value,this);'></td>";
        fila  += "<td align='center'><input id='hfin["+n+"]' type='time' maxlength='5' name='hfin["+n+"]' value='' class='cajaReducida' onblur='valida(this.value,this);'></td>";
        fila  += "<td align='center'><select name='tipo["+n+"]' id='tipo["+n+"]' class='comboMinimo'><option value='0'>::Seleccione::</option></select></td>";
        fila  += "<td align='center'><select name='reemplazo["+n+"]' id='reemplazo["+n+"]' class='comboGrande'><option value='0'>::Seleccione::</option></select></td>";
        fila  += "<td align='center'><a href='#' class='editardetalle'><img src='"+base_url+"/img/editar.jpg'></a>&nbsp;<a href='#' class='eliminardetalle'><img src='"+base_url+"/img/eliminar.jpg'></a></td>";
        fila  += "</tr>";
        $("#tabla_detalle").append(fila);
        selectProfesor(n);
        selectReemplazo(n);
        selectTipo(n);
    });    
    
    $("body").on('click',"#ver_cliente",function(){
        url = base_url+"index.php/ventas/alumno/buscar";
        window.open(url,"_blank","width=700,height=400,scrollbars=yes,status=yes,resizable=yes,screenx=0,screeny=0");          
    });    
    
   $("body").on('change',"#curso",function(){
       accion      = $("#accion").val();
       codigo      = $("#codigo").val();
       dataString  = $('#frmPersona').serialize();
       url = base_url+"index.php/ventas/tareo/editar/"+accion+"/"+codigo;
       $.post(url,dataString,function(data){
           $('#mensaje').html(data);
       });             
   });       
    
    $("body").on('click',"#imprimir",function(){
        codigo   = $("#codigo").val();
        url = base_url+"index.php/ventas/tareo/ver/"+codigo;
        window.open(url, this.target, 'width=800,height=400,top=150,left=200');
    });    
    
    $("body").on('click',"#cancelar",function(){
        url = base_url+"index.php/ventas/tareo/listar";
        location.href = url;
    });        
    
    $("body").on('click',"#grabar",function(){
        url        = base_url+"index.php/ventas/tareo/grabar";
        dataString = $('#frmPersona').serialize();
        $.post(url,dataString,function(data){
            if(data=="true"){
                alert('Operacion realizada con exito');    
                $("#frmPersona").submit();
            }
            else if(data=="false"){
                alert('No se grabaron los registros');
            }
        });            
    }); 
    
   $("body").on("click","#eliminardetalle",function(){
        if(confirm('Esta seguro desea eliminar este registro?')){
            coddetalle = $(this).parent().parent().attr("id");
            dataString = "codigo="+coddetalle;
            url = base_url+"index.php/ventas/tareo/eliminar";
            $.post(url,dataString,function(data){
                if(data=="true"){
//                   alert('Operacion realizada con exito');  
                   $("#frmPersona").submit();                                       
                }
                else if(data=="false"){
                    alert("No se puede eliminar el registro,\nel usuario ha visualizado los videos");
                }
            });
        }        
    });    
    
   $("body").on("click","#editardetalle",function(){
        tr = $(this).parent().parent();  
        n  = tr.children("td")[0].innerHTML - 1;        
        codigodetalle = $(this).parent().parent().attr("id"); 
        url = base_url+"index.php/ventas/tareo/obtener";
        objRes = new Object();
        objRes.tareo = codigodetalle;
        dataString   = {objeto: JSON.stringify(objRes)};        
        $.post(url,dataString,function(data){
            tr.empty();              
            tr.append("<td align='center'><input type='hidden' id='codigodetalle["+n+"]' name='codigodetalle["+n+"]' value='"+codigodetalle+"'>"+(parseInt(n)+1)+"</td>");
            tr.append("<td align='center'><select name='profesor["+n+"]' id='profesor["+n+"]' class='comboGrande'><option value='0'>::Seleccione::</option></select></td>");
            tr.append("<td align='center'><input id='hinicio["+n+"]' type='time' maxlength='5' name='hinicio["+n+"]' value='"+data["TAREOC_Hinicio"]+"'  class='cajaReducida' onblur='valida(this.value,this);'></td>");
            tr.append("<td align='center'><input id='hfin["+n+"]' type='time' maxlength='5' name='hfin["+n+"]' value='"+data["TAREOC_Hfin"]+"'  class='cajaReducida' onblur='valida(this.value,this);'></td>");
            tr.append("<td align='center'><select name='tipo["+n+"]' id='tipo["+n+"]' class='comboMinimo'><option value='0'>::Seleccione::</option></select></td>");
            tr.append("<td align='center'><select name='reemplazo["+n+"]' id='reemplazo["+n+"]' class='comboGrande'><option value='0'>::Seleccione::</option></select></td>");
            tr.append("<td align='center'><a href='#' class='editardetalle'><img src='"+base_url+"/img/editar.jpg'></a>&nbsp;<a href='#' class='eliminardetalle'><img src='"+base_url+"/img/eliminar.jpg'></a></td>");
            selectProfesor(n,data["PROP_Codigo"]);
            selectReemplazo(n,data["TAREOC_ProfesorReemplazado"]);
            selectTipo(n,data["TIPOASISP_Codigo"]);            
        },"json");  
    });          
    
  $("body").on('focus',"#fecha",function(){
       $(this).datepicker({
        dateFormat: "dd/mm/yy",
        changeYear: true,
        yearRange: "1945:2025",
        onSelect: function (date) {
            $('#frmPersona').submit();
        }
       });
  });  
});

function selectProfesor(n,valor){
    valor = (valor) ? valor : null;
    a      = "profesor["+n+"]";
    url    = base_url+"index.php/ventas/profesor/obtener";
    select_a = document.getElementById(a);
    objRes = new Object();
    objRes.curso = $("#curso").val();
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

function selectReemplazo(n,valor){
    valor = (valor) ? valor : null;
    b      = "reemplazo["+n+"]";
    url    = base_url+"index.php/ventas/profesor/obtener";
    select_b = document.getElementById(b);
    objRes = new Object();
    //objRes.curso = $("#curso").val();
    dataString   = {objeto: JSON.stringify(objRes)};
    $.post(url,dataString,function(data){
        $.each(data, function(item,value){
            opt_b       = document.createElement('option');
            opt_b.value = value.PROP_Codigo;
            if(valor==value.PROP_Codigo){opt_b.selected=true;}
            texto     = value.PERSC_ApellidoPaterno+' '+value.PERSC_ApellidoMaterno+' '+value.PERSC_Nombre;
            opt_b.appendChild(document.createTextNode(texto));
            select_b.appendChild(opt_b);
        });
    },"json");
}

function selectTipo(n,valor){
    valor = (valor) ? valor : null;
    c      = "tipo["+n+"]";
    url    = base_url+"index.php/maestros/tipoasistencia/obtener";
    selecttipo = document.getElementById(c);
    objRes = new Object();
    dataString   = {objeto: JSON.stringify(objRes)};
    $.post(url,dataString,function(data){
        $.each(data, function(item,value){
            opt       = document.createElement('option');
            opt.value = value.TIPOASISP_Codigo;
            if(valor==value.TIPOASISP_Codigo){opt.selected=true;}
            opt.appendChild(document.createTextNode(value.TIPOASISC_Nombre));
            selecttipo.appendChild(opt);
        });
    },"json");
}

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