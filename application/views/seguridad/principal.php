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
    <script type="text/javascript" src="<?php echo js;?>constants.js"></script>
    <script type="text/javascript" src="<?php echo js;?>inicio.js"></script>	   
</head>
<body>
<div class="contenido" > 
    <div class="header"><?php echo $header;?></div>
    <div class="menu"><ul id="nav"><?php echo $menu;?></ul></div>
    <div class="tabla"  style="width:90%;height: 600px;">
        <div id="tab-acceso">
            <table>
                <tr>
                    <td width="130px;">HORA</td>
                    <td>PERSONA</td>
                </tr>
                <?php
                if(count($accesos)>0){
                    foreach($accesos as $item => $value){
                        $arrFecha = explode(" ",$value->ACCESOC_Fecha);
                        $fecha = $arrFecha[0];
                        $hora  = $arrFecha[1];
                        ?>
                        <tr>
                            <td><?php echo $fecha."&nbsp;&nbsp;".$hora;?></td>
                            <td><?php echo $value->PERSC_Nombre." ".$value->PERSC_ApellidoPaterno;?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
        </div>
    </div>
    <div class="footer"><h4><?php echo pie;?></h4></div>
</div>
</body>
</html>