<span class="subtitulo">Educación:</span>
 <span class="btn_agregar"><input type="button" id="anadir" class="aceptarlog3" value="+&nbsp;&nbsp;Añadir" onclick="$('.tab_estudios').show();"></span>
 <span class="tab_estudios">
     <form id="frm_formacion">
         <table style="width: 100%;background-color: #f4f7ff">
             <tr>
                 <td class="formss" bgcolor="#d5e2f2">Universidad</td>
                 <td class="formss"><?php echo $seluniversidad;?></td>
             </tr>
             <tr>
                 <td class="formss" bgcolor="#d5e2f2">Nivel de Estudios</td>
                 <td class="formss"><?php echo $selgrado;?></td>
             </tr>  
             <tr>
                 <td class="formss" bgcolor="#d5e2f2">Descripcion</td>
                 <td class="formss"><input type="text" id="universidad" name="universidad" class="cajaSuperGrande" maxlength="100"></td>
             </tr>   
            <tr>
                 <td class="formss" bgcolor="#d5e2f2">Estado</td>
                 <td class="formss">
                   <input type="radio" id="estado" name="estado" value="1" checked="checked">Culminado
                   <input type="radio" id="estado" name="estado" value="2">Cursando
                   <input type="radio" id="estado" name="estado" value="3">Abandonado/Aplazado
                 </td>
             </tr>   
             <tr>
                 <td class="formss" bgcolor="#d5e2f2">Periodo</td>
                 <td class="formss">
                     <span><?php echo $selmesi;?></span>
                     <span><?php echo $selanoi;?></span>
                 <span>&nbsp;-&nbsp;</span>
                 <span><?php echo $selmesf;?></span>
                 <span><?php echo $selanof;?></span>
             </td>
           </tr>  
           <tr>
             <td>
                 <input type="button" id="anadir_estudio" class="aceptarlog3" value="Guardar">&nbsp;
                 <input type="button" id="cancelar_estudio" class="aceptarlog3" value="Cancelar" onclick="$('.tab_estudios').hide();">
             </td>
           </tr>
           </table>                          
     </form>
 </span> 
<span class="lst_estudios">
   <?php
   if(count($lista->estudios)>0){
       foreach($lista->estudios as $indice=>$value){
          $finicio = explode("-",$value->ESTUDIOC_FechaInicio);
          $ffin    = explode("-",$value->ESTUDIOC_FechaFin);
           ?>
          <h2><?php echo $value->UNIVC_Nombre;?></h2>
          <h3><?php echo $value->GRADOC_Descripcion;?>,&nbsp;<?php echo $value->ESTUDIOC_Descripcion;?></h3>
          <h3><?php echo $arrmes[(int)$finicio[1]];?>-<?php echo $finicio[0];?>&nbsp;-&nbsp;<?php echo $arrmes[(int)$ffin[1]];?>-<?php echo $ffin[0];?></h3>
           <?php
       }
   }
   ?>
</span>