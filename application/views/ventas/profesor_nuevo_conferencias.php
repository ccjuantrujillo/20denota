<span class="subtitulo">Conferencias</span>
<span class="btn_agregar"><input type="button" id="anadir" class="aceptarlog3" value="+&nbsp;&nbsp;Añadir" onclick="$('.tab_idiomas').show();"></span>                
<span class="lst_conferencias">
    <?php
    if(count($lista->estudios)>0){
        foreach($lista->estudios as $indice=>$value){
            ?>
           <h2><?php echo $value->UNIVC_Nombre;?></h2>
           <h3><?php echo $value->GRADOC_Descripcion;?>,&nbsp;<?php echo $value->ESTUDIOC_Descripcion;?></h3>
           <h3><?php echo $arrmes[$value->ESTUDIOC_MesInicio];?>-<?php echo $value->ESTUDIOC_AnoInicio;?>&nbsp;-&nbsp;<?php echo $arrmes[$value->ESTUDIOC_MesFin];?>-<?php echo $value->ESTUDIOC_AnoFin;?></h3>
            <?php
        }
    }
    ?>
</span> 