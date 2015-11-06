<span class="subtitulo">Idiomas</span>
<span class="btn_agregar"><input type="button" id="anadir" class="aceptarlog3" value="+&nbsp;&nbsp;Añadir" onclick="$('.tab_idiomas').show();"></span>                
<span class="tab_idiomas">
    <form id="frm_idiomas">
        <table style="width: 100%;background-color: #f4f7ff">
            <tr>
                <td class="formss" bgcolor="#d5e2f2">Idioma</td>
                <td class="formss"><?php echo $seluniversidad;?></td>
            </tr>
            <tr>
                <td class="formss" bgcolor="#d5e2f2">Nivel</td>
                <td class="formss"><?php echo $selgrado;?></td>
            </tr>   
          <tr>
            <td>
                <input type="button" id="anadir_idioma" class="aceptarlog3" value="Guardar">&nbsp;
                <input type="button" id="cancelar_idioma" class="aceptarlog3" value="Cancelar" onclick="$('.tab_idiomas').hide();">
            </td>
          </tr>
          </table>                          
    </form>
</span>                   
<span class="lst_idiomas">
    <?php
    if(count($lista->estudiosidiomas)>0){
        foreach($lista->estudiosidiomas as $indice=>$value){
            ?>
           <h2><?php echo $value->ESTIDIOMC_Descripcion;?></h2>
           <h3><?php echo $value->ESTIDIOMC_Nivel;?>,&nbsp;<?php echo $value->ESTIDIOMC_Nivel;?></h3>
           <h3></h3>
            <?php
        }
    }
    ?>
</span> 