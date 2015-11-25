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
            <td class="formss"><input type="text" id="descripcion" name="descripcion" class="cajaSuperGrande" maxlength="100" value="<?php echo $lista->descripcion;?>"></td>
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
            <input type="button" id="grabar_estudio" class="aceptarlog3" value="Guardar">&nbsp;
            <input type="button" id="cancelar_estudio" class="aceptarlog3" value="Cancelar" onclick="$('.tab_estudios').hide();">
        </td>
      </tr>
      </table>      
      <?php echo $oculto_det?>
</form>