<form id="frm_conferencia">
    <table style="width: 100%;background-color: #f4f7ff">
        <tr>
            <td class="formss" bgcolor="#d5e2f2">Fecha</td>
            <td class="formss"><?php echo $seluniversidad;?></td>
        </tr>
        <tr>
            <td class="formss" bgcolor="#d5e2f2">Nombre</td>
            <td class="formss"><input type="text" id="cargo" name="cargo" class="cajaGrande" maxlength="100"></td>
        </tr>  
        <tr>
            <td class="formss" bgcolor="#d5e2f2">Descripcion</td>
            <td class="formss"><input type="text" id="curso" name="curso" class="cajaGrande" maxlength="100"></td>
        </tr>   
        <tr>
            <td class="formss" bgcolor="#d5e2f2">Pais</td>
            <td class="formss">
                <span><?php echo $selmesi;?></span>
                <span><?php echo $selanoi;?></span>
            </td>
        </td>
      </tr>  
      <tr>
        <td>
            <input type="button" id="anadir_experiencia" class="aceptarlog3" value="Guardar">&nbsp;
            <input type="button" id="cancelar_experiencia" class="aceptarlog3" value="Cancelar" onclick="$('.tab_conferencia').hide();">
        </td>
      </tr>
      </table>                          
</form>