<form id="frm_sociedades">
    <table style="width: 100%;background-color: #f4f7ff">
        <tr>
            <td class="formss" bgcolor="#d5e2f2">Sociedad Cientifica</td>
            <td class="formss"><?php echo $selsociedad;?></td>
        </tr>
        <tr>
            <td class="formss" bgcolor="#d5e2f2">F.Afiliación</td>
            <td class="formss"><input name="fafiliacion" id="fafiliacion" type="text"  value="<?php echo $lista->afiliacion;?>" class="cajaMinima" maxlength="10" readonly="readonly"></td>
        </tr>   
      <tr>
        <td>
            <input type="button" id="grabar_sociedad" class="aceptarlog3" value="Guardar">&nbsp;
            <input type="button" id="cancelar_sociedad" class="aceptarlog3" value="Cancelar" onclick="$('.tab_sociedad').hide();">
        </td>
      </tr>
      </table>   
    <?php echo $oculto_det?>
</form>