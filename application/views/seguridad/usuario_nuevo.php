<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo titulo;?></title>
    <META HTTP-EQUIV="Refresh" content="300"> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />   
    <meta http-equiv="Content-Language" content="es"> 
    <link rel="stylesheet" href="<?php echo css;?>estructura.css" type="text/css" />     
    <link rel="stylesheet" href="<?php echo css;?>menu.css" type="text/css" />       
    <script type="text/javascript" src="<?php echo js;?>jquery.js"></script>    
    <script type="text/javascript" src="<?php echo js;?>jquery.simplemodal.js"></script>           
    <script type="text/javascript" src="<?php echo js;?>constants.js"></script>     
    <script type="text/javascript" src="<?php echo js;?>seguridad/usuario.js"></script>			
</head>
<body <?php echo $onload;?>>
<div class="contenido">
    <div class="contenidotabla">
        <h1><?php echo $titulo;?></h1>
        <div class="case_top">
            <?php echo $form_open;?>
                <table class="fuente8" width="100%" style="background-color: #f4f7ff">
                    <tr>
                      <td width="50%" bgcolor="#d5e2f2">Codigo</td>
                      <td class="formss">
                          <input type="text" class="cajaMinima" name="usuario" id="usuario" value="<?php echo $lista->usuario;?>" style="background-color: #E6E6E6" readonly="readonly">
                          <?php if($accion=='n'):;?> 
                              &nbsp;<input id="ver_profesor" name="ver_profesor" type="button" class="aceptarlog2" alt="Importar profesor" title="Importar profesor" value="Importar"/>                              
                          <?php endif;?>    
                      </td>
                    </tr>                    
                    <tr>
                      <td width="50%" bgcolor="#d5e2f2">Apellido Paterno</td>
                      <td class="formss"><input type="text" class="cajaMedia" name="paterno" id="paterno" value="<?php echo $lista->paterno;?>" readonly="readonly"></td>
                    </tr>
                    <tr>
                      <td width="50%" bgcolor="#d5e2f2">Apellido Materno</td>
                      <td class="formss"><input type="text" class="cajaMedia" name="materno" id="materno" value="<?php echo $lista->materno;?>" readonly="readonly"></td>
                    </tr>                    
                    <tr>
                      <td width="50%" bgcolor="#d5e2f2">Nombres</td>
                      <td class="formss"><input type="text" class="cajaMedia" name="nombres" id="nombres" value="<?php echo $lista->nombres;?>" readonly="readonly"></td>
                    </tr>
                    <tr>
                      <td width="50%" bgcolor="#d5e2f2">Usuario</td>
                      <td class="formss"><input type="text" class="cajaMedia" name="login" id="login" value="<?php echo $lista->login;?>"></td>
                    </tr>   
                    <tr>
                      <td width="50%" bgcolor="#d5e2f2">Clave</td>
                      <td class="formss"><input type="password" class="cajaMedia" name="clave" id="clave" value="<?php echo $lista->clave;?>"></td>
                    </tr>  
                    <tr>
                      <td width="50%" bgcolor="#d5e2f2">Rol</td>
                      <td class="formss"><?php echo $selrol;?></td>
                    </tr>
                    <tr>
                      <td width="50%" bgcolor="#d5e2f2">Estado</td>
                      <td class="formss"><?php echo $selestado;?></td>
                    </tr>                    
                </table>
                <?php echo $oculto;?>
            <?php echo $form_close;?>
        </div> 
        <div class="frmboton">
            <div class="frmboton_matricula">
                <input class="botones" id="cancelar" type="button" alt="Cancelar" title="Cancelar" value="Cancelar"/>                                                      
                <input class="botones" id="grabar" type="button" alt="Aceptar" title="Aceptar" value="Aceptar"/>
            </div>
        </div>            
    </div>
</div>
</body>
</html>