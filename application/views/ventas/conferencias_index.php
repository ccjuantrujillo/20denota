<span class="subtitulo">Conferencias</span>
<span class="btn_agregar">
     <?php 
    if($lista->profesor!=""){
        ?>
        <input type="button" id="nueva_conferencia" class="aceptarlog3" value="+&nbsp;&nbsp;Añadir">
        <?php
    }
    ?>     
</span>                
<span class="tab_conferencias">&nbsp;</span> 
<span class="lst_conferencias">
    <?php
    if(count($lista->conferencias)>0){
        foreach($lista->conferencias as $indice=>$value){
            ?>
            <ul id="<?php echo $value->CONFERP_Codigo;?>">
                <li><span>&bull;<?php echo $value->CONFERC_Nombre;?></span>&nbsp;<span class="editar_conferencia"><img src="<?php echo img;?>/orar.gif"></span>&nbsp;<span class="eliminar_conferencia"><img src="<?php echo img;?>/eliminar.gif"></span></li>
                <li><span><?php echo $value->CONFERC_Descripcion;?></span></li>
                <li><span><?php echo date_sql($value->CONFERC_Fecha);?></span></li>
            </ul>
            <?php
        }
    }
    ?>
</span>