<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="es"> 
    <title><?php echo titulo;?></title>        
    <link rel="stylesheet" href="<?php echo css;?>estructura.css" type="text/css" />     
    <link rel="stylesheet" href="<?php echo css;?>menu.css" type="text/css" /> 
    <link href="<?php echo css;?>jquery-ui.css" rel="stylesheet" type="text/css" />  
</head>
<body>
<div class="contenido">
    <div class="contenidotabla" >  
        <h1><?php echo $titulo;?></h1>    
        <?php echo $form_open;?>
        <table>
            <tr>
              <td width="50%">Codigo:</td>
              <td class="formss"><input name="codigo" id="codigo" type="text" value="<?php echo $lista->codigo;?>" readonly="readonly" class="cajaMinima" style="background-color: #E6E6E6"/></td>
            </tr>
            <tr>
              <td>D.N.I.:</td>
              <td class="formss"><input name="numero" id="numero" type="text" maxlength="8" value="<?php echo $lista->numerodoc;?>" class="cajaMinima" onkeydown="return numbersonly(this,event,'.');"/></td>
            </tr>
            <tr>
              <td>A.Paterno:</td>
              <td class="formss"><input name="paterno" id="paterno" type="text" value="<?php echo $lista->paterno;?>" class="cajaMedia"/></td>
            </tr>
            <tr>
              <td>A.Materno:</td>
              <td class="formss"><input name="materno" id="materno" type="text" value="<?php echo $lista->materno;?>" class="cajaMedia"/></td>
            </tr>
            <tr>
              <td>Nombres:</td>
              <td class="formss"><input name="nombres" id="nombres" type="text" value="<?php echo $lista->nombres;?>" class="cajaMedia"/></td>
            </tr>   
            <tr>
              <td>Email:</td>
              <td class="formss"><input name="email" id="email" type="text" value="<?php echo $lista->email;?>" class="cajaMedia minus" onblur="return ValidateEmail(this,event)"/></td>
            </tr>  
            <tr>
              <td>Telefono:</td>
              <td class="formss"><input name="telefono" id="telefono" type="text" value="<?php echo $lista->telefono;?>" class="cajaMedia"/></td>
            </tr>  
            <tr>
              <td>Direccion:</td>
              <td class="formss"><input name="direccion" id="direccion" type="text" value="<?php echo $lista->direccion;?>" class="cajaGrande"/></td>
            </tr>              
            <tr>
              <td>F.Nacimiento:</td>
              <td class="formss">
                  <input name="fnacimiento" id="fnacimiento" type="text"  value="<?php echo $lista->fnac;?>" class="cajaMinima" maxlength="10">
              </td>
            </tr>    
            <tr>
              <td>Estado:</td>
              <td class="formss"><?php echo $selestado;?></td>
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