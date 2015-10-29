<div class="contenidotabla" >        
    <?php echo $form_open;?>   
    <h2><?php echo $titulo;?></h2>   
    <div id="container">     
        <input id="tab-1" type="radio" name="tab-group" checked="checked" />
        <label for="tab-1">Datos Principales</label>
        <input id="tab-2" type="radio" name="tab-group" />
        <label for="tab-2">Datos Secundarios</label>
        <div id="content">   
            <div id="content-1">
                <span id="principal"><?php echo $principal;?></span>
            </div>
            <div id="content-2">
                <span id="experiencia"><?php echo $experiencia;?></span>
                <span id="educacion"><?php echo $educacion;?></span>
                <span id="idiomas"><?php echo $idiomas;?></span>
                <span id="conferencias"><?php echo $conferencias;?></span>
                <span id="sociedades"><?php echo $sociedades;?></span>
                <span id="empresa"><?php echo $empresa;?></span>
            </div>
        </div>        
    </div>
    <div class="frmboton">
        <input class="botones" id="cancelar" type="button" alt="Cancelar" title="Cancelar" value="Cancelar"/>                                                     
        <input class="botones" id="grabar" type="button" alt="Aceptar" title="Aceptar" value="Aceptar"/>
    </div>         
    <?php echo $oculto;?>
    <?php echo $form_close;?>  
</div>