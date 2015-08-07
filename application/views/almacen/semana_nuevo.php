<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>	
    <title><?php echo titulo;?></title>
    <META HTTP-EQUIV="Refresh" content="300"> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="es"> 
    <link rel="stylesheet" href="<?php echo css;?>estructura.css" type="text/css" />        
<!--    <script type="text/javascript" src="< ?php echo js;?>constants.js"></script> 
    <script type="text/javascript" src="< ?php echo js;?>jquery.js"></script>
    <script type="text/javascript" src="< ?php echo js;?>jquery.simplemodal.js"></script>    
    <script type="text/javascript" src="< ?php echo js;?>almacen/productoatributo.js"></script>-->
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
                  <td bgcolor="#d5e2f2">Nombre del video</td>
                  <td class="formss"><input type="text" class="cajaGrande" name="nombre" id="nombre" value="<?php echo $lista->nombre;?>"></td>
                </tr>
                <tr>
                  <td bgcolor="#d5e2f2">Descripcion</td>
                  <td class="formss"><textarea name="descripcion" id="descripcion" cols="1" rows="3" style="width:250px" class="textareaGrande"><?php echo $lista->descripcion;?></textarea></td>
                </tr>  
                <tr>
                  <td bgcolor="#d5e2f2">Preguntas necesarias</td>
                  <td class="formss">
                      <input type="text" class="cajaMinima" name="preguntas" id="preguntas" value="<?php echo $lista->preguntasnec;?>" onkeydown="return numbersonly(this,event,'.');" maxlength="2">
                      <span >Preguntas cargadas</span>
                      <input type="text" class="cajaMinima" name="cargadas" id="cargadas" value="<?php echo $lista->preguntas;?>" readonly="readonly" maxlength="2" style="width:60px; background-color: #E6E6E6">
                  </td>
                </tr> 
                <tr>
                  <td bgcolor="#d5e2f2">Video VIMEO<br>(Copiar aqui el enlace)</td>
                  <td class="formss"><textarea name="vimeo" id="vimeo" cols="1" rows="3" style="width:250px" class="textareaGrande"><?php echo $lista->vimeo;?></textarea></td>
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