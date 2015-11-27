<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>  
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />   
    <meta http-equiv="Content-Language" content="es"> 
    <title><?php echo titulo;?></title>          
    <link rel="stylesheet" href="<?php echo css;?>estructura.css" type="text/css" />     
    <link rel="stylesheet" href="<?php echo css;?>menu.css" type="text/css" />    
    <link rel="stylesheet" href="<?php echo css;?>jquery-ui.css" type="text/css" />        
    <script type="text/javascript" src="<?php echo js;?>jquery.js"></script>   
    <script type="text/javascript" src="<?php echo js;?>jquery-ui.min.js"></script>    
    <script type="text/javascript" src="<?php echo js;?>jquery.simplemodal.js"></script>     
    <script type="text/javascript" src="<?php echo js;?>constants.js"></script>     
    <script type="text/javascript" src="<?php echo js;?>ventas/tarea.js"></script>	
</head>
<body>
<div class="contenido" > 
    <div class="header"><?php echo $header;?></div>
    <div class="menu"><ul id="nav"><?php echo $menu;?></ul></div>
    <div class="titulo">
        <h1><?php echo $titulo;?></h1>
	<div>
            <?php echo $form_open;?>
                <div>
                    <label>Curso:</label>
                    <?php echo $selcurso;?>
                    <label>Curso:</label>
                    <?php echo $selprofesor;?>
                    <label>Desde:</label>
                    <input  name="desde" id="desde" title="Fecha Inicio" value="<?php echo $desde;?>" type="text" class="cajaMinima" readonly="readonly">									
                    <label>Hasta:</label>
                    <input  name="hasta" id="hasta" title="Fecha Fin" value="<?php echo $hasta;?>" type="text" class="cajaMinima" readonly="readonly">									
                </div>
            <?php echo $form_close;?>
	</div>         
	<div class="case_botones">       
            <ul class="lista_botones"><li id="pdf">Ver Pdf</li></ul>
	</div> 	          
    </div>         
    <iframe width="100%" height="500" id="framereporte" name="framereporte" frameborder="1"></iframe>
    <div id="reporte"></div>
    </div>
</body>
</html>