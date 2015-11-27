<form id="frm_conferencia">
    <table style="width: 100%;background-color: #f4f7ff">
        <tr>
            <td class="formss" bgcolor="#d5e2f2">Fecha</td>
            <td class="formss"><input name="fconferencia" id="fconferencia" type="text"  value="<?php echo $lista->fecha;?>" class="cajaMinima" maxlength="10" readonly="readonly"></td>
        </tr>
        <tr>
            <td class="formss" bgcolor="#d5e2f2">Nombre</td>
            <td class="formss"><input type="text" id="nom_conferencia" name="nom_conferencia" class="cajaGrande" maxlength="100" value="<?php echo $lista->nombre;?>"></td>
        </tr>  
        <tr>
            <td class="formss" bgcolor="#d5e2f2">Descripcion</td>
            <td class="formss"><input type="text" id="des_conferencia" name="des_conferencia" class="cajaGrande" maxlength="100" value="<?php echo $lista->descripcion;?>"></td>
        </tr>    
      <tr>
        <td>
            <input type="button" id="grabar_conferencia" class="aceptarlog3" value="Guardar">&nbsp;
            <input type="button" id="cancelar_conferencia" class="aceptarlog3" value="Cancelar" onclick="$('.tab_conferencias').hide();">
        </td>
      </tr>
      </table>  
    <?php echo $oculto_det?>
</form>