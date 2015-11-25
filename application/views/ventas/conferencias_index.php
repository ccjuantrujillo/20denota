<span class="subtitulo">Conferencias</span>
<span class="btn_agregar">
     <?php 
    if($lista->profesor!=""){
        ?>
        <input type="button" id="editar_conferencia" class="aceptarlog3" value="+&nbsp;&nbsp;Añadir">
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
           <h2>&bull;<?php echo $value->CONFERC_Nombre;?></h2>
           <h3><?php echo $value->CONFERC_Descripcion;?></h3>
           <h3><?php echo date_sql($value->CONFERC_Fecha);?></h3>
            <?php
        }
    }
    ?>
</span>