<span class="subtitulo">Sociedades Cientificas</span>
<span class="btn_agregar">
     <?php 
    if($lista->profesor!=""){
        ?>
        <input type="button" id="nueva_sociedad" class="aceptarlog3" value="+&nbsp;&nbsp;Añadir">
        <?php
    }
    ?>       
</span>                                
<span class="tab_sociedad">&nbsp;</span>                 
<span class="lst_sociedades">
    <?php
    if(count($lista->sociedades)>0){
        foreach($lista->sociedades as $indice=>$value){
            ?>
            <ul id="<?php echo $value->PROFSOCP_Codigo;?>">
                <li><span>&bull;<?php echo $value->SOCIEDC_Descripcion;?>(<?php echo $value->SOCIEDC_Nombre;?>)</span>&nbsp;<span class="editar_sociedad"><img src="<?php echo img;?>/orar.gif"></span>&nbsp;<span class="eliminar_sociedad"><img src="<?php echo img;?>/eliminar.gif"></span></li>
                <li><span><?php echo date_sql($value->PROFSOCC_FechaSuscripcion);?></span></li>                
            </ul>
            <?php
        }
    }
    ?>
</span> 