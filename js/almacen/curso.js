jQuery(document).ready(function(){
    $('ul li:has(ul)').hover(function(e) {
         $(this).find('ul').css({display: "block"});
     },
     function(e) {
         $(this).find('ul').css({display: "none"});
     });   
     
    $("body").on("click","#nuevo",function(){
        dataString = "";
        url = base_url+"index.php/almacen/curso/editar/n";
        $.post(url,dataString,function(data){
            $('#basic-modal-content').modal();
            $('#mensaje').html(data);
        });             
    });
   
    $("body").on("click","#buscar",function(){
	$("#frmBusqueda").submit();
    });	

    $("body").on("click","#limpiar",function(){
        url = base_url+"index.php/almacen/curso/listar";
        location.href=url;
    });
    
//    $("#imagen").change(function(){
////        file = $("#imagen")[0].files[0];
////        filename = file.name;
////        fileExtension = filename.substring(filename.lastIndexOf('.') + 1);
////        filesize = file.size;
////        filetype = file.type;
//    });
    
 /*    $("body").on("click","#grabar",function(){  
        if(window.FormData){
            form_data = new FormData($(".formulario")[0]);
        }
//        else{
//            form = document.getElementById('formProducto');
//            var children, i, l, child,form_data = '';
//             children = form.childNodes;
//             for( i=0,l=children.length;i<l;i++ ){
//                 //To prevent no-html nodes
//                 if( typeof children[i] != 'object' ||
//                 (children[i].tagName == null && children[i].localName == null) ){
//                     continue;
//                 }
//                 child = children[i];
//                 alert(form[i]);
//                 //Avoid input type="file" selecting
//                 if( child.getAttribute('name') && child.getAttribute('type') != 'file' ){
//                     var name = child.getAttribute('name'),
//                     value = child.value;
//                     if( form_data != '' ) form_data += '&'
//                     form_data += name+'='+encodeURIComponent(value);
//                 }
//             }
//             alert(form_data);
//       }
        url  = base_url+"index.php/almacen/producto/grabar";    
        $.ajax({
                url:url,
                type:"POST",
                data:form_data,
                cache:false,                
                contentType:false,			                
                processData:false,  
                beforeSend:function(){
                  message = $("<span>Subiendo la imagen, por favor espere...</span>");  
                },
                success: function(data){
                    var obj = jQuery.parseJSON(data);
                    if(obj.subimage==true){
//                        file = $("#imagen")[0].files[0];
//                        filename = file.name;
//                        $("#fileimagen").attr("src",base_url+"/img/"+filename);
                    }
                    if(obj.subarchivo==true){
//                        file = $("#archivo")[0].files[0];
//                        filename = file.name;
//                        $("#filearchivo").attr("src",base_url+"/img/pdf.png");
                    }
                    alert('Operacion realizada con exito');
                    location.href = base_url+"index.php/almacen/producto/listar";
                },
                error: function(){
                    message = $("<span class='error'>Ha ocurrido un error.</span>");
                }                
        });    
    }); */
    
    $("body").on("click","#cancelar",function(){
        url = base_url+"index.php/almacen/curso/listar";
        location.href = url;
    });        
});

function ver_familia(){
    url           = base_url+"index.php/almacen/familia/nuevo";
    window.open(url,"_blank","width=500,height=400,scrollbars=yes,status=yes,resizable=yes,screenx=0,screeny=0");
}

function editar(codigo){
    dataString = "codigo="+codigo;    
    url = base_url+"index.php/almacen/curso/editar/e/"+codigo;
    $.post(url,dataString,function(data){
        $('#basic-modal-content').modal();
        $('#mensaje').html(data);
    }); 
}

function eliminar(codigo){
    if(confirm('Esta seguro desea eliminar este curso?')){
        dataString = "codigo="+codigo;
        url = base_url+"index.php/almacen/curso/eliminar";
        $.post(url,dataString,function(data){
            obj = jQuery.parseJSON(data);
            if(obj){
                alert('Operacion realizada con exito');  
                url = base_url+"index.php/almacen/curso/listar";
                location.href = url;                
            }
            else{
                alert("No puede eliminar un video que tiene cursos ingresados.");
            }
        });
    }
}

function isImage(extension){
    switch(extension.toLowerCase()) 
    {
        case 'jpg': case 'gif': case 'png': case 'jpeg':
            return true;
        break;
        default:
            return false;
        break;
    }
}