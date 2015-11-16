<span class="subtitulo">Estudio:</span>
 <span class="btn_agregar"><input type="button" id="editar_estudios" class="aceptarlog3" value="+&nbsp;&nbsp;Añadir"></span>
 <span class="tab_estudios">&nbsp;</span> 
 <span class="lst_estudios">
   <?php
   if(count($lista->estudios)>0){
       foreach($lista->estudios as $indice=>$value){
            $arrSituacion = array("1"=>"Culminado","2"=>"Cursando","3"=>"Abandonado");
            $situacion = $value->ESTUDIOC_Estado;
            $arrfechai = explode("-",$value->ESTUDIOC_FechaInicio);
            $arrfechaf = explode("-",$value->ESTUDIOC_FechaFin);
            $mesi   = $arrfechai[1];
            $anioi  = $arrfechai[0];
            $mesf   = $arrfechaf[1];
            $aniof  = $arrfechaf[0];             
           ?>
          <h2>&bull;<?php echo $value->GRADOC_Descripcion;?>&nbsp;<?php echo $value->ESTUDIOC_Descripcion;?>, <?php echo $arrSituacion[$situacion];?></h2>
          <h3><?php echo $value->UNIVC_Nombre;?></h3>
          <h3><?php echo $arrmes[$mesi];?>-<?php echo $anioi;?>&nbsp;-&nbsp;<?php echo $arrmes[$mesf];?>-<?php echo $aniof;?></h3>
           <?php
       }
   }
   ?>
</span>