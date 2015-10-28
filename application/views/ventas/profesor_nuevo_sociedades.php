<span class="subtitulo">Sociedades Cientificas</span>
<span class="btn_agregar"><input type="button" id="anadir" class="aceptarlog3" value="+&nbsp;&nbsp;Añadir" onclick="$('.tab_sociedades').show();"></span>                                
<span class="tab_sociedades">
    <form id="frm_sociedades">
        <table style="width: 100%;background-color: #f4f7ff">
            <tr>
                <td class="formss" bgcolor="#d5e2f2">Sociedad Cientifica</td>
                <td class="formss"><?php echo $seluniversidad;?></td>
            </tr>
            <tr>
                <td class="formss" bgcolor="#d5e2f2">F.Afiliación</td>
                <td class="formss"><input type="text" id="universidad" name="universidad" class="cajaSuperGrande" maxlength="100"></td>
            </tr>   
          <tr>
            <td>
                <input type="button" id="anadir_sociedades" class="aceptarlog3" value="Guardar">&nbsp;
                <input type="button" id="cancelar_sociedades" class="aceptarlog3" value="Cancelar" onclick="$('.tab_sociedades').hide();">
            </td>
          </tr>
          </table>                          
    </form>
</span>                 
<span class="lst_sociedades">
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