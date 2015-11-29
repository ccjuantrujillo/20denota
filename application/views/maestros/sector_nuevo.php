<div class="contenidotabla" >
    <h1><?php echo $titulo;?> </h1>
    <?php echo $form_open;?>
    <table style="background-color: #f4f7ff">
        <tr>
          <td width="50%" bgcolor="#d5e2f2">Codigo:</td>
          <td class="formss"><input name="codigo" id="codigo" type="text" value="<?php echo $lista->codigo;?>" readonly="readonly" class="cajaMinima" style="background-color: #E6E6E6"/></td>
        </tr>
        <tr>
          <td bgcolor="#d5e2f2">Descripcion:</td>
          <td class="formss"><input name="nombre" id="nombre" type="text" value="<?php echo $lista->descripcion;?>" class="cajaMedia"/></td>
        </tr>
    </table>
    <?php echo $oculto;?>
    <?php echo $form_close;?>
    <div class="frmboton">
       <div class="frmboton_login">
           <input id="cancelar" class="botones" type="button" alt="Cancelar" title="Cancelar" value="Cancelar"/>
           <input id="grabar" class="botones" type="button" alt="Aceptar" title="Aceptar" value="Aceptar"/>
       </div>
    </div>           
</div>