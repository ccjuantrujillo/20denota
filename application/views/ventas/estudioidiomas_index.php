<span class="subtitulo">Idiomas</span>
<span class="btn_agregar"><input type="button" id="editar_idiomas" class="aceptarlog3" value="+&nbsp;&nbsp;Añadir"></span>                
<span class="tab_idiomas">&nbsp;</span>                   
<span class="lst_idiomas">
    <?php
    if(count($lista->estudiosidiomas)>0){
        foreach($lista->estudiosidiomas as $indice=>$value){
            $arrSituacion = array("1"=>"Culminado","2"=>"Cursando","3"=>"Abandonado");
            $situacion = $value->ESTIDIOMC_Estado;            
            $arrfechai = explode("-",$value->ESTIDIOMC_FechaInicio);
            $arrfechaf = explode("-",$value->ESTIDIOMC_FechaFin);
            $mesi   = $arrfechai[1];
            $anioi  = $arrfechai[0];
            $mesf   = $arrfechaf[1];
            $aniof  = $arrfechaf[0];               
            ?>
            <ul>
                <li><span>&bull;<?php echo $value->IDIOMC_Descripcion;?></span></li>
                <li><span><?php echo $arrNivel[$value->ESTIDIOMC_Nivel];?></span></li>
                <li><span><?php echo $arrmes[$mesi];?>-<?php echo $anioi;?>&nbsp;-&nbsp;<?php echo $arrmes[$mesf];?>-<?php echo $aniof;?></span></li>
            </ul>
            <?php
        }
    }
    ?>
</span> 