<script type="text/javascript" src="<?php echo base_url();?>js/jquery.metadata.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.validate.js"></script>	
<script type="text/javascript" src="<?php echo base_url();?>js/seguridad/rol.js"></script>
<?php
$nombre_persona = $this->session->userdata('nombre_persona');
$persona        = $this->session->userdata('persona');
$usuario        = $this->session->userdata('usuario');
$url            = base_url()."index.php";
if(empty($persona)) header("location:$url");
$CI = get_instance();
$this->load->model('seguridad/rol_model');
$menus_base=$CI->rol_model->obtener_rol_permiso();

?>
<div id="pagina">
    <div id="zonaContenido">
        <div align="center">
            <div id="tituloForm" class="header"><?php echo $titulo;?></div>
            <div id="frmBusqueda">
                <?php echo validation_errors("<div class='error'>",'</div>');?>
                <form id="<?php echo $formulario;?>" method="post" action="<?php echo base_url();?>index.php/seguridad/rol/grabar">
                    <div id="datosGenerales">
                        <table class="fuente8" width="98%" cellspacing=0 cellpadding="6" border="0">
                            <?php
                            foreach($campos as $indice=>$valor){
                            ?>
                               <tr>
                                  <td ><?php echo $campos[$indice];?>&nbsp;&nbsp;<?php echo $valores[$indice]?></td>
                                  <td ></td>
                                </tr>
                                <tr>
                                   <td >
                             <table>
         <?php
         foreach($menus_base as $menu_base){      
              
                   $enlaces = $menu_base->submenus;
                    ?>
                    <tr><td ><?php
                     $menu=$menu_base->MENU_Codigo;
                     if(isset($codigo)){
                          $ROL_menu=$this->permiso_model->busca_permiso($codigo, $menu);
                        if(count($ROL_menu)>0) {
                             echo $text = ($menu_base->MENU_Url!='')?'<input type="checkbox" checked="true" name="nombre" id="nombre"><strong>'.$menu_base->MENU_Descripcion : '</strong><input type="checkbox" checked="true" name="nombre" id="nombre"><strong>'.$menu_base->MENU_Descripcion.'</strong>';
                         }else{
                             echo $text = ($menu_base->MENU_Url!='')?'<input type="checkbox"  name="nombre" id="nombre"><strong>'.$menu_base->MENU_Descripcion : '</strong><input type="checkbox" name="nombre" id="nombre"><strong>'.$menu_base->MENU_Descripcion.'</strong>';
                         }
                     }else{
                          echo $text = ($menu_base->MENU_Url!='')?'<input type="checkbox"  name="nombre" id="nombre"><strong>'.$menu_base->MENU_Descripcion : '</strong><input type="checkbox" name="nombre" id="nombre"><strong>'.$menu_base->MENU_Descripcion.'</strong>';
                     }
                    ?>
                    <?php
                    if(count($enlaces)){
                        ?>
                       <table>
                        <?php
                        foreach($enlaces as $enlace){
                            $subtext='';
                            $subtext2='';
                            $checked='';
                            $subtext=$enlace->MENU_Descripcion;
                            $subtext2=$enlace->MENU_Codigo;
              if(isset($codigo)){
               $menu=$menu_base->MENU_Codigo;
               $ROL_Codigo=$this->permiso_model->busca_permiso($codigo, $subtext2);
                     if(count($ROL_Codigo)>0){
                     echo '<tr><td width="300">&nbsp;&nbsp;&nbsp;<input type="checkbox"   checked="true"  value ="'.$subtext2.'" name="checkO['.$subtext2.']" id="checkO['.$subtext2.']">'.$subtext.'</tr></td>';
                        }
                     else{
                        echo '<tr><td width="300">&nbsp;&nbsp;&nbsp;<input type="checkbox"    value ="'.$subtext2.'" name="checkO['.$subtext2.']" id="checkO['.$subtext2.']">'.$subtext.'</tr></td>';
                        }
                    }else{                        
                        echo '<tr><td width="300">&nbsp;&nbsp;&nbsp;<input type="checkbox"    value ="'.$subtext2.'" name="checkO['.$subtext2.']" id="checkO['.$subtext2.']">'.$subtext.'</tr></td>';
                        }
                    }
                  ?>
                </table>
                   <?php
                       }
                    ?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
           </td>
             </tr>
           <?php
                 }
             ?>
             </table>
                    </div>
                    <div style="margin-top:20px; text-align: center">
                        <a href="#" id="grabarRol"><img src="<?php echo base_url();?>images/botonaceptar.jpg" width="85" height="22" class="imgBoton" ></a>
                        <a href="#" id="limpiarRol"><img src="<?php echo base_url();?>images/botonlimpiar.jpg" width="69" height="22" class="imgBoton" ></a>
                        <a href="#" id="cancelarRol"><img src="<?php echo base_url();?>images/botoncancelar.jpg" width="85" height="22" class="imgBoton"></a>
                        <?php echo $oculto?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>