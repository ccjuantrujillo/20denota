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
<div class="contenidotabla" >
    <h1><?php echo $titulo;?> </h1>
    <?php echo $form_open;?>
    <div id="cabecera" style="height: 450px;">
        <table style="background-color: #f4f7ff">
            <tr>
              <td style="text-align:right;" width="50%" bgcolor="#d5e2f2">Codigo:&nbsp;</td>
              <td class="formss"><input name="codigo" id="codigo" type="text" value="<?php echo $lista->codigo;?>" readonly="readonly" class="cajaMinima" style="background-color: #E6E6E6"/></td>
            </tr> 
            <tr>
              <td style="text-align:right;" bgcolor="#d5e2f2">Fecha:&nbsp;</td>
              <td class="formss"><input name="fecha" id="fecha" type="text" value="<?php echo $lista->fecha;?>" readonly="readonly" class="cajaMinima"></td>
            </tr>             
            <tr>
              <td style="text-align:right;" bgcolor="#d5e2f2">Local:&nbsp;</td>
              <td class="formss"><?php echo $sellocal;?></td>
            </tr>             
            <tr>
              <td style="text-align:right;"  bgcolor="#d5e2f2">Aula:&nbsp;</td>
              <td class="formss"><?php echo $selaula;?></td>
            </tr>   
            <tr>
              <td style="text-align:right;" bgcolor="#d5e2f2">Tipo:&nbsp;</td>
              <td class="formss"><?php echo $seltipo;?></td>
            </tr>               
            <tr>
              <td style="text-align:right;" bgcolor="#d5e2f2">Profesor:&nbsp;</td>
              <td class="formss">
                  <input name="profesor" id="profesor" type="text" value="<?php echo $lista->profesor;?>" readonly="readonly" class="cajaReducida">&nbsp;
                  <input name="nombres" id="nombres" type="text" value="<?php echo $lista->nombres;?>" readonly="readonly" class="cajaGrande">&nbsp;
                  <input id="ver_profesor" name="ver_profesor" type="button" class="aceptarlog2" alt="Buscar profesor" title="Buscar profesor" value="Buscar">                          
              </td>
            </tr>               
            <tr>
              <td style="text-align:right;" bgcolor="#d5e2f2">H.Inicio:&nbsp;</td>
              <td class="formss"><input name="hinicio" id="hinicio" type="time" value="<?php echo $lista->hinicio;?>" class="cajaReducida"></td>
            </tr>                           
            <tr>
              <td style="text-align:right;" bgcolor="#d5e2f2">H.Fin:&nbsp;</td>
              <td class="formss"><input name="hfin" id="hfin" type="time" value="<?php echo $lista->hfin;?>" class="cajaReducida"></td>
            </tr>
          <tr>
            <td style="text-align:right;" bgcolor="#d5e2f2">Reemplazado por:&nbsp;</td>
            <td class="formss">
                <input name="reemplazo" id="reemplazo" type="text" value="<?php echo $lista->reemplazo;?>" class="cajaReducida" readonly="readonly">&nbsp;
                <input name="nombres_reemp" id="nombres_reemp" type="text" value="<?php echo $lista->nombres_reemp;?>" readonly="readonly" class="cajaGrande">                                      
                <input id="ver_reemplazo" name="ver_reemplazo" type="button" class="aceptarlog2" alt="Buscar reemplazo" title="Buscar reemplazo" value="Buscar">                                              
            </td>
          </tr>             
        </table> 
    </div>
    <div class="frmboton">
        <input id="cancelar" class="botones" type="button" alt="Cancelar" title="Cancelar" value="Cancelar"/>
        <input id="grabar" class="botones" type="button" alt="Aceptar" title="Aceptar" value="Aceptar"/>   
    </div>
    <?php echo $oculto;?>
    <?php echo $form_close;?>
</div>
</body>
</html>
