jQuery(document).ready(function(){
//    $.mask.definitions['H']='[012]';
//    $.mask.definitions['N']='[012345]';
//    $.mask.definitions['n']='[0123456789]';
    //$(".time").mask("Hn:Nn:Nn");
//    $(".time").mask("Hn:Nn");
    
    $('ul li:has(ul)').hover(function(e) {
         $(this).find('ul').css({display: "block"});
     },function(e) {
         $(this).find('ul').css({display: "none"});
     });       
     
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
        n      = $("#tabla_detalle tr").length;
        fila   = "<tr>";
        fila  += "<td align='center'>"+n+"</td>";
        fila  += "<td align='left' valgin='top'><textarea name='acuerdo["+n+"]' id='acuerdo["+n+"]' placeholder='Acuerdos de la reunion' cols='53' rows='1'></textarea></td>";
        fila  += "<td align='center'><select class='comboGrande' name='responsable["+n+"]' id='responsable["+n+"]'><option value='0'>::Seleccione::</option></select></td>";
        fila  += "<td align='center'><input type='text' maxlength='10' class='cajaMinima' name='fcompromiso["+n+"]' id='fcompromiso["+n+"]' onmousedown='$(this).datepicker({dateFormat: \"dd/mm/yy\",changeYear: true,yearRange: \"1945:2025\"});'></td>";
        fila  += "<td align='center'><a>Editar</a>&nbsp;<a>Eliminar</a></td>";
        fila  += "</tr>";
        $("#tabla_detalle").append(fila);
        selectResponsable(n);
    });    
    
    $("body").on('click',"#ver_cliente",function(){
        url = base_url+"index.php/ventas/alumno/buscar";
        window.open(url,"_blank","width=700,height=400,scrollbars=yes,status=yes,resizable=yes,screenx=0,screeny=0");          
    });    
    
   $("body").on('change',"#curso",function(){
       accion      = $("#accion").val();
       codigo      = $("#codigo").val();
       dataString  = $('#frmPersona').serialize();
       url = base_url+"index.php/ventas/acta/editar/"+accion+"/"+codigo;
       $.post(url,dataString,function(data){
           $('#mensaje').html(data);
       });             
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
    
    $("body").on("click","#cerrar",function(){
        url = base_url+"index.php/inicio/index";
        location.href = url;
    });          
    
    $("body").on('click',"#grabar",function(){
        url        = base_url+"index.php/ventas/acta/grabar";
        clave      = $("#clave").val();
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
    
   $("body").on("click",".eliminar",function(){
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
    
   $("body").on("click",".editar",function(){
        coddetalle = $(this).parent().parent().attr("id");
        alert(coddetalle);
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
});

function editar(codigo){
    dataString = "codigo="+codigo;    
    url = base_url+"index.php/ventas/acta/editar/e/"+codigo;
    $.post(url,dataString,function(data){
        $('#basic-modal-content').modal();
        $('#mensaje').html(data);
    });        
}

function eliminar(codigo){
    if(confirm('Esta seguro desea eliminar este registro?')){
        dataString = "codigo="+codigo;
        url = base_url+"index.php/ventas/matricula/eliminar";
        $.post(url,dataString,function(data){
            if(data=="true"){
                alert('Operacion realizada con exito');  
                url = base_url+"index.php/ventas/matricula/listar";
                location.href = url;
            }
            else if(data=="false"){
                alert("No se puede eliminar el registro,\nel usuario ha visualizado los videos");
            }
        });
    }
}

function selectResponsable(n){
    a      = "responsable["+n+"]";
    url    = base_url+"index.php/ventas/profesor/obtener";
    select = document.getElementById(a);
    objRes = new Object();
    objRes.curso = $("#curso").val();
    dataString   = {objeto: JSON.stringify(objRes)};
    $.post(url,dataString,function(data){
        $.each(data, function(item,value){
            opt       = document.createElement('option');
            opt.value = value.PROP_Codigo;
            texto     = value.PERSC_ApellidoPaterno+' '+value.PERSC_ApellidoMaterno+' '+value.PERSC_Nombre;
            opt.appendChild(document.createTextNode(texto));
            select.appendChild(opt);
        });
    },"json");
}

function addToList(id1,id2) {
    var comp = document.getElementById(id1);
    var comp2 = document.getElementById(id2);
    var value = comp.options[comp.selectedIndex].value;
    var text = comp.options[comp.selectedIndex].text;
    var selectedOption = comp.options[comp.selectedIndex];
    var optn = document.createElement("option");
    optn.text = text;
    optn.value = value;
    comp2.options.add(optn);
    selectedOption.parentNode.removeChild(selectedOption);
}

function removeFromList(combo2,combo1) {
    var comp2 = document.getElementById(combo2); //combo1
    var comp1 = document.getElementById(combo1); //combo2
    var value = comp2.options[comp2.selectedIndex].value;
    var text = comp2.options[comp2.selectedIndex].text;
    var selectedOption = comp2.options[comp2.selectedIndex];
//    window.alert(value + ", " + text);
//    return;
//    var pos = comp2.options[comp.selectedIndex].id;
    var optn = document.createElement("option");
    optn.text = text;
    optn.value = value;
    
//    comp.options[index] = new Option(myobject[index], index);
    comp1.appendChild(optn);
    selectedOption.parentNode.removeChild(selectedOption);
}