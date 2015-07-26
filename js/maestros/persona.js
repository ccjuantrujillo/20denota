jQuery(document).ready(function(){
    $("#buscar").click(function(){
        $("#form_busqueda").submit();
    });
    
    $("#nuevo").click(function(){
        url = base_url+"index.php/maestros/persona/editar/n";
        location.href = url;
    });
    
    $("#imprimir").click(function(){
        codigo   = $("#codigo").val();
        url = base_url+"index.php/maestros/persona/ver/"+codigo;
        window.open(url, this.target, 'width=800,height=400,top=150,left=200');
    });    
    
    $("#cancelar").click(function(){
        url = base_url+"index.php/maestros/persona/listar";
        location.href = url;
    });
    
    $("#cerrar").click(function(){
        url = base_url+"index.php/inicio/index";
        location.href = url;
    });          
    
    $("#grabar").click(function(){
        url = base_url+"index.php/maestros/persona/grabar";
        dataString  = $('#frmPersona').serialize();
        $.post(url,dataString,function(data){
            alert('Operacion realizada con exito');
            location.href = base_url+"index.php/maestros/persona/listar";
        });
    }); 
    
    $("#logo").click(function(){
        url = base_url+"index.php/inicio/principal";
        location.href = url;
    });          
});

function editar(codigo){
    url = base_url+"index.php/maestros/persona/editar/e/"+codigo;
    location.href=url;
}

function eliminar(codigo){
    if(confirm('Esta seguro desea eliminar este persona?')){
        dataString = "codigo="+codigo;
        url = base_url+"index.php/maestros/persona/eliminar";
        $.post(url,dataString,function(data){
            url = base_url+"index.php/maestros/persona/listar";
            location.href = url;
        });
    }
}

function abrir_formulario_ubigeo(){
	ubigeo = $("#cboNacimiento").val();
	url = base_url+"index.php/maestros/ubigeo/formulario_ubigeo/"+ubigeo;
	window.open(url,'Formulario Ubigeo','menubar=no,resizable=no,width=200,height=180');
}



