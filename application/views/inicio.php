<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?php echo titulo;?></title>
    <link rel="stylesheet" href="<?php echo css;?>estructura.css" type="text/css" />     
    <link rel="stylesheet" href="<?php echo css;?>menu.css" type="text/css" /> 
    <script type="text/javascript" src="<?php echo js;?>jquery.js"></script>
    <script type="text/javascript" src="<?php echo js;?>jquery.simplemodal.js"></script>   
    <script type="text/javascript" src="<?php echo js;?>constants.js"></script>     
    <script type="text/javascript" src="<?php echo js;?>inicio.js"></script>
</head>
    <body <?php echo $onload;?>>
<div class="contenido" > 
    <div align='center' class='error' id='divMayus' style='display: none'>Recuerde Colocar Usuario y Clave en MAYUSCULAS .</div>
    <div class="header"><?php echo $header;?></div>
    <div class="zonelogin">
        <?php echo $form_open;?>
        <div class="frmlogin">
            <div class="frmlog">
              <form>
                <p class="frmcamp">
                    <span>Usuario</span> 
                    <input name="txtUsuario" type="text" id="txtUsuario" class="cajaMedia minus"/>
                </p>
                <p class="frmcamp">
                    <span>Password</span> 
                    <input name="txtClave" type="password" class="cajaMedia" onKeyPress="return submitenter(this,event);return capLock(event)"  id="txtClave"/>                          
                </p>                
                </form>              
            </div> 
            <div class="frmboton">
                <h2><a id="contrasena_mensaje" href="#">¿Olvido su contraseña?</a></h2> 
                <div class="frmboton_login">
                    <input type="reset" class="botones" value="Limpiar" alt="Limpiar" title="Limpiar" id="cancelar"/>
                    <input type="button" class="botones" value="Aceptar" alt="Aceptar" title="Aceptar" id="ingresar"/>
                </div>
            </div>
        </div>       
        <?php echo $form_close;?>
    </div>
<div class="footer"><h2><?php echo pie;?></h2></div>
</div>
 <div id="basic-modal-content"><div id="mensaje">&nbsp;</div></div>      
</body>
</html>
