<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <META HTTP-EQUIV="Refresh" content="300">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="es">
    <title><?php echo titulo;?></title>
    <link rel="stylesheet" href="<?php echo css;?>estructura.css" type="text/css" />     
    <link rel="stylesheet" href="<?php echo css;?>menu.css" type="text/css" /> 
    <script type="text/javascript" src="<?php echo js;?>constants.js"></script>
    <script type="text/javascript" src="<?php echo js;?>jquery.js"></script>
    <script type="text/javascript" src="<?php echo js;?>jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo js;?>jquery.simplemodal.js"></script>
    <script type="text/javascript" src="<?php echo js;?>ventas/alumno.js"></script>
</head>
<body>
<div class="contenido" >
    <div class="header">
        <a href="#" id="logo"><img src="<?php echo img;?>logopuertosaber.jpg"/></a>
        <h2>Administrador del sistema de cursos online<br>20denota<br>2015</h2>
        <h3><a href="#" id="cerrar">Cerrar Sesi&oacute;n</a></h3>
    </div>
    <div class="zonebody patbotom">
        <ul id="nav">
            <?php foreach($menu as $item => $value):;?>
                <?php if($value->MENU_Codigo_Padre == 1):;?>
                    <li>
                        <a href="#"><?php echo $value->MENU_Descripcion;?></a>
                        <ul>
                            <?php foreach($menu as $item2 => $value2):;?>
                                <?php if($value2->MENU_Codigo_Padre == $value->MENU_Codigo):;?>
                                <li>
                                    
                                    <a href="<?php echo ($value2->MENU_Url!="#"?base_url().$value2->MENU_Url:"#");?>"><?php echo $value2->MENU_Descripcion;?></a>
                                    <?php
                                    $submenu = "";
                                    foreach ($menu as $item3 => $value3){
                                        if($value3->MENU_Codigo_Padre == $value2->MENU_Codigo){
                                            $submenu.="<li><a href='".base_url().$value3->MENU_Url."'>".$value3->MENU_Descripcion."</a></li>";
                                        }
                                    }
                                    ?>
                                    <?php if($submenu!=""):;?>
                                    <ul><?php echo $submenu;?></ul>
                                    <?php endif;?>
                                </li>
                                <?php endif;?>
                            <?php endforeach;?>
                        </ul>
                    </li>
                <?php endif;?>
            <?php endforeach;?>
        </ul>
        <div class="titulotabla">
            <input name="" type="button" class="aceptarlog2" alt="Aceptar" title="Aceptar" value="Crear un nuevo alumno" id="nuevo"/>
            <h1>Listado de alumnos</h1>
        </div>
        <div class="listartabla">
            <div class="mensajetabla">Se han encontrado (<?php echo $registros;?>) registros(s)</div>
                <table  border="1"  cellspacing="0" cellpadding="0">
                  <tr class="list1">
                    <td width="43">No</td>
                    <td width="193">Apellidos y Nombres</td>
                    <td width="86">Fecha registro</td>
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
                        <td align="left"><?php echo $value->paterno." ".$value->materno." ".$value->nombres;?></td>
                        <td align="center"><?php echo $value->fechareg;?></td>
                        <td align="center"><img src="<?php echo img.($flgestado==1?"check.jpg":"uncheck.jpg");?>" height="20px" width="20px"/><?php echo $estado;?></td>
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
            <div class="mensajetabla"><?php echo $paginacion;?></div>
        </div>
    </div>
    <div class="footer"><h4><?php echo pie;?></h4></div>
</div>
<div id="basic-modal-content"><div id="mensaje">&nbsp;</div></div>
</body>
</html>
