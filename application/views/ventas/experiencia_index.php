<span class="subtitulo">Experiencia:</span>
<span class="btn_agregar">
    <?php 
    if($lista->profesor!=""){
        ?>
        <input type="button" id="nueva_experiencia" class="aceptarlog3" value="+&nbsp;&nbsp;Añadir">      
        <?php
    }
    ?>
</span>                
<span class="tab_experiencia">&nbsp;</span>  
<span class="lst_esperiencia">
    <?php
    if(count($lista->experiencia)>0){
        foreach($lista->experiencia as $indice=>$value){
            $arrfechai = explode("-",$value->EXPERPC_FechaInicio);
            $arrfechaf = explode("-",$value->EXPERPC_FechaFin);
            $mesi   = $arrfechai[1];
            $anioi  = $arrfechai[0];
            $mesf   = $arrfechaf[1];
            $aniof  = $arrfechaf[0];            
            ?>
            <ul style="width: 100%;" id="<?php echo $value->EXPERP_Codigo;?>">
                <li><span>&bull;<?php echo $value->EXPERPC_Cargo;?>, <?php echo $value->EXPERPC_Curso;?></span>&nbsp;<span class="editar_experiencia"><img src="<?php echo img;?>/orar.gif"></span>&nbsp;<span class="eliminar_experiencia"><img src="<?php echo img;?>/eliminar.gif"></span></li>
                <li><span><?php echo $value->UNIVC_Nombre;?></span></li>
                <li><span><?php echo $arrmes[$mesi];?>-<?php echo $anioi;?>&nbsp;-&nbsp;<?php echo $arrmes[$mesf];?>-<?php echo $aniof;?></span></li>
            </ul>
            <?php
        }
    }
    ?>
</span> 