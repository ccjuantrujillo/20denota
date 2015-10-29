<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>  
    <META HTTP-EQUIV="Refresh" content="300"> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />   
    <meta http-equiv="Content-Language" content="es"> 
    <title><?php echo titulo;?></title>          
    <link href="<?php echo css;?>estructura.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?php echo js;?>jquery.js"></script>      
    <script type="text/javascript" src="<?php echo js;?>constants.js"></script>     
    <script type="text/javascript" src="<?php echo js;?>maestros/persona.js"></script>    
</head>
<body>
<div class="wrapper" > 
    <div class="header"><?php echo $header;?></div>
    <div class="zonebody_esika patbotom">
        <ul class="nav">
            <?php foreach($menu as $item => $value):;?>
            	<li><a href="<?php echo base_url().$value->MENU_Url;?>"><?php echo $value->MENU_Descripcion;?></a></li>
            <?php endforeach;?>
        </ul>
        <div class="crearbanner">
            <input name="" type="button" class="aceptarlog2" alt="Aceptar" title="Aceptar" value="Crear un nuevo alumno" id="nuevo"/>
            <h1>Listado de alumnos</h1>
        </div>
        <div class="containertable">
            <div class="mensajetable">Se han encontrado (<?php echo $registros;?>) registros(s)</div>
                <table  border="1"  cellspacing="0" cellpadding="0">
                  <tr class="list1">
                    <td width="43">No</td>
                    <td width="193"><a href="#">Apellidos y Nombres</a></td>
                    <td width="86"><a href="#">Fecha registro</a></td>
                    <td width="63">Estado</td>
                    <td width="62">Editar</td>
                    <td width="77">Eliminar</td>
                  </tr>
                  <?php
                  if(count($lista)>0){
                    foreach($lista as $item => $value){
                        $flgestado = $value->estado;
                        $estado = $flgestado==1?"Activo":"Inactivo";
                        $clase = ($item%2)==0?"list_a":"list_b";
                       ?>
                      <tr class="<?php echo $clase;?>">
                        <td><?php echo ++$j;?></td>
                        <td align="left"><?php echo $value->nombres." ".$value->paterno." ".$value->materno;?></td>
                        <td align="center"><?php echo $value->fechareg;?></td>
                        <td align="center"><img src="<?php echo img;?>check.jpg"/><?php echo $estado;?></td>
                        <td><a href="#" onclick='editar("<?php echo $value->codigo;?>")'><img src="<?php echo img;?>editar.jpg"/></a></td>
                        <td><a href="#" onclick='eliminar("<?php echo $value->codigo;?>")'><img src="<?php echo img;?>eliminar.jpg"/></a></td>
                      </tr>  
                       <?php 
                    }
                  }
                  else{
                      ?>
                        <tr class="list_a" colspan='5'>::NO EXISTEN REGISTROS::</tr>
                      <?php
                  }
                  ?>
                </table>
            <div class="mensajetable2 "><?php echo $paginacion;?></div>
        </div>
    </div>
    <div class="footer"><h4><?php echo pie;?></h4></div>
</div>
</body>
</html>
