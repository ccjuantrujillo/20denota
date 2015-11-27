<div class="contenidotabla" >
        <h1><?php echo $titulo;?> </h1>
        <?php echo $form_open;?>
        <table style="background-color: #f4f7ff">
            <tr>
              <td width="50%" bgcolor="#d5e2f2">Codigo:</td>
              <td class="formss"><input name="codigo" id="codigo" type="text" value="<?php echo $lista->codigo;?>" readonly="readonly" class="cajaMinima" style="background-color: #E6E6E6"/></td>
            </tr>
            <tr>
              <td bgcolor="#d5e2f2">RUC:</td>
              <td class="formss"><input name="ruc" id="ruc" type="text" value="<?php echo $lista->ruc;?>" class="cajaMedia" maxlength="11"/></td>
            </tr>
            <tr>
              <td bgcolor="#d5e2f2">Razon Social:</td>
              <td class="formss"><input name="rsocial" id="rsocial" type="text" value="<?php echo $lista->rsocial;?>" class="cajaMedia"/></td>
            </tr>
            <tr>
              <td bgcolor="#d5e2f2">Sector:</td>
              <td class="formss"><?php echo $selsector;?></td>
            </tr>
            <tr>
              <td bgcolor="#d5e2f2">Telefono:</td>
              <td class="formss"><input name="telefono" id=telefono" type="text" value="<?php echo $lista->telefono;?>" class="cajaMedia"/></td>
            </tr>   
            <tr>
              <td bgcolor="#d5e2f2">Movil:</td>
              <td class="formss"><input name="movil" id=movil" type="text" value="<?php echo $lista->movil;?>" class="cajaMedia"/></td>
            </tr>            
            <tr>
              <td bgcolor="#d5e2f2">Fax:</td>
              <td class="formss"><input name="fax" id=fax" type="text" value="<?php echo $lista->fax;?>" class="cajaMedia"/></td>
            </tr>  
            <tr>
              <td bgcolor="#d5e2f2">Web:</td>
              <td class="formss"><input name="web" id=web" type="text" value="<?php echo $lista->web;?>" class="cajaMedia"/></td>
            </tr>  
            <tr>
              <td bgcolor="#d5e2f2">Email:</td>
              <td class="formss"><input name="email" id=email" type="text" value="<?php echo $lista->email;?>" class="cajaMedia"/></td>
            </tr>    
            <tr>
              <td bgcolor="#d5e2f2">Direccion:</td>
              <td class="formss"><input name="direccion" id=direccion" type="text" value="<?php echo $lista->direccion;?>" class="cajaMedia"/></td>
            </tr>              
            <tr>
              <td bgcolor="#d5e2f2">Estado:</td>
              <td class="formss"><?php echo $selestado;?></td>
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