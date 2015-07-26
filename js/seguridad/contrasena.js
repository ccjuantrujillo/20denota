jQuery(document).ready(function(){
    $("#cancelar").click(function(){
        url = base_url+"index.php/inicio/index";
        location.href = url;
    });    
    
    $("#enviar").click(function(){
        dataString  = $('#frmContrasena').serialize();
        url = base_url+"index.php/inicio/contrasena_enviar";
        $.post(url,dataString,function(data){
            alert("Se envio un mensaje a su correo");
            url = base_url+"index.php/inicio/index";
            location.href = url;
        });  
    }); 
});
