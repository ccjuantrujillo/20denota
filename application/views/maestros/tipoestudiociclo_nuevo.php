<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <META HTTP-EQUIV="Refresh" content="300">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="es">
    <title><?php echo titulo;?></title>
    <link href="<?php echo css;?>estructura.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo css;?>jquery-ui.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="contenido">
    <div class="contenidotabla" >
        <h1><?php echo $titulo;?> </h1>
        <?php echo $form_open;?>
        <table style="background-color: #f4f7ff">
            <tr>
              <td width="50%" bgcolor="#d5e2f2">Codigo:</td>
              <td class="formss"><input name="codigo" id="codigo" type="text" value="<?php echo $lista->codigo;?>" readonly="readonly" class="cajaMinima" style="background-color: #E6E6E6"/></td>
            </tr> 
            <tr>
              <td bgcolor="#d5e2f2">Ciclo</td>
              <td class="formss"><?php echo $selciclo;?></td>
            </tr>   
            <tr>
              <td bgcolor="#d5e2f2">Tipo de estudio</td>
              <td class="formss"><?php echo $seltipoestudio;?></td>
            </tr>               
            <tr>
              <td bgcolor="#d5e2f2">Observacion:</td>
              <td class="formss"><input name="observacion" id="observacion" type="text" value="<?php echo $lista->observacion;?>" class="cajaSuperGrande"/></td>
            </tr>
          <tr>
            <td bgcolor="#d5e2f2">Estado</td>
            <td class="formss"><?php echo $selestado;?></td>
          </tr>             
        </table>
        <?php echo $oculto;?>
        <?php echo $form_close;?>
    </div>
    <div class="frmboton">
       <div class="frmboton_login">
           <input id="cancelar" class="botones" type="button" alt="Cancelar" title="Cancelar" value="Cancelar"/>
           <input id="grabar" class="botones" type="button" alt="Aceptar" title="Aceptar" value="Aceptar"/>
       </div>
    </div>      
</div>
</body>
</html>
