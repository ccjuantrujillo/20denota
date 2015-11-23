<form id="frm_experiencia">
    <table style="width: 100%;background-color: #f4f7ff">
        <tr>
            <td class="formss" bgcolor="#d5e2f2">Institucion</td>
            <td class="formss"><?php echo $seluniversidad;?></td>
        </tr>
        <tr>
            <td class="formss" bgcolor="#d5e2f2">Cargo desempeñado</td>
            <td class="formss"><input type="text" id="cargo" name="cargo" class="cajaGrande" maxlength="100" value="<?php echo $lista->cargo;?>"></td>
        </tr>  
        <tr>
            <td class="formss" bgcolor="#d5e2f2">Curso</td>
            <td class="formss"><input type="text" id="curso" name="curso" class="cajaGrande" maxlength="100" value="<?php echo $lista->curso;?>"></td>
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
            <input type="button" id="grabar_experiencia" class="aceptarlog3" value="Guardar">&nbsp;
            <input type="button" id="cancelar_experiencia" class="aceptarlog3" value="Cancelar" onclick="$('.tab_experiencia').hide();">
        </td>
      </tr>
      </table>   
    <?php echo $oculto_det?>
</form>