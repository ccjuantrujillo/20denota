<span class="subtitulo">Empresa</span>
<span class="btn_agregar">
     <?php 
    if($lista->profesor!=""){
        ?>
        <input type="button" id="nuevo_trabajo" class="aceptarlog3" value="+&nbsp;&nbsp;Añadir">
        <?php
    }
    ?>        
</span>                
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
            <ul id="<?php echo $value->TRABAJP_Codigo;?>">
                <li><span>&bull;<?php echo $value->TRABAJC_Descripcion;?></span>&nbsp;<span class="editar_trabajo"><img src="<?php echo img;?>/orar.gif"></span>&nbsp;<span class="eliminar_trabajo"><img src="<?php echo img;?>/eliminar.gif"></span></li>
                <li><span><?php echo $value->EMPRC_RazonSocial;?></span></li>
                <li><span><?php echo $arrmes[$mesi];?>-<?php echo $anioi;?>&nbsp;-&nbsp;<?php echo $arrmes[$mesf];?>-<?php echo $aniof;?></span></li>                
            </ul>
            <?php
        }
    }
    ?>
</span>  