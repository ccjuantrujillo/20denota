<?php echo $form_open;?>
<table width="100%" style="background-color: #f4f7ff">
    <tr>
      <td width="20%" bgcolor="#d5e2f2">Codigo:</td>
      <td width="20%"class="formss"><input name="codigo" id="codigo" type="text" value="<?php echo $lista->codigo;?>" readonly="readonly" class="cajaMinima" style="background-color: #E6E6E6"/></td>
      <td width="40%" colspan="2">&nbsp;</td>
      <td width="20%" rowspan="6" align="center" bgcolor="#f4f7ff"><img alt="Imagen no disponoble" src="<?php echo img;?>/no_disponible.jpg" width="150" height="150" border="1" valign="top"></img></td>
    </tr>
    <tr>
      <td bgcolor="#d5e2f2">A.Paterno:</td>
      <td class="formss" colspan="3"><input name="paterno" id="paterno" type="text" value="<?php echo $lista->paterno;?>" class="cajaSuperGrande"/></td>                        
    </tr>
    <tr>
      <td bgcolor="#d5e2f2">A.Materno:</td>
      <td class="formss" colspan="3"><input name="materno" id="materno" type="text" value="<?php echo $lista->materno;?>" class="cajaSuperGrande"/></td>                        
    </tr>
     
    <tr>
      <td bgcolor="#d5e2f2">Nombres:</td>
      <td class="formss" colspan="3"><input name="nombres" id="nombres" type="text" value="<?php echo $lista->nombres;?>" class="cajaSuperGrande"/></td>                      
    </tr>
    <tr>
      <td width="20%" bgcolor="#d5e2f2">F.Nacimiento:</td>
      <td width="20%" class="formss"><input name="fnacimiento" id="fnacimiento" type="text"  value="<?php echo $lista->fnac;?>" class="cajaMinima" maxlength="10" readonly="readonly"></td>
      <td width="20%" bgcolor="#d5e2f2">Sexo:</td>
      <td width="20%" class="formss"><?php echo $selsexo;?></td>
    </tr> 
    <tr>
      <td bgcolor="#d5e2f2">Tipo Documento:</td>
      <td class="formss"><?php echo $seltipodoc;?></td>
      <td bgcolor="#d5e2f2">D.N.I.:</td>
      <td class="formss"><input name="numero" id="numero" type="text" maxlength="8" value="<?php echo $lista->numerodoc;?>" class="cajaMinima"/></td>                          
    </tr>
    <tr>
      <td bgcolor="#d5e2f2">Telefono:</td>
      <td class="formss"><input name="telefono" id="telefono" type="text" value="<?php echo $lista->telefono;?>" class="cajaMedia"/></td>
      <td bgcolor="#d5e2f2">Celular:</td>
      <td class="formss"><input name="movil" id="movil" type="text" value="<?php echo $lista->movil;?>" class="cajaMedia"/></td>                          
      <td bgcolor="#d5e2f2">&nbsp;</td>
    </tr>   
    <tr>
      <td bgcolor="#d5e2f2">Curso:</td>
      <td class="formss"><?php echo $selcurso;?></td>
      <td bgcolor="#d5e2f2">Estado:</td>
      <td class="formss"><?php echo $selestado;?></td>
      <td bgcolor="#d5e2f2">&nbsp;</td>
    </tr>                        
    <tr>
      <td bgcolor="#d5e2f2">Email:</td>
      <td class="formss" colspan="3"><input name="email" id="email" type="text" value="<?php echo $lista->email;?>" class="cajaSuperGrande minus" onblur="return ValidateEmail(this,event)"/></td>
      <td bgcolor="#d5e2f2">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#d5e2f2">Direccion:</td>
      <td class="formss" colspan="3"><input name="direccion" id="direccion" type="text" value="<?php echo $lista->direccion;?>" class="cajaSuperGrande"/></td>
      <td bgcolor="#d5e2f2">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#d5e2f2">Cargo</td>
      <td class="formss" colspan="3"><?php echo $selcoord;?></td>
      <td bgcolor="#d5e2f2">&nbsp;</td>                          
    </tr>   
</table>
<?php echo $oculto;?>
<?php echo $form_close;?>  