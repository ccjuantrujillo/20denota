<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>  
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />   
    <meta http-equiv="Content-Language" content="es"> 
    <title><?php echo titulo;?></title>          
    <link href="<?php echo css;?>estructura.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?php echo js;?>jquery.js"></script>   
    <script type="text/javascript" src="<?php echo js;?>jquery.simplemodal.js"></script>      
    <script type="text/javascript" src="<?php echo js;?>constants.js"></script>     
    <script type="text/javascript" src="<?php echo js;?>ventas/actaprofesor.js"></script>    
</head>
<body>
<div class="contenido">  
    <div class="titulo"><h1><?php echo $titulo;?></h1></div>
    <?php echo $form_open;?>
    <div class="tabla"  style="width:100%;font-size: 11px;">
        <table  border="1">
          <tr class="list1">
            <td width="30">No</td>
            <td width="30">Curso</td>
            <td width="100">Apellidos y Nombres</td>
            <td width="30">H.Ingreso</td>
            <td width="30">H.Salida</td>
            <td width="80">Justificacion</td>
          </tr>
          <?php
          if(count($lista)>0){
            foreach($lista as $item => $value){
                $clase = ($item%2)==0?"list_a":"list_b";
               ?>
            <tr class="<?php echo $clase;?>">
                <td>
                    <?php echo $item+1;?>
                    <input type="hidden" value="<?php echo $value->codigo;?>" id="codigo[<?php echo $item;?>]" name="codigo[<?php echo $item;?>]" class="cajaReducida">
                    <input type="hidden" value="<?php echo $value->profesor;?>" id="profesor[<?php echo $item;?>]" name="profesor[<?php echo $item;?>]" class="cajaReducida">
                </td>
                <td><?php echo $value->curso;?></td>
                <td><?php echo $value->paterno." ".$value->materno." ".$value->nombres;?></td>
                <td><input type="time" value="<?php echo $value->hingreso;?>" id="hingreso[<?php echo $item;?>]" name="hingreso[<?php echo $item;?>]" class="cajaReducida"></td>
                <td><input type="time" value="<?php echo $value->hsalida;?>" id="hsalida[<?php echo $item;?>]" name="hsalida[<?php echo $item;?>]" class="cajaReducida"></td>
                <td><input type="text" value="<?php echo $value->observacion;?>" id="observacion[<?php echo $item;?>]" name="observacion[<?php echo $item;?>]" class="cajaGrande"></td>
              </tr>  
               <?php 
            }
          }
          else{
              ?>
            <tr class="list_a"><td colspan='6'>::NO EXISTEN REGISTROS::</td></tr>
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