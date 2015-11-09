<span class="subtitulo">Experiencia:</span>
<span class="btn_agregar"><input type="button" id="editar_experiencia" class="aceptarlog3" value="+&nbsp;&nbsp;Añadir"></span>                
<span class="tab_experiencia">&nbsp;</span>  
<span class="lst_esperiencia">
    <?php
    if(count($lista->experiencia)>0){
        foreach($lista->experiencia as $indice=>$value){
            ?>
           <h2>&bull;<?php echo $value->EXPERPC_Cargo;?></h2>
           <h3><?php echo $value->EXPERPC_Empresa;?>,&nbsp;<?php echo $value->EXPERPC_Empresa;?></h3>
           <h3><?php echo $arrmes[0];?>-<?php echo 1;?>&nbsp;-&nbsp;<?php echo $arrmes[0];?>-<?php echo 1;?></h3>
            <?php
        }
    }
    ?>
</span> 