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
    <script type="text/javascript" src="<?php echo js;?>inicio.js"></script>	   
</head>
<body>
<div class="contenido" > 
    <div class="header">
        <a href="#" id="logo"><img src="<?php echo img;?>logopuertosaber.jpg"/></a>
        <h2>Administrador del sistema de cursos online<br>20denota<br>2015</h2>
        <h3><a href="#" id="cerrar">Cerrar Sesi&oacute;n</a></h3>
    </div>
    <div class="zonebody">
        <ul class="nav">
            <?php foreach($menu as $item => $value):;?>
                <?php if($value->MENU_Codigo_Padre == 1):;?>
                    <li>
                        <a href="#"><?php echo $value->MENU_Descripcion;?></a>
                        <ul>
                            <?php foreach($menu as $item2 => $value2):;?>
                                <?php if($value2->MENU_Codigo_Padre == $value->MENU_Codigo):;?>
                                <li><a href="<?php echo base_url().$value2->MENU_Url;?>"><?php echo $value2->MENU_Descripcion;?></a></li>
                                <?php endif;?>
                            <?php endforeach;?> 
                        </ul>
                    </li>  
                <?php endif;?>
            <?php endforeach;?> 
        </ul>
        <ul class="body_section">
            <li>                 
                <span class="caja_contenidos">
                 <img src="<?php echo img;?>libros.jpg"/>
                    <span class="cajatitle">
                        <h2>  LECCIONES</h2>
                        <h3>quí se podrán subir las imágenes tipo preview para el menú que contenga un e</h3>
                        <a href="<?php echo base_url();?>index.php/almacen/producto/listar">Ingresar</a> 
                    </span>
                 </span>
            </li>
            <li>                 
                <span class="caja_contenidos">
                 <img src="<?php echo img;?>archivo.jpg"/>
                    <span class="cajatitle">
                        <h2>ARCHIVOS</h2>
                        <h3>quí se podrán subir las imágenes tipo preview para el menú que contenga un e</h3>
                        <a href="<?php echo base_url();?>index.php/almacen/producto/listar">Ingresar</a> 
                    </span>
                 </span>
            </li>  
            <li>                 
                <span class="caja_contenidos">
                 <img src="<?php echo img;?>video.jpg"/>
                    <span class="cajatitle">
                        <h2>VIDEOS</h2>
                        <h3>quí se podrán subir las imágenes tipo preview para el menú que contenga un e</h3>
                        <a href="<?php echo base_url();?>index.php/almacen/productoatributo/listar">Ingresar</a> 
                    </span>
                 </span>
            </li>   
            <li>                 
                <span class="caja_contenidos">
                 <img src="<?php echo img;?>pregunta.jpg"/>
                    <span class="cajatitle">
                        <h2>PREGUNTAS</h2>
                        <h3>quí se podrán subir las imágenes tipo preview para el menú que contenga un e</h3>
                        <a href="<?php echo base_url();?>index.php/almacen/productoatributodetalle/listar">Ingresar</a> 
                    </span>
                 </span>
            </li>             
            <li>                 
                <span class="caja_contenidos">
                 <img src="<?php echo img;?>mundo.jpg"/>
                    <span class="cajatitle">
                        <h2>ENLACES</h2>
                        <h3>quí se podrán subir las imágenes tipo preview para el menú que contenga un e</h3>
                        <a href="<?php echo base_url();?>index.php/almacen/producto/listar">Ingresar</a> 
                    </span>
                 </span>
            </li>
            <li>
                <span class="caja_contenidos">
                 <img src="<?php echo img;?>mundo.jpg"/>
                    <span class="cajatitle">
                        <h2>CURSO</h2>
                        <h3>quí se podrán subir las imágenes tipo preview para el menú que contenga un e</h3>
                        <a href="<?php echo base_url();?>index.php/almacen/curso/listar">Ingresar</a>
                    </span>
                 </span>
            </li>
        </ul>
    </div>
    <div class="footer"><h4><?php echo pie;?></h4></div>
</div>
</body>
</html>
