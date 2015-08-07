<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo titulo;?></title>
    <META HTTP-EQUIV="Refresh" content="300"> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />   
    <meta http-equiv="Content-Language" content="es"> 
    <link rel="stylesheet" href="<?php echo css;?>estilos.css" type="text/css">      
    <script type="text/javascript" src="<?php echo js;?>jquery.js"></script>         
    <script type="text/javascript" src="<?php echo js;?>constants.js"></script>     
    <script type="text/javascript" src="<?php echo js;?>seguridad/contrasena.js"></script>			
</head>
<body>
    <div class="contenido curbottom">
        <div class="cuerpomensaje">
            <?php echo $form_open;?>
            <p class="frmcamp"><label>Ingrese su correo</label></p>
            <p class="frmcamp"><input type="text" name="correo" id="correo" class="cajaGrande minus"></p>
            <p class="frmcamp"><input type="button" name="enviar" id="enviar" class="botones" value="Enviar"></p>
            <?php echo $form_close;?>
        </div>  
    </div>
</body>
</html>