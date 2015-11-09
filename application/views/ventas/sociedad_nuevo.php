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
            <input type="button" id="cancelar_sociedades" class="aceptarlog3" value="Cancelar" onclick="$('.tab_sociedad').hide();">
        </td>
      </tr>
      </table>                          
</form>