<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>  
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />   
    <meta http-equiv="Content-Language" content="es"> 
    <title><?php echo titulo;?></title>          
    <link rel="stylesheet" href="<?php echo css;?>estructura.css" type="text/css" />     
    <link rel="stylesheet" href="<?php echo css;?>menu.css" type="text/css" />   
    <link href="<?php echo css;?>jquery-ui.css" rel="stylesheet" type="text/css" />       
    <script type="text/javascript" src="<?php echo js;?>jquery.js"></script>   
    <script type="text/javascript" src="<?php echo js;?>jquery-ui.min.js"></script>    
    <script type="text/javascript" src="<?php echo js;?>jquery.simplemodal.js"></script>  
    <script type="text/javascript" src="<?php echo js;?>constants.js"></script>     
    <script type="text/javascript" src="<?php echo js;?>ventas/tareo.js"></script>	
</head>
<body>
<div class="contenido" > 
    <div class="header">
        <a href="#" id="logo"><img src="<?php echo img;?>logopuertosaber.jpg"/></a>
        <h2>Administrador del sistema de cursos online<br>Puerto Saber S.A.C.<br>2014</h2>
        <h3><a href="#" id="cerrar">Cerrar Sesi&oacute;n</a></h3>
    </div>
    <div class="menu"><ul id="nav"><?php echo $menu;?></ul></div>
        <?php echo $form_open;?>
            <div class="titulotabla">      
                <h1><?php echo $titulo;?></h1>
                <div style="float:left;">
                    Local:<?php echo $sellocal;?>&nbsp;&nbsp;
                    Aula:<?php echo $selaula;?>&nbsp;&nbsp;
                    <a href='#' id='agregar'>Agregar</a>
                </div>
                <div style="float:right;margin-right:5%;">
                    Fecha: <input type="text" maxlength="10" class="cajaMinima" value="<?php echo $lista->fecha;?>" readonly="" style="width:60px" id="fecha" name="fecha"></input>
                </div>
            </div>
            <div class="tabla">
                <table border="1" width="100%" id='tabla_detalle'>
                    <tr class="list1">
                      <td width="43">No</td>
                      <td width="300">Profesor</td>
                      <td width="200">H.Inicio</td>
                      <td width="200">H.Fin</td>
                      <td width="100">Tipo</td>
                      <td width="300">Reemplazado por:</td>                    
                      <td width="77">Acciones</td>
                    </tr>
                    <?php
                    if(count($lista->fila)>0){
                      foreach($lista->fila as $item => $value){
                          $clase = ($item%2)==0?"list_a":"list_b";
                         ?>
                        <tr class="<?php echo $clase;?>" id="<?php echo $value->codigo;?>">
                          <td><?php echo ++$item;?></td>
                          <td align="left"><?php echo $value->paterno." ".$value->materno." ".$value->nombres;?></td>
                          <td align="center"><?php echo $value->hinicio;?></td>
                          <td align="center"><?php echo $value->hfin;?></td>
                          <td align="center"><?php echo $value->tipo;?></td>
                          <td align="center"><?php echo $value->paterno_reemp." ".$value->materno_reemp." ".$value->nombres_reemp;?></td>
                          <td>
                              <a href="#" id="editardetalle"><img src="<?php echo img;?>editar.jpg"/></a>&nbsp;
                              <a href="#" id="eliminardetalle"><img src="<?php echo img;?>eliminar.jpg"/></a>
                          </td>
                        </tr>  
                         <?php 
                      }
                    }
                    else{
                        ?>
<!--                      <tr class="list_a"><td colspan='8'>::NO EXISTEN REGISTROS::</td></tr>-->
                        <?php
                    }
                    ?>
                </table>
            </div>
        <?php echo $form_close;?>              
    <div class="frmboton">
    <div class="frmboton_login" style="margin-bottom:25px;">
<!--                <input id="cancelar" class="botones" type="button" alt="Cancelar" title="Cancelar" value="Cancelar"/>-->
        <input id="grabar" class="botones" type="button" alt="Grabar" title="Aceptar" value="Grabar"/>
    </div>
    </div>      
    <div class="footer"><h4><?php echo pie;?></h4></div>
</div>
 <div id="basic-modal-content"><div id="mensaje">&nbsp;</div></div>  
</body>
</html>
