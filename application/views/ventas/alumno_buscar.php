<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>  
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />   
    <meta http-equiv="Content-Language" content="es"> 
    <title><?php echo titulo;?></title>          
    <link rel="stylesheet" href="<?php echo css;?>estructura.css" type="text/css" />     
    <link rel="stylesheet" href="<?php echo css;?>menu.css" type="text/css" /> 
    <script type="text/javascript" src="<?php echo js;?>jquery.js"></script>   
    <script type="text/javascript" src="<?php echo js;?>jquery.simplemodal.js"></script>      
    <script type="text/javascript" src="<?php echo js;?>constants.js"></script>     
    <script type="text/javascript" src="<?php echo js;?>ventas/cliente.js"></script>    
</head>
<body>
<div class="contenido">  
    <div class="titulotabla">
        <h1>Buscar alumnos</h1>
    </div>
    <div class="listartabla" style="margin-top:5px;">
        <table  border="1"  cellspacing="0" cellpadding="0">
          <tr class="list1">
            <td width="43">No</td>
            <td width="193">Apellidos y Nombres</td>
            <td width="86">Fecha registro</td>
          </tr>
          <?php
          if(count($lista)>0){
            foreach($lista as $item => $value){
                $flgestado = $value->estado;
                $estado = $flgestado==1?"Activo":"Inactivo";
                $clase = ($item%2)==0?"list_a":"list_b";
               ?>
            <tr class="<?php echo $clase;?>" id="<?php echo $value->codigo;?>" onclick="selecciona_familia(<?php echo $value->codigo;?>);">
                <td><?php echo ++$j;?></td>
                <td align="left"><?php echo $value->paterno." ".$value->materno." ".$value->nombres;?></td>
                <td align="center"><?php echo $value->fechareg;?></td>
              </tr>  
               <?php 
            }
          }
          else{
              ?>
            <tr class="list_a"><td colspan='4'>::NO EXISTEN REGISTROS::</td></tr>
              <?php
          }
          ?>
        </table>
        <div class="mensajetabla"><?php echo $paginacion;?></div>
    </div>
</div>	
</body>
</html>
