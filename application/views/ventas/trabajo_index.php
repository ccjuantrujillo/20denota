<span class="subtitulo">Empresa</span>
<span class="btn_agregar"><input type="button" id="editar_empresa" class="aceptarlog3" value="+&nbsp;&nbsp;Añadir"></span>                
<span class="tab_empresa">&nbsp;</span>                 
<span class="lst_empresa">
    <?php
    if(count($lista->trabajos)>0){
        foreach($lista->trabajos as $indice=>$value){
            $arrfechai = explode("-",$value->TRABAJC_FechaInicio);
            $arrfechaf = explode("-",$value->TRABAJC_FechaFin);
            $mesi   = $arrfechai[1];
            $anioi  = $arrfechai[0];
            $mesf   = $arrfechaf[1];
            $aniof  = $arrfechaf[0];             
            ?>
           <h2><?php echo $value->TRABAJC_Descripcion;?></h2>
           <h3><?php echo $value->EMPRC_RazonSocial;?></h3>
           <h3><?php echo $arrmes[$mesi];?>-<?php echo $anioi;?>&nbsp;-&nbsp;<?php echo $arrmes[$mesf];?>-<?php echo $aniof;?></h3>
            <?php
        }
    }
    ?>
</span>  