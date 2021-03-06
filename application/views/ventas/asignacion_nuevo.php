<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>  
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />   
    <meta http-equiv="Content-Language" content="es"> 
    <title><?php echo titulo;?></title>          
    <link rel="stylesheet" href="<?php echo css;?>estructura.css" type="text/css" />  
    <link href="<?php echo css;?>jquery-ui.css" rel="stylesheet" type="text/css" />      
    <link rel="stylesheet" href="<?php echo css;?>menu.css" type="text/css" /> 
</head>
<body>
<div class="contenido">
    <div class="contenidotabla">
        <h1><?php echo $titulo;?></h1>
        <?php echo $form_open;?>
        <div id="cabecera">
            <table style="background-color: #f4f7ff">
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
                <td>Estado:</td>
                <td class="formss"><?php echo $selestado;?></td>                
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
                <td class="formss" align="left" colspan="3">
                    <input name="nombres" id="nombres" type="text" value="<?php echo $lista->paterno.' '.$lista->materno.' '.$lista->nombres;?>" class="cajaGrande" readonly="readonly" style="background-color: #E6E6E6"/>&nbsp;&nbsp;
                    <a href="#" id="agregar">Agregar</a>
                </td>
              </tr>                             
            </table>
        </div>
        <div id="detalle" style = "float: left; height: 270px;overflow: auto; width: 100%;background: #e8edff;">
            <table width="100%" id="tabla_detalle">
                <tr>
                    <th width="3%" align="center">No</th>
                    <th width="5%" align="center">Dia</th>
                    <th align="center">Tipo estudio</th> 
                    <th align="center">Local</th>
                    <th align="center">Aula</th> 
                    <th align="center">Desde</th> 
                    <th align="center">Hasta</th> 
                    <th align="center">Acciones</th>
                </tr>
                <?php
                if(count($lista->asignaciondetalle)>0){
                    foreach($lista->asignaciondetalle as $item => $value){
                        ?>
                        <tr id="<?php echo $value->ASIGDETP_Codigo;?>">
                            <td width="3%" align="center"><?php echo $item+1;?></td>
                            <td align="center"><?php echo $semana[$value->ASIGDETC_Dia];?></td>
                            <td align="center"><?php echo $value->TIPC_Nombre;?></td>
                            <td align="center"><?php echo $value->LOCC_Nombre;?></td> 
                            <td align="center"><?php echo $value->AULAC_Nombre;?></td> 
                            <td align="center"><?php echo substr($value->ASIGDETC_Desde,0,5);?></td> 
                            <td align="center"><?php echo substr($value->ASIGDETC_Hasta,0,5);?></td> 
                            <td align="center">
                                <a href="#" class="editardetalle">Editar</a>&nbsp;
                                <a href="#" class="eliminardetalle">Eliminar</a>
                            </td>
                        </tr>                
                        <?php
                    ?>
                    <?php                                
                    }
                }
                else{
                    ?>
<!--                    <tr><td colspan="8" align="center">:::NO EXISTEN REGISTROS:::</td></tr>-->
                    <?php
                }
                ?>
            </table>
        </div>
        <div class="frmboton">
            <div class="frmboton_matricula">
                <input class="botones" id="cancelar" type="button" alt="Cancelar" title="Cancelar" value="Cancelar"/>       
                <input class="botones" id="imprimir" type="button" value="Imprimir" alt="Imprimir" title="Imprimir"/>                  
                <input class="botones" id="grabar" type="button" alt="Aceptar" title="Aceptar" value="Aceptar"/>
            </div>
        </div>        
        <?php echo $oculto;?>
        <?php echo $form_close;?>
    </div>
</div>    
</body>
</html>