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
        <h1><?php echo $titulo;?></h1>    
        <?php echo $form_open;?>
        <div id="cabecera">
            <table  style="background-color: #f4f7ff">
                <tr>
                    <td  width='18%' align="right">Codigo: </td>
                    <td width='20%' colspan="3" class="formss">
                        <input type='text' name="codigo" id="codigo" value="<?php echo $lista->acta;?>" readonly="readonly" class="cajaReducida" style="background-color: #E6E6E6">
                        &nbsp;&nbsp;&nbsp;Numero:<input type='text' name="numero" id="numero" value="<?php echo $lista->numero;?>" class="cajaMinima" onkeydown="return numbersonly(this,event,'.');">
                    </td>
                    <td align="right">Fecha&nbsp;</td>
                    <td width='29%' class="formss"><input type="text" name="fecha" id="fecha" style="width:60px" readonly value="<?php echo $lista->fecha;?>" class="cajaMinima" maxlength="10"></td>
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
                    <td valign="top" align="right">Agenda: </td>
                    <td align="left" colspan="5" class="formss"><span><textarea style="width:480px;" type='text' name="agenda" id="agenda" class="get text"><?php echo $lista->agenda;?></textarea></span></td>
                </tr>
            </table>
        </div>
        <div id="detalle" style = "float: left; height: 270px;overflow: auto; width: 100%;background: #e8edff;">
            <table width="100%" id="tabla_detalle">
                <tr>
                    <th width="3%" align="center">No</th>
                    <th width="50%" align="center">Acuerdos</th>
                    <th align="center">Responsable</th>
                    <th align="center">F.Compromiso</th> 
                    <th align="center">Acciones</th>
                </tr>
                <?php
                if(count($lista->actadetalle)>0){
                    foreach($lista->actadetalle as $item => $value){
                        if($codigodetalle==$value->ACTADETP_Codigo){
                        $optResponsable = "";
                        foreach ($responsable as $item2 => $value2){
                            $optResponsable.= "<option value='".$item2."' ".($item2==$value->PROP_Codigo?"selected='selected'":"").">".$value2."</option>";
                        }
                        ?>
                        <tr id="<?php echo $value->ACTADETP_Codigo;?>">
                            <td width="3%" align="center"><?php echo $item+1;?></td>
                            <td align="left" valign="top">
                                <textarea name="acuerdo[<?php echo $item;?>]" id="acuerdo[<?php echo $item;?>]" placeholder='Acuerdos de la reunion' cols='53' rows='1'><?php echo $value->ACTADETC_Observacion;?></textarea>
                            </td>
                            <td align="center"><select class="comboGrande" name="responsable[<?php echo $item;?>]" id="responsable[<?php echo $item;?>]"><?php echo $optResponsable;?></select></td>
                            <td align="center"><input type='text' maxlength='10' class='cajaMinima' name="fcompromiso[<?php echo $item;?>]" id="fcompromiso[<?php echo $item;?>]" onmousedown="$(this).datepicker({dateFormat:'dd/mm/yy',changeYear: true,yearRange:'1945:2025'});" value="<?php echo date_sql($value->ACTADETC_FechaCompromiso);?>"></td> 
                            <td align="center">
                                <a href="#" class="editardetalle">Editar</a>&nbsp;
                                <a href="#" class="eliminardetalle">Eliminar</a>
                            </td>
                        </tr>
                        <?php                            
                        }
                        else{
                            ?>
                            <tr id="<?php echo $value->ACTADETP_Codigo;?>">
                                <td width="3%" align="center"><?php echo $item+1;?></td>
                                <td align="left"><?php echo $value->ACTADETC_Observacion;?></td>
                                <td align="center"><?php echo $value->PERSC_ApellidoPaterno." ".$value->PERSC_ApellidoMaterno." ".$value->PERSC_Nombre;?></td>
                                <td align="center"><?php echo date_sql($value->ACTADETC_FechaCompromiso);?></td> 
                                <td align="center">
                                    <a href="#" class="editardetalle">Editar</a>&nbsp;
                                    <a href="#" class="eliminardetalle">Eliminar</a>
                                </td>
                            </tr>                            
                            <?php
                        }
                    ?>
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
        <div id="asistentes">
            <h3>Asistencia: </h3>            
            <table width="100%">
                <tr>
                    <th width="3%" align="center">No</th>
                    <th width="50%" align="center">Apellidos y Nombres</th>
                    <th align="center">H.Ingreso</th>
                    <th align="center">H.Salida</th> 
                    <th align="center">Justificacion</th>
                </tr>
                <?php
                if(count($asistentes)>0){
                    foreach($asistentes as $item => $value){
                        ?>
                        <tr>
                            <th width="3%" align="center"><?php echo $item+1;?></th>
                            <th width="50%" align="center"><?php echo $value->PERSC_ApellidoPaterno." ".$value->PERSC_ApellidoMaterno." ".$value->PERSC_Nombre;?></th>
                            <th align="center"><input type="time" value="" id="" name="" class="cajaReducida"></th>
                            <th align="center"><input type="time" valeu="" id="" name="" class="cajaReducida"</th> 
                            <th align="center"><input type="text" valeu="" id="" name="" class="cajaGrande"</th>
                        </tr>  
                        <?php
                    }
                }
                ?>
            </table>
        </div>
        <div class="frmboton">
            <div class="frmboton_matricula">
                <input id="cancelar" class="botones" type="button" alt="Cancelar" title="Cancelar" value="Cancelar"/>
                <input id="imprimir" class="botones" type="button" value="Imprimir" alt="Imprimir" title="Imprimir"/>                        
                <input id="grabar" class="botones" type="button" alt="Aceptar" title="Aceptar" value="Aceptar"/>
            </div>
        </div>
        <?php echo $oculto;?>
        <?php echo $form_close;?>
    </div>
</div>
</body>
</html>