<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <META HTTP-EQUIV="Refresh" content="300"> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="es"> 
    <title><?php echo titulo;?></title>        
    <link href="<?php echo css;?>estructura.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?php echo js;?>constants.js"></script> 
    <script type="text/javascript" src="<?php echo js;?>jquery.js"></script>
    <script type="text/javascript" src="<?php echo js;?>maestros/persona.js"></script>	    
</head>
<body>
<div class="wrapper" > 
    <div class="headerlogo">
        <img src="<?php echo img;?>logopuertosaber.jpg"/>
        <h2>Administrador del sistema de cursos online<br>Puerto Saber S.A.C.<br>2014</h2>
        <h3><a href="#" id="cerrar">Cerrar Sesi&oacute;n</a></h3>
    </div>
    <div class="zonebody_esika ">
        <ul class="nav">
            <?php foreach($menu as $item => $value):;?>
            	<li><a href="<?php echo base_url().$value->MENU_Url;?>"><?php echo $value->MENU_Descripcion;?></a></li>
            <?php endforeach;?>
       </ul>
       <div class="crearbanner">
           <h1>Modificar</h1>
       </div>
        <div class="containertable2 ">
            <div class="container_bg patbotom">
                <?php echo $form_open;?>
                    <table   cellspacing="0" cellpadding="0">
                      <tr>
                        <td>Codigo:</td>
                        <td colspan="2" class="formss"><input name="codigo" id="codigo" type="text" value="<?php echo $lista->codigo;?>"/></td>
                      </tr>
                      <tr>
                        <td>D.N.I.:</td>
                        <td colspan="2" class="formss"><input name="numero" id="numero" type="text" value="<?php echo $lista->numerodoc;?>"/></td>
                      </tr>
                      <tr>
                        <td>A.Paterno:</td>
                        <td colspan="2" class="formss"><input name="paterno" id="paterno" type="text" value="<?php echo $lista->paterno;?>"/></td>
                      </tr>
                      <tr>
                        <td>A.Materno:</td>
                        <td colspan="2" class="formss"><input name="materno" id="materno" type="text" value="<?php echo $lista->materno;?>"/></td>
                      </tr>
                      <tr>
                        <td>Nombres:</td>
                        <td colspan="2" class="formss"><input name="nombres" id="nombres" type="text" value="<?php echo $lista->nombres;?>"/></td>
                      </tr>   
                      <tr>
                        <td>Email:</td>
                        <td colspan="2" class="formss"><input name="email" id="email" type="text" value="<?php echo $lista->email;?>"/></td>
                      </tr>  
                      <tr>
                        <td>Telefono:</td>
                        <td colspan="2" class="formss"><input name="telefono" id="telefono" type="text" value="<?php echo $lista->telefono;?>"/></td>
                      </tr>  
                      <tr>
                        <td>F.Nacimiento:</td>
                        <td colspan="2" class="formss"><input name="fnacimiento" id="fnacimiento" type="text" value="<?php echo $lista->fnac;?>"/></td>
                      </tr>                          
                      <tr>
                        <td>&nbsp;</td>
                        <td><input id="cancelar" name="" type="button" value="cancelar" alt="Limpiar" title="Limpiar" class="limpiaresika3" /></td>
                        <td><input id="grabar" name="" type="button" class="aceptarlog3" alt="Aceptar" title="Aceptar" value="Aceptar" /></td>
                      </tr>
                    </table>
                    <?php echo $oculto;?>
                    <?php echo $form_close;?>
                 </div>
        </div>
    </div>
    <div class="footer"><h4><?php echo pie;?></h4></div>
</div>
</body>
</html>
