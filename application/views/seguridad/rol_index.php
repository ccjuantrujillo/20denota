<script type="text/javascript" src="<?php echo base_url();?>js/jquery.metadata.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/seguridad/rol.js"></script>
<div id="pagina">
<div id="zonaContenido">
    <div align="center">
    <div id="tituloForm" class="header"><?php echo $titulo_busqueda;?></div>
    <div id="frmBusqueda" >
        <form id="form_busquedaRol" name="form_busquedaRol" method="post" action="<?php echo $action;?>">
            <table class="fuente8" width="98%" cellspacing=0 cellpadding="5" border=0>
                <tr>
                    <td align='left' width="13%">Nombre Rol</td>
                    <td align='left'><input id="txtNombre" name="txtNombre" type="text" class="cajaMedia" maxlength="100" value="<?php echo $txtNombre;?>"></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </table>
        </form>
    </div>
    <div id="botonBusqueda">
        <ul id="imprimirRol" class="lista_botones"><li id="imprimir">Imprimir</li></ul>
        <ul id="nuevoRol" class="lista_botones"><li id="nuevo">Nuevo Rol</li></ul>
        <ul id="limpiarRol" class="lista_botones"><li id="limpiar">Limpiar</li></ul>
        <ul id="buscarRol" class="lista_botones"><li id="buscar">Buscar</li></ul>
    </div>
    <div id="lineaResultado">
      <table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0>
            <tr>
                <td width="50%" align="left">N de roles encontrados:&nbsp;<?php echo $registros;?> </td>
                <td width="50%" align="right">&nbsp;</td>
            </tr>
      </table>
    </div>
    <div id="cabeceraResultado" class="header"><?php echo $titulo_tabla;;?></div>
    <div id="frmResultado">
        <table class="fuente8" width="100%" cellspacing="0" cellpadding="3" border="0" ID="Table1">
            <tr class="cabeceraTabla">
                <td width="5%">ITEM</td>
                <td width="70%">DESCRIPCION</td>
                <td width="5%">&nbsp;</td>
                <td width="5%">&nbsp;</td>
                <td width="5%">&nbsp;</td>
            </tr>
            <?php
            if(count($lista)>0){
                foreach($lista as $indice=>$valor){
                    $class = $indice%2==0?'itemParTabla':'itemImparTabla';
                    ?>
                    <tr class="<?php echo $class;?>">
                        <td><div align="center"><?php echo $valor[0];?></div></td>
                        <td><div align="left"><?php echo $valor[1];?></div></td>
                        <td><div align="center"><?php echo $valor[2];?></div></td>
                        <td><div align="center"><?php echo $valor[3];?></div></td>
                        <td><div align="center"><?php echo $valor[4];?></div></td>
                    </tr>
                    <?php
                }
            }
            else{
            ?>
            <table width="100%" cellspacing="0" cellpadding="3" border="0" class="fuente8">
                <tbody>
                    <tr>
                        <td width="100%" class="mensaje">No hay ning&uacute;n registro que cumpla con los criterios de b&uacute;squeda</td>
                    </tr>
                </tbody>
            </table>
            <?php
            }
            ?>
        </table>
    </div>
    <div style="margin-top: 15px;"><?php echo $paginacion;?></div>
    <input type="hidden" id="iniciopagina" name="iniciopagina">
    <input type="hidden" id="cadena_busqueda" name="cadena_busqueda">
    <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url();?>">
</div>
</div>
</div>