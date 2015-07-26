<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>  
    <META HTTP-EQUIV="Refresh" content="300"> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />   
    <meta http-equiv="Content-Language" content="es"> 
    <title><?php echo titulo;?></title>          
    <link rel="stylesheet" href="<?php echo css;?>estructura.css" type="text/css" />     
    <link rel="stylesheet" href="<?php echo css;?>menu.css" type="text/css" /> 
</head>
<body>
<div class="contenido2">
    <div class="contenidotabla">
        <h1><?php echo $titulo;?></h1>
        <?php echo $form_open;?>
        <table>
          <tr>
            <td width="20%">Nro.Asignacion:</td>
            <td class="formss" width="30%"><input name="asignacion" id="asignacion" type="text" value="<?php echo $lista->asignacion;?>" readonly="readonly" class="cajaMinima" style="background-color: #E6E6E6"/></td>
            <td>Fecha:</td>
            <td class="formss">
                <input name="fecha" id="fecha" type="text" value="<?php echo $lista->fecha;?>" readonly="readonly" class="cajaMinima"/>
            </td>                        
          </tr>  
          <tr>
            <td width="20%">Ciclo:</td>
            <td class="formss" width="30%"><?php echo $selciclo;?></td>
            <td width="20%">Tipo de estudio:</td>
            <td class="formss" width="30%"><?php echo $selcurso;?></td>                
          </tr>
          <tr>
            <td width="20%">Local:</td>
            <td class="formss" width="30%"><?php echo $sellocal;?></td>              
            <td>Aula:</td>
            <td class="formss" width="30%"><?php echo $selaula;?></td> 
          </tr>                     
          <tr>
            <td>Codigo de profesor:</td>
            <td class="formss">
                <input name="profesor" id="profesor" type="text" value="<?php echo $lista->profesor;?>" readonly="readonly" class="cajaMinima" style="background-color: #E6E6E6"/>
                <?php if($accion=='n'):;?>
                    <input id="ver_profesor" name="ver_profesor" type="button" class="aceptarlog2" alt="Buscar profesor" title="Buscar profesor" value="Buscar" />
                <?php endif;?>
            </td>
            <td>Nombre de curso:</td>
            <td class="formss" align="left"><input name="cursos" id="cursos" type="text" value="<?php echo $lista->curso;?>" readonly="readonly" class="cajaMedia" style="background-color: #E6E6E6"/></td>               
          </tr>
          <tr>
            <td>Apellidos y Nombres:</td>
            <td class="formss" align="left"><input name="nombres" id="nombres" type="text" value="<?php echo $lista->paterno.' '.$lista->materno.' '.$lista->nombres;?>" class="cajaGrande" readonly="readonly" style="background-color: #E6E6E6"/></td>
            <td>Estado:</td>
            <td class="formss"><?php echo $selestado;?></td> 
          </tr>                             
          <tr>
            <td colspan="4" class="formss">
                <div class="frmboton">
                    <div class="frmboton_matricula">
                        <input class="botones" id="cancelar" type="button" alt="Cancelar" title="Cancelar" value="Cancelar"/>                        
                        <input class="botones" id="imprimir" type="button" value="Imprimir" alt="Imprimir" title="Imprimir"/>                                    
                        <input class="botones" id="grabar" type="button" alt="Aceptar" title="Aceptar" value="Aceptar"/>
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
