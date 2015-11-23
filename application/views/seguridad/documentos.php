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
<!--    <div class="zonebody">-->
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
<!--    </div>-->
    <div class="footer"><h4><?php echo pie;?></h4></div>
</div>
</body>
</html>
