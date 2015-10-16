<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <META HTTP-EQUIV="Refresh" content="300">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="es">
    <title><?php echo titulo;?></title>
    <link rel="stylesheet" href="<?php echo css;?>estructura.css" type="text/css" />     
    <link rel="stylesheet" href="<?php echo css;?>menu.css" type="text/css" /> 
    <script type="text/javascript" src="<?php echo js;?>jquery.js"></script>
    <script type="text/javascript" src="<?php echo js;?>jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo js;?>jquery.simplemodal.js"></script>
    <script type="text/javascript" src="<?php echo js;?>constants.js"></script>    
    <script type="text/javascript" src="<?php echo js;?>maestros/ciclo.js"></script>
</head>
<body>
<div class="contenido" >
    <div class="header"><?php echo $header;?></div>
    <div class="menu"><ul id="nav"><?php echo $menu;?></ul></div>
    <div class="titulo">
        <input name="" type="button" class="aceptarlog2" alt="Aceptar" title="Aceptar" value="Crear un nuevo ciclo" id="nuevo"/>
        <h1>Listado de ciclos</h1>
    </div>
    <div class="mensaje">Se han encontrado (<?php echo $registros;?>) registros(s)</div>
    <div class="tabla">
        <table>
          <tr class="list1">
            <td width="10">No</td>
            <td width="60">Nombre</td>
            <td width="70">Tipo de ciclo</td>
            <td width="30">Fecha de Inicio</td>
            <td width="30">Fecha de Fin</td>
            <td width="100">Descripcion</td>
            <td width="100">Situacion</td>
            <td width="10">Editar</td>
            <td width="10">Eliminar</td>
          </tr>
          <?php
          if(count($lista)>0){
            foreach($lista as $item => $value){
                $flgestado = $value->estado;
                $estado = $flgestado==1?"<font style='color:#009900'>Abierto</font>":"<font style='color:#ff0033'>Cerrado</font>";                
                $clase = ($item%2)==0?"list_a":"list_b";
               ?>
              <tr class="<?php echo $clase;?>">
                <td><?php echo ++$j;?></td>
                <td align="center"><?php echo $value->nombre;?></td>
                <td align="center"><?php echo $value->tipociclo;?></td>
                <td align="center"><?php echo $value->fecha_inicio;?></td>
                <td align="center"><?php echo $value->fecha_fin;?></td>
                <td align="center"><?php echo $value->descripcion;?></td>
                <td><?php echo $estado;?></td>
                <td><a href="#" onclick='editar("<?php echo $value->codigo;?>")'><img src="<?php echo img;?>editar.jpg"/></a></td>
                <td><a href="#" onclick='eliminar("<?php echo $value->codigo;?>")'><img src="<?php echo img;?>eliminar.jpg"/></a></td>
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
    <div class="mensaje"><?php echo $paginacion;?></div>
    <div class="footer"><h4><?php echo pie;?></h4></div>
</div>
    <div id="basic-modal-content"><div id="mensaje">&nbsp;</div></div>
</body>
</html>
