<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>	
    <title><?php echo titulo;?></title>
    <META HTTP-EQUIV="Refresh" content="300"> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="es"> 
<!--    <script type="text/javascript" src="< ?php echo js;?>constants.js"></script> 
    <script type="text/javascript" src="< ?php echo js;?>jquery.js"></script>
    <script type="text/javascript" src="< ?php echo js;?>jquery.simplemodal.js"></script>    
    <script type="text/javascript" src="< ?php echo js;?>almacen/productoatributodetalle.js"></script>-->
</head>	
<body>
<div class="contenido">
    <div class="contenidotabla">
        <h1><?php echo $titulo;?></h1>
        <?php echo $form_open;?>
        <table style="background-color: #f4f7ff">
            <tr>
              <td width="50%" bgcolor="#d5e2f2">Curso</td>
              <td class="formss"><?php echo $selproducto;?> </td>
            </tr>     
            <tr>
              <td bgcolor="#d5e2f2">Semana</td>
              <td class="formss"><?php echo $selatributo;?> </td>
            </tr>           
            <tr>
              <td bgcolor="#d5e2f2">Nro.Pregunta</td>
              <td class="formss"><input type="text" class="cajaMinima" name="numero" id="numero" value="<?php echo $lista->numero;?>"  onkeydown="return numbersonly(this,event,'.');"></td>
            </tr>
            <tr>
              <td bgcolor="#d5e2f2">Descripcion Pregunta</td>
              <td class="formss"><input type="text" class="cajaGrande" name="descripcion" id="descripcion" value="<?php echo $lista->descripcion;?>"></td>
            </tr>  
            <tr>
              <td bgcolor="#d5e2f2"><input type="radio" name="flgcorrecta" id="flgcorrecta" value="1" <?php echo $lista->flgcorrecta==1?"checked='checked'":"";?>>Alternativa 1</td>
              <td class="formss"><textarea id="alternativa1" name="alternativa1" style="width: 250px;" rows="1" cols="1" class="textareaGrande"><?php echo $lista->alternativa1;?></textarea></td>
            </tr>      
            <tr>
                <td bgcolor="#d5e2f2"><input type="radio" name="flgcorrecta" id="flgcorrecta" value="2" <?php echo $lista->flgcorrecta==2?"checked='checked'":"";?>>Alternativa 2</td>
              <td class="formss"><textarea id="alternativa2" name="alternativa2" style="width: 250px;" rows="1" cols="1" class="textareaGrande"><?php echo $lista->alternativa2;?></textarea></td>
            </tr>   
            <tr>
              <td bgcolor="#d5e2f2"><input type="radio" name="flgcorrecta" id="flgcorrecta" value="3" <?php echo $lista->flgcorrecta==3?"checked='checked'":"";?>>Alternativa 3</td>
              <td class="formss"><textarea id="alternativa3" name="alternativa3" style="width: 250px;" rows="1" cols="1" class="textareaGrande"><?php echo $lista->alternativa3;?></textarea></td>
            </tr>   
            <tr>
              <td bgcolor="#d5e2f2"><input type="radio" name="flgcorrecta" id="flgcorrecta" value="4" <?php echo $lista->flgcorrecta==4?"checked='checked'":"";?>>Alternativa 4</td>
              <td class="formss"><textarea id="alternativa4" name="alternativa4" style="width: 250px;" rows="1" cols="1" class="textareaGrande"><?php echo $lista->alternativa4;?></textarea></td>
            </tr>   
            <tr>
              <td bgcolor="#d5e2f2"><input type="radio" name="flgcorrecta" id="flgcorrecta" value="5" <?php echo $lista->flgcorrecta==5?"checked='checked'":"";?>>Alternativa 5</td>
              <td class="formss"><textarea id="alternativa5" name="alternativa5" style="width: 250px;" rows="1" cols="1" class="textareaGrande"><?php echo $lista->alternativa5;?></textarea></td>
            </tr>   
        </table>
        <?php echo $oculto?>
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