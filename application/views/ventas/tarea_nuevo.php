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
    <h1><?php echo $titulo;?></h1>    
    <?php echo $form_open;?>
    <div id="cabecera">
        <table  style="background-color: #f4f7ff">
            <tr>
                <td  width='18%' align="right">Codigo:</td>
                <td width='20%' colspan="3" class="formss">
                    <input type='text' name="codigo" id="codigo" value="<?php echo $lista->tarea;?>" class="cajaReducida" onkeydown="return numbersonly(this,event,'.');" readonly="readonly"/>
                    &nbsp;&nbsp;&nbsp;Tipo de tarea:<?php echo $seltipotarea;?>
                </td>
                <td align="right">Fecha&nbsp;</td>
                <td width='29%' class="formss"><input type="text" name="fecha" id="fecha" style="width:60px" readonly value="<?php echo $lista->fecha;?>" class="cajaMinima" maxlength="10"></td>
            </tr>
            <tr>
                <td align="right">Ciclo:</td>
                <td align="left" colspan="3" class="formss"><?php echo $selciclo;?></td>
                <td align="right">Fecha Entrega:</td>
                <td align="left" class="formss"><input type="text" name="fechaentrega" id="fechaentrega" style="width:60px" readonly value="<?php echo $lista->fechaentrega;?>" class="cajaMinima" maxlength="10"></td>                
            </tr>             
            <tr>
                <td align="right">Plana: </td>
                <td align="left" colspan="3" class="formss"><span><?php echo $selcurso;?></span></td>
                <td align="right">Elaborado por:</td>
                <td align="left" class="formss"><span><?php echo $selprofesor;?></span></td>
            </tr>
            <tr>
                <td align="right">Nombre: </td>
                <td align="left" class="formss" colspan="3"><input type='text' name="nombre" id="nombre" value="<?php echo $lista->nombre;?>" class="cajaSuperGrande"></td>
                <td align="right">Numero:</td>
                <td align="left" class="formss"><input type="text" name="numero" id="numero" style="width:60px" value="<?php echo $lista->numero;?>" class="cajaMinima" maxlength="10"></td>
            </tr>  
            <tr>
                <td valign="top" align="right">Descripcion: </td>
                <td align="left" colspan="5" class="formss">
                    <span><textarea style="width:480px;" type='text' name="descripcion" id="descripcion" class="get text"><?php echo $lista->descripcion;?></textarea></span>
                    <span><a href="#" id="agregar">Agregar</a></span>
                </td>
            </tr>
        </table>
    </div>
    <div id="detalle" style = "float: left; height: 270px;overflow: auto; width: 100%;background: #e8edff;">
        <table width="100%" id="tabla_detalle">
            <tr>
                <th width="3%" align="center">No</th>
                <th width="10%" align="center">Tipo estudio</th>
                <th width="30%" align="center">Tema</th>
                <th width="30%" align="center">Profesor</th>
                <th align="center">Cantidad</th>
                <th align="center">F.Entrega</th> 
                <th align="center">Acciones</th>
            </tr>
            <?php
            if(count($lista->tareadetalle)>0){
                foreach($lista->tareadetalle as $item => $value){
                    if($codigodetalle==$value->TAREADETP_Codigo){
                    $optResponsable = "";
                    foreach ($responsable as $item2 => $value2){
                        $optResponsable.= "<option value='".$item2."' ".($item2==$value->PROP_Codigo?"selected='selected'":"").">".$value2."</option>";
                    }
                    ?>
                    <tr id="<?php echo $value->TAREADETP_Codigo;?>">
                        <td width="3%" align="center"><?php echo $item+1;?></td>
                        <td width="3%" align="center"><input type="text" class="cajaMedia" name="nombre[<?php echo $item;?>]" id="nombre[<?php echo $item;?>]" value="<?php echo $value->ACTADETC_Nombre;?>"></td>                        
                        <td align="left" valign="top"><textarea name="acuerdo[<?php echo $item;?>]" id="acuerdo[<?php echo $item;?>]" placeholder='Acuerdos de la reunion' cols='53' rows='1'><?php echo $value->ACTADETC_Observacion;?></textarea></td>
                        <td align="center"><select class="comboGrande" name="responsable[<?php echo $item;?>]" id="responsable[<?php echo $item;?>]"><?php echo $optResponsable;?></select></td>
                        <td align="center"><input type='text' maxlength='10' class='cajaMinima' name="fcompromiso[<?php echo $item;?>]" id="fcompromiso[<?php echo $item;?>]" onmousedown="$(this).datepicker({dateFormat:'dd/mm/yy',changeYear: true,yearRange:'1945:2025'});" value="<?php echo date_sql($value->ACTADETC_FechaCompromiso);?>"></td> 
                        <td align="center">
                            <a href="#" class="editardetalle">Editar</a>
                            <a href="#" class="eliminardetalle">Eliminar</a>
                        </td>
                    </tr>
                    <?php                            
                    }
                    else{
                        ?>
                        <tr id="<?php echo $value->TAREADETP_Codigo;?>">
                            <td align="center"><?php echo $item+1;?></td>
                            <td align="center"><?php echo $value->TIPC_Nombre;?></td>
                            <td align="center"><?php echo $value->TEMAC_Descripcion;?></td>
                            <td align="center"><?php echo $value->PERSC_ApellidoPaterno." ".$value->PERSC_ApellidoMaterno." ".$value->PERSC_Nombre;?></td>
                            <td align="center"><?php echo $value->TAREADETC_Cantidad;?></td>
                            <td align="center"><?php echo date_sql($value->TAREADETC_FechaEntrega);?></td> 
                            <td align="center">
                                <a href="#" class="editardetalle">Editar</a>
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