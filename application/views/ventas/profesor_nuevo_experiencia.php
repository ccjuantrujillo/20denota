<span class="subtitulo">Experiencia:</span>
<span class="btn_agregar"><input type="button" id="anadir_experiencia" class="aceptarlog3" value="+&nbsp;&nbsp;Añadir" onclick="$('.tab_experiencia').show();"></span>                
<span class="tab_experiencia">
   <form id="frm_experiencia">
       <table style="width: 100%;background-color: #f4f7ff">
           <tr>
               <td class="formss" bgcolor="#d5e2f2">Institucion</td>
               <td class="formss"><input type="text" id="empresa" name="empresa" class="cajaGrande" maxlength="100"></td>
           </tr>
           <tr>
               <td class="formss" bgcolor="#d5e2f2">Cargo desempeñado</td>
               <td class="formss"><input type="text" id="cargo" name="cargo" class="cajaGrande" maxlength="100"></td>
           </tr>  
           <tr>
               <td class="formss" bgcolor="#d5e2f2">Curso</td>
               <td class="formss"><input type="text" id="curso" name="curso" class="cajaGrande" maxlength="100"></td>
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
               <input type="button" id="anadir_experiencia" class="aceptarlog3" value="Guardar">&nbsp;
               <input type="button" id="cancelar_experiencia" class="aceptarlog3" value="Cancelar" onclick="$('.tab_experiencia').hide();">
           </td>
         </tr>
         </table>                          
   </form>
</span>  
<span class="lst_esperiencia">
    <?php
    if(count($lista->estudios)>0){
        foreach($lista->estudios as $indice=>$value){
            ?>
           <h2><?php echo $value->UNIVC_Nombre;?></h2>
           <h3><?php echo $value->GRADOC_Descripcion;?>,&nbsp;<?php echo $value->ESTUDIOC_Descripcion;?></h3>
           <h3><?php echo $arrmes[0];?>-<?php echo 1;?>&nbsp;-&nbsp;<?php echo $arrmes[0];?>-<?php echo 1;?></h3>
            <?php
        }
    }
    ?>
</span> 