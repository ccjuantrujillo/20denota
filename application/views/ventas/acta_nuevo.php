<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="es"> 
    <title><?php echo titulo;?></title>        
    <link href="<?php echo css;?>estructura.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo css;?>jquery-ui.css" rel="stylesheet" type="text/css" />    
</head>
<body>
<div class="contenidotabla" >  
    <h1><?php echo $titulo;?></h1>    
    <?php echo $form_open;?>
    <div id="cabecera">
        <table  style="background-color: #f4f7ff">
            <tr>
                <td  width='18%' align="right">Codigo: </td>
                <td width='20%' colspan="3" class="formss"><input type='text' name="codigo" id="codigo" value="<?php echo $lista->acta;?>" readonly="readonly" class="cajaReducida"></td>
                <td align="right">Fecha&nbsp;</td>
                <td width='29%' class="formss"><input type="text" name="fecha" id="fecha" style="width:60px" readonly value="<?php echo $lista->fecha;?>" class="cajaMinima" maxlength="10"></td>
            </tr>
            <tr>
                <td align="right">Ciclo:</td>
                <td align="left" colspan="3" class="formss"><?php echo $selciclo;?></td>
                <td align="right">Tipo Estudio:</td>
                <td align="left" class="formss"><?php echo $seltipoestudio;?></td>                
            </tr>             
            <tr>
                <td align="right">Plana: </td>
                <td align="left" colspan="3" class="formss"><span><?php echo $selcurso;?></span></td>
                <td align="right">Elaborado por:</td>
                <td align="left" class="formss"><span><?php echo $selprofesor;?></span></td>
            </tr>
            <tr>
                <td align="right">Nombre de Reuni&oacute;n: </td>
                <td align="left" class="formss" colspan="3"><input type='text' name="titulo" id="titulo" value="<?php echo $lista->titulo;?>" class="cajaSuperGrande"></td>
                <td align="right">H.Inicio</td>
                <td align="left" class="formss">
                    <span><input id="hinicio" type='time' maxlength="5" name="hinicio" value="<?php echo $lista->hinicio;?>"  class="cajaReducida" onblur="valida(this.value,this);" ></span>
                    <span>&nbsp;H.Fin&nbsp; <input id="hfin" maxlength="5" type='time' name="hfin" value="<?php echo $lista->hfin;?>"  class="cajaReducida" onblur="valida(this.value,this);" ></span>
                </td>
            </tr>  
            <tr>
                <td valign="top" align="right">Descripcion: </td>
                <td align="left" colspan="5" class="formss">
                    <span><textarea style="width:480px;" type='text' name="agenda" id="agenda" class="get text"><?php echo $lista->agenda;?></textarea></span>
                    <span><input id="ver_asistentes" name="ver_asistentes" type="button" class="aceptarlog2" alt="Ver asistentes" title="Ver asistentes" value="Asistentes"></span>
                    <span><a href="#" id="agregar">Agregar</a></span>
                </td>
            </tr>
        </table>
    </div>
    <div id="detalle" style = "float: left; height: 270px;overflow: auto; width: 100%;background: #e8edff;">
        <table width="100%" id="tabla_detalle">
            <tr>
                <th width="3%" align="center">No</th>
                <th width="10%" align="center">Nombre</th>
                <th width="50%" align="center">Descripcion</th>
                <th align="center">Acciones</th>
            </tr>
            <?php
            if(count($lista->actadetalle)>0){
                foreach($lista->actadetalle as $item => $value){
                    ?>
                    <tr id="<?php echo $value->ACTADETP_Codigo;?>">
                        <td width="3%" align="center"><?php echo $item+1;?></td>
                        <td width="3%" align="center"><?php echo $value->ACTADETC_Nombre;?></td>
                        <td align="left"><?php echo $value->ACTADETC_Observacion;?></td>
                        <td align="center">
                            <a href="#" class="editardetalle">Editar</a>
                            <a href="#" class="eliminardetalle">Eliminar</a>
                        </td>
                    </tr>                            
                <?php                                
                }
            }
            else{
                ?>
<!--                    <tr><td colspan="7" align="center">:::NO EXISTEN REGISTROS:::</td></tr>-->
                <?php
            }
            ?>
        </table>
    </div>
    <div class="frmboton">
        <input id="cancelar" class="botones" type="button" alt="Cancelar" title="Cancelar" value="Cancelar"/>
        <input id="imprimir" class="botones" type="button" value="Imprimir" alt="Imprimir" title="Imprimir"/>                        
        <input id="grabar" class="botones" type="button" alt="Grabar" title="Grabar" value="Grabar"/>
    </div>
    <?php echo $oculto;?>
    <?php echo $form_close;?>
</div>
</body>
</html>