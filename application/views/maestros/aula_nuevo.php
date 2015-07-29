<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <META HTTP-EQUIV="Refresh" content="300">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="es">
    <title><?php echo titulo;?></title>
    <link href="<?php echo css;?>estructura.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo css;?>jquery-ui.css" rel="stylesheet" type="text/css" />
<!--    <script type="text/javascript" src="<?php echo js;?>constants.js"></script> -->
<!--    <script type="text/javascript" src="< ?php echo js;?>jquery.js"></script>
    <script type="text/javascript" src="< ?php echo js;?>jquery-ui.min.js"></script>        -->
<!--    <script type="text/javascript" src="< ?php echo js;?>jquery.simplemodal.js"></script>
    <script type="text/javascript" src="< ?php echo js;?>ventas/cliente.js"></script>	    -->
</head>
<body>
<div class="contenido">
    <div class="contenidotabla" >
        <h1><?php echo $titulo;?> </h1>
        <?php echo $form_open;?>
        <table>
            <tr>
              <td width="50%">Codigo:</td>
              <td class="formss"><input name="codigo" id="codigo" type="text" value="<?php echo $lista->codigo;?>" readonly="readonly" class="cajaMinima" style="background-color: #E6E6E6"/></td>
            </tr>
            <tr>
              <td>Nombre:</td>
              <td class="formss"><input name="nombre" id="nombre" type="text" value="<?php echo $lista->nombre;?>" class="cajaGrande"/></td>
            </tr>
            <tr>
              <td>Local:</td>
              <td class="formss"><?php echo $sellocal;?></td>
            </tr>
            <tr>
              <td colspan="2">
                <div class="frmboton">
                    <div class="frmboton_login">
                        <input id="cancelar" class="botones" type="button" alt="Cancelar" title="Cancelar" value="Cancelar"/>
                        <input id="grabar" class="botones" type="button" alt="Aceptar" title="Aceptar" value="Aceptar"/>
                    </div>
                </div>
              </td>
            </tr>
        </table>
        <?php echo $oculto;?>
        <?php echo $form_close;?>
    </div>
</div>
</body>
</html>