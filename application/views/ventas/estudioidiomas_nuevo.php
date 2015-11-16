<form id="frm_idioma">
   <table style="width: 100%;background-color: #f4f7ff">
    <tr>
        <td class="formss" bgcolor="#d5e2f2">Idioma</td>
        <td class="formss"><?php echo $selidiomas;?></td>
    </tr>
    <tr>
        <td class="formss" bgcolor="#d5e2f2">Nivel</td>
        <td class="formss"><?php echo $selnivel;?></td>
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
        <input type="button" id="grabar_idioma" class="aceptarlog3" value="Guardar">&nbsp;
        <input type="button" id="cancelar_idioma" class="aceptarlog3" value="Cancelar" onclick="$('.tab_idiomas').hide();">
    </td>
  </tr>  
  </table>    
   <?php echo $oculto_det?>
</form>