<span class="subtitulo">Experiencia:</span>
<span class="btn_agregar"><input type="button" id="editar_experiencia" class="aceptarlog3" value="+&nbsp;&nbsp;Añadir"></span>                
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
           <h2>&bull;<?php echo $value->EXPERPC_Cargo;?>, <?php echo $value->EXPERPC_Curso;?></h2>
           <h3><?php echo $value->UNIVC_Nombre;?></h3>
           <h3><?php echo $arrmes[$mesi];?>-<?php echo $anioi;?>&nbsp;-&nbsp;<?php echo $arrmes[$mesf];?>-<?php echo $aniof;?></h3>
            <?php
        }
    }
    ?>
</span> 