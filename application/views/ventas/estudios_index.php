<span class="subtitulo">Estudio:</span>
 <span class="btn_agregar"><input type="button" id="editar_estudios" class="aceptarlog3" value="+&nbsp;&nbsp;Añadir"></span>
 <span class="tab_estudios">&nbsp;</span> 
 <span class="lst_estudios">
   <?php
   if(count($lista->estudios)>0){
       foreach($lista->estudios as $indice=>$value){
           ?>
          <h2>&bull;<?php echo $value->UNIVC_Nombre;?></h2>
          <h3><?php echo $value->GRADOC_Descripcion;?>,&nbsp;<?php echo $value->ESTUDIOC_Descripcion;?></h3>
          <h3>Hola</h3>
           <?php
       }
   }
   ?>
</span>