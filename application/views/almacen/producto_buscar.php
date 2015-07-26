<!DOCTYPE html>
<html>
<head>
    <!-- Calendario -->
    <link rel="stylesheet" href="<?php echo css;?>estilos.css" type="text/css">
    <link rel="stylesheet" href="<?php echo css;?>nav.css" type="text/css">
    <link rel="stylesheet" href="<?php echo css;?>theme.css" type="text/css">
    <script type="text/javascript" src="<?php echo js;?>constants.js"></script> 
    <script type="text/javascript" src="<?php echo js;?>jquery.js"></script>
    <!--script type="text/javascript" src="<?php echo js;?>ventas/ot.js"></script-->
<script>

//opener.document.parentForm.pf2.value = document.childForm.cf2.value;

//    var fecha = $(this).parent().parent().find("#fecha").val();    
//    var fec4 = $("#fecha").val(); 
//     var fec4 = window.parent.$("#fecha").val(); 
//    var fec4 = window.parent.document.getElementById('fecha').innerHTML;
//    var fec4 = window.parent.document.getElementById(fecha).value;
//   var fec4 = window.parent.document.getElementById('fecha').val();
//   var fec4 = $(this).parent().find('fecha'); 

//var factual = window.opener.document.getElementById('fechacomp').value;
//var fecha = window.opener.document.getElementById('fecha').value;
//document.write(fecha); 
function pasar_producto(obj)
{
    codigo = $(obj).attr('id');
    descripcion = $(obj).attr('id2');
    codigo=
   
    
    
     <?php if($n!=''){?> 
        
       //  window.opener.cargar_producto(<?php echo $n;?>,descripcion);
         
     <?php   }
         else
         {     ?>
                 
         window.opener.cargar_producto(descripcion,codigo);   
     <?php   }     ?>
     window.close();
}  

function cerrar()
{
    <?php   if($n!='')
        {     ?>
        window.close();
    <?php   }   
        else
        {     ?>
        window.opener.cargar_producto('','');
        window.close();
    <?php   }     ?>
}
</script>   
</head>
<body  style='font-size:62.5%;' onload="$('#ot').focus();">
    <div style="align:left;border:0px solid #000;height:30px;margin-top: 8px;">
        <form id='frmBusqueda' method='post'>
            <span>CODIGO: <input type='text' name='cod_producto' id='cod_producto' value="<?php if(isset($cod_producto)){echo $cod_producto ;}?>" style='width:75px; ' onkeyup="this.value=this.value.toUpperCase()" ></input></span>
            <span>PRODUCTO:<input type='text' name='descripcion' id='descripcion' style='width:150px;' value="<?php if(isset($descripcion)){echo $descripcion ;}?>"  onkeyup="this.value=this.value.toUpperCase()"  ></span>
            
            
            <span><input type="submit" value="Buscar"></span>
        </form>
    </div>
    <div style = "display: table; width: 100%;border:1px solid #000;">
        <div style = "float: left; height:30px; width: 99%;border:1px solid #000;">
            <table border='1' style='width:100%;'>
                <tr align='center' style="height:30px;">
                    <td style='width:30%;'><div>CODIGO</div></td>
                    <td style='width:70%;'><div>PRODUCTO</div></td>                
                   
                </tr>
            </table>
        </div>
        <div style = "float: left; height: 300px;overflow: auto; width: 100%;border:1px solid #000;">
            <table border='1' style='width:100%;'><?php echo $fila;?></table>        
        </div>
    </div>
    
     <?php
     //if($n!=''){
       echo "<div><input type='button' value='Salir' onclick='cerrar();'></div>";  
     //}
     //else{echo "";}
     ?>

</body>
</html>