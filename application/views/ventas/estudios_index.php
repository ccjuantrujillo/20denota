<span class="subtitulo">Estudio:</span>
 <span class="btn_agregar">
     <?php 
    if($lista->profesor!=""){
        ?>
        <input type="button" id="nuevo_estudio" class="aceptarlog3" value="+&nbsp;&nbsp;Añadir">
        <?php
    }
    ?>    
 </span>
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
            <ul style="width: 100%;" id="<?php echo $value->ESTUDIOP_Codigo;?>">
                <li><span>&bull;<?php echo $value->GRADOC_Descripcion;?>&nbsp;<?php echo $value->ESTUDIOC_Descripcion;?>, <?php echo $arrSituacion[$situacion];?></span>&nbsp;<span class="editar_estudio"><img src="<?php echo img;?>/orar.gif"></span>&nbsp;<span class="eliminar_estudio"><img src="<?php echo img;?>/eliminar.gif"></span></li>
                <li><span><?php echo $value->UNIVC_Nombre;?></span></li>
                <li><span><?php echo $arrmes[$mesi];?>-<?php echo $anioi;?>&nbsp;-&nbsp;<?php echo $arrmes[$mesf];?>-<?php echo $aniof;?></span></li>
            </ul>
           <?php
       }
   }
   ?>
</span>