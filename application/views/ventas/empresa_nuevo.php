<form id="frm_empresa">
    <table style="width: 100%;background-color: #f4f7ff">
        <tr>
            <td class="formss" bgcolor="#d5e2f2">Empresa</td>
            <td class="formss"><?php echo $seluniversidad;?></td>
        </tr>
        <tr>
            <td class="formss" bgcolor="#d5e2f2">Sector</td>
            <td class="formss"><?php echo $selgrado;?></td>
        </tr>  
        <tr>
            <td class="formss" bgcolor="#d5e2f2">Cargo</td>
            <td class="formss"><input type="text" id="universidad" name="universidad" class="cajaSuperGrande" maxlength="100"></td>
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
            <input type="button" id="cancelar_estudio" class="aceptarlog3" value="Cancelar" onclick="$('.tab_empresa').hide();">
        </td>
      </tr>
      </table>                          
</form>