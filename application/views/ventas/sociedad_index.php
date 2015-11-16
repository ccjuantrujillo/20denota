<span class="subtitulo">Sociedades Cientificas</span>
<span class="btn_agregar"><input type="button" id="editar_sociedad" class="aceptarlog3" value="+&nbsp;&nbsp;Añadir"></span>                                
<span class="tab_sociedad">&nbsp;</span>                 
<span class="lst_sociedades">
    <?php
    if(count($lista->sociedades)>0){
        foreach($lista->sociedades as $indice=>$value){
            ?>
           <h2>&bull;<?php echo $value->SOCIEDC_Descripcion;?>(<?php echo $value->SOCIEDC_Nombre;?>)</h2>
           <h3><?php echo date_sql($value->PROFSOCC_FechaSuscripcion);?></h3>
            <?php
        }
    }
    ?>
</span> 