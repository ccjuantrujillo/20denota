<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>  
    <META HTTP-EQUIV="Refresh" content="300"> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />   
    <meta http-equiv="Content-Language" content="es"> 
    <title><?php echo titulo;?></title>          
    <link rel="stylesheet" href="<?php echo css;?>estructura.css" type="text/css" />     
    <link rel="stylesheet" href="<?php echo css;?>menu.css" type="text/css" />   
    <link href="<?php echo css;?>jquery-ui.css" rel="stylesheet" type="text/css" />       
    <script type="text/javascript" src="<?php echo js;?>constants.js"></script> 
    <script type="text/javascript" src="<?php echo js;?>jquery.js"></script>   
    <script type="text/javascript" src="<?php echo js;?>jquery-ui.min.js"></script>    
    <script type="text/javascript" src="<?php echo js;?>jquery.simplemodal.js"></script>     
    <script type="text/javascript" src="<?php echo js;?>ventas/tareo.js"></script>	
</head>
<body>
<div class="contenido" > 
    <div class="header">
        <a href="#" id="logo"><img src="<?php echo img;?>logopuertosaber.jpg"/></a>
        <h2>Administrador del sistema de cursos online<br>Puerto Saber S.A.C.<br>2014</h2>
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
        <?php echo $form_open;?>
            <div class="titulotabla">      
                <h1><?php echo $titulo;?></h1>
                <div style="float:left;">
                    Local:<?php echo $sellocal;?>&nbsp;&nbsp;
                    Aula:<?php echo $selaula;?>&nbsp;&nbsp;
                </div>
                <div style="float:right;margin-right:5%;">
                    Fecha: <input type="text" maxlength="10" class="cajaMinima" value="<?php echo $lista->fecha;?>" readonly="" style="width:60px" id="fecha" name="fecha"></input>
                </div>
            </div>
            <div class="listartabla" style="height: 400px;">
                <table  border="1"  cellspacing="0" cellpadding="0" style="width:1000px;">
                      <tr class="list1">
                        <td width="43">No</td>
                        <td width="300">Profesor</td>
                        <td width="200">H.Inicio</td>
                        <td width="200">H.Fin</td>
                        <td width="100">Tipo</td>
                        <td width="300">Reemplazado por:</td>                    
                        <td width="77">Eliminar</td>
                      </tr>
                      <?php
                      if(count($lista->fila)>0){
                        foreach($lista->fila as $item => $value){
                            $clase = ($item%2)==0?"list_a":"list_b";
                           ?>
                          <tr class="<?php echo $clase;?>" id="<?php echo $value->codigo;?>">
                            <td><?php echo ++$item;?></td>
                            <td align="center"><?php echo $value->profesor;?><input type="hidden" name="codigo[]" id="codigo[]" value="<?php echo $value->codigo;?>"></td>
                            <td align="center"><input id="hinicio[]" type='time' maxlength="5" name="hinicio[]" value="<?php echo $value->hinicio;?>"  class="cajaReducida" onblur="valida(this.value,this);" ></td>
                            <td align="center"><input id="hfin[]" type='time' maxlength="5" name="hfin[]" value="<?php echo $value->hfin;?>"  class="cajaReducida" onblur="valida(this.value,this);" ></td>
                            <td align="center"><?php echo $value->tipo;?></td>
                            <td align="center"><?php echo $value->reemplazo;?></td>
                            <td><a href="#" class="eliminar"><img src="<?php echo img;?>eliminar.jpg"/></a></td>
                          </tr>  
                           <?php 
                        }
                      }
                      else{
                          ?>
                        <tr class="list_a"><td colspan='8'>::NO EXISTEN REGISTROS::</td></tr>
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
    </div>
    <div class="footer"><h4><?php echo pie;?></h4></div>
</div>
 <div id="basic-modal-content"><div id="mensaje">&nbsp;</div></div>  
</body>
</html>
