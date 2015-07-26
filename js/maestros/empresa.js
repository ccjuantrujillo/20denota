var base_url
jQuery(document).ready(function(){
    base_url   = $("#base_url").val();
       
    $("#imgGuardarEmpresa").click(function(){
		dataString = $('#frmEmpresa').serialize();
		$("#container").show();
		$("#frmEmpresa").submit();
    });
    $("#buscarEmpresa").click(function(){
		$("#form_busqueda").submit();
    });	
    $("#nuevoEmpresa").click(function(){
		url = base_url+"index.php/maestros/empresa/nuevo_empresa";
		$("#zonaContenido").load(url);
    });
    $("#limpiarEmpresa").click(function(){
        url = base_url+"index.php/maestros/empresa/empresas";
        location.href=url;
    });
    $("#imgCancelarEmpresa").click(function(){
        base_url = $("#base_url").val();
        location.href = base_url+"index.php/maestros/empresa/empresas";
    });
    
	container = $('div.container');
 	$("#frmEmpresa").validate({
		event    : "blur",
		rules    : {
					'ruc'             : {required:true,minlength:11,number:true},
					'razon_social'    : "required"
 			    },
		debug    : true,
		errorContainer      : "container",
		errorLabelContainer : $(".container"),
		wrapper             : 'li',
		submitHandler       : function(form){
				dataString  = $('#frmEmpresa').serialize();
				modo        = $("#modo").val();
				$('#VentanaTransparente').css("display","block");
				if(modo=='insertar'){
					url = base_url+"index.php/maestros/empresa/insertar_empresa";
					$.post(url,dataString,function(data){
					$("#VentanaTransparente").css("display","none");
						//alert('Se ha ingresado una empresa.');
						//location.href = base_url+"index.php/maestros/empresa/empresas";
					});
				}
				else if(modo=='modificar'){
					url = base_url+"index.php/maestros/empresa/modificar_empresa";
					$.post(url,dataString,function(data){
						$("#VentanaTransparente").css("display","none");
						alert('Su registro ha sido modificado.');
						location.href = base_url+"index.php/maestros/empresa/empresas";
					});
				}
		}
	});
    //Ocultar capas
    $('#idGeneral').click(function(){
        $('#datosGenerales').show();
        $('#datosSucursales').hide();
        $('#datosContactos').hide();
        $('#datosAreas').hide();
        $('#nuevoRegistro').hide();
        $('#opcion').val('1');
        $("#botonBusqueda").show();
    });
    $('#idSucursales').click(function(){
        $('#datosGenerales').hide();
        $('#datosSucursales').show();
        $('#datosContactos').hide();
        $('#datosAreas').hide();
        $('#nuevoRegistro').show();
        $('#opcion').val('2');
        $("#botonBusqueda").hide();
    });
    $('#idContactos').click(function(){
        $('#datosGenerales').hide();
        $('#datosSucursales').hide();
        $('#datosContactos').show();
        $('#datosAreas').hide();
        $('#nuevoRegistro').show();
		$('#opcion').val('3');
		$("#botonBusqueda").hide();
    });
    $('#idAreas').click(function(){
        $('#datosGenerales').hide();
        $('#datosSucursales').hide();
        $('#datosContactos').hide();
        $('#datosAreas').show();
        $('#nuevoRegistro').show();
		$('#opcion').val('4');
		$("#botonBusqueda").hide();
    });

    container = $('div.container');
	
    //Funcionalidades
    $("#nuevoRegistro").click(function(){
        opcion   = $("#opcion").val();
		persona  = $("#persona").val();
		empresa  = $("#empresa").val();
		modo     = $("#modo").val();
		img_url  = base_url+"system/application/views/images/";
		if(opcion==4){
			n = document.getElementById('tablaArea').rows.length/2;
			j = n+1;
			fila  = "<tr>";
			fila += "<td align='center'>"+j+"</td>";
			fila += "<td align='left'><input type='text' name='nombre_area["+n+"]' id='nombre_area["+n+"]' class='cajaGrande'></td>";
			if(modo=='modificar'){
				fila += "<td align='center'>&nbsp;</td>";
				fila += "<td align='center'><a href='#' onclick='insertar_area();'><img src='"+base_url+"images/save.gif' border='0'></a></td>";
				fila += "</tr>";
			}
			$("#tablaArea").append(fila);
		}
        else if(opcion==3){
			$("#msgRegistros").hide();		
			n = (document.getElementById('tablaContacto').rows.length);
			a = "contactoNombre["+n+"]";
			j = n+1;
			fila  = "<tr>";
			fila += "<td align='center'>"+n+"</td>";
			fila += "<td align='left' style='position:relative;'>";
			fila += "<input type='hidden' name='contactoPersona["+n+"]' id='contactoPersona["+n+"]' class='cajaMedia'>";
			fila += "<input type='text' name='contactoNombre["+n+"]' id='contactoNombre["+n+"]' class='cajaMedia' onfocus='ocultar_homonimos("+n+")'>";
			fila += "<a href='#' onclick='mostrar_homonimos("+n+");'><image src='"+base_url+"images/ver.png' border='0'></a>";
			fila += "<div id='homonimos["+n+"]' style='display:none;background:#ffffff;width:300px;border:1px solid #cccccc;height:100px;overflow:auto;position:absolute;z-index:1;'></div>";
			fila += "</td>";
			fila += "<td align='center'><select name='contactoArea["+n+"]' id='contactoArea["+n+"]' class='comboMedio' ><option value='0'>::Seleccionar::</option></select></td>";
			fila += "<td align='left'><select name='cargo_encargado["+n+"]' id='cargo_encargado["+n+"]' class='cajaMedia'><option value='0'>::Seleccione::</option></select></td>";
			fila += "<td align='left'><input type='text' name='contactoTelefono["+n+"]' id='contactoTelefono["+n+"]' class='cajaPequena'></td>";
			fila += "<td align='left'><input type='text' name='contactoEmail["+n+"]' id='contactoEmail["+n+"]' class='cajaPequena'></td>";
			if($('#empresa_persona').val()!=''){
				fila += "<td align='center'>&nbsp;</td>";
				fila += "<td align='center'><a href='#' onclick='insertar_contacto("+n+");'><img src='"+base_url+"images/save.gif' border='0'></a></td>";
			}
                        else{
                            fila += "<td>&nbsp;</td>";
                            fila += "<td>&nbsp;</td>";
                        }
			fila += "</tr>";
			$("#tablaContacto").append(fila);
			document.getElementById(a).focus();
			listar_areas(n);
		}
		else if(opcion==2){
                        $("#msgRegistros2").hide();		
			n = document.getElementById('tablaSucursal').rows.length;
			a = "nombreSucursal["+n+"]";
			j = n+1;
			fila  = "<tr>";
			fila += "<td align='center'>"+n+"</td>";
			fila += "<td align='left'>";
			fila += "<input type='text' name='nombreSucursal["+n+"]' id='nombreSucursal["+n+"]' class='cajaMedia'>";
			fila += "<input type='hidden' name='empresaSucursal["+n+"]' id='empresaSucursal["+n+"]' class='cajaMedia' value='"+empresa+"'>";
			fila += "</td>";
			fila += "<td align='left'><select name='tipoEstablecimiento["+n+"]' id='tipoEstablecimiento["+n+"]' class='comboMedio' ><option>::Seleccione::</option></select></td>";
			fila += "<td align='left'><input type='text' name='direccionSucursal["+n+"]' id='direccionSucursal["+n+"]' class='cajaGrande'></td>";
			fila += "<td align='left'>";
			fila += "<input type='hidden' name='dptoSucursal["+n+"]' id='dptoSucursal["+n+"]' class='cajaGrande' value='15'>";
			fila += "<input type='hidden' name='provSucursal["+n+"]' id='provSucursal["+n+"]' class='cajaGrande' value='01'>";
			fila += "<input type='hidden' name='distSucursal["+n+"]' id='distSucursal["+n+"]' class='cajaGrande'>";
			fila += "<input type='text' name='distritoSucursal["+n+"]' id='distritoSucursal["+n+"]' class='cajaPequena' readonly='readonly' onclick='abrir_formulario_ubigeo_sucursal("+n+");'/>";
			fila += "<a href='#' onclick='abrir_formulario_ubigeo_sucursal("+n+");'><image src='"+base_url+"images/ver.png' border='0'></a>";
			fila += "</td>";
			if($('#empresa_persona').val()!=''){
				fila += "<td align='center'>&nbsp;</td>";
				fila += "<td align='center'><a href='#' onclick='insertar_sucursal("+n+");'><img src='"+base_url+"images/save.gif' border='0'></a></td>";
			}
                        else{
                            fila += "<td>&nbsp;</td>";
                            fila += "<td>&nbsp;</td>";
                        }
			fila += "</tr>";
			$("#tablaSucursal").append(fila);
			document.getElementById(a).focus();
			listar_tipoEstablecimientos(n);
		}
    });
  
});
function editar_empresa(empresa){
        var url = base_url+"index.php/maestros/empresa/editar_empresa/"+empresa;
	$("#zonaContenido").load(url);
}
function eliminar_empresa(empresa){
	if(confirm('Está seguro que desea eliminar esta empresa?')){
		dataString = "empresa="+empresa;
		url = base_url+"index.php/maestros/empresa/eliminar_empresa";
		$.post(url,dataString,function(data){
			url = base_url+"index.php/maestros/empresa/empresas";
			location.href = url;
		});
	}
}
function ver_empresa(empresa){
	url = base_url+"index.php/maestros/empresa/ver_empresa/"+empresa;
	$("#zonaContenido").load(url);
}
function atras_empresa(){
	location.href = base_url+"index.php/maestros/empresa/empresas";
}
function insertar_contacto(id){
	a = "contactoNombre["+id+"]";
	b = "contactoArea["+id+"]";
	c = "cargo_encargado["+id+"]";
	d = "contactoTelefono["+id+"]";
	e = "contactoEmail["+id+"]";
	f = "contactoPersona["+id+"]";
	empresa         = document.getElementById('empresa_persona').value;
	nombre_contacto   = document.getElementById(a).value;
	area_contacto     = document.getElementById(b).value;
	cargo_contacto    = document.getElementById(c).value;
	telefono_contacto = document.getElementById(d).value;
	email_contacto    = document.getElementById(e).value;
	contacto_persona  = document.getElementById(f).value;
	dataString        = "empresa="+empresa+"&persona_contacto="+contacto_persona+"&nombre_contacto="+nombre_contacto+"&area_contacto="+area_contacto+"&cargo_contacto="+cargo_contacto+"&telefono_contacto="+telefono_contacto+"&email_contacto="+email_contacto;
	url = base_url+"index.php/maestros/empresa/insertar_contacto";
	$.post(url,dataString,function(data){
		$("#datosContactos").html(data);
	});
}
function insertar_sucursal(n){
	a = "nombreSucursal["+n+"]";
	b = "direccionSucursal["+n+"]";
	c = "distritoSucursal["+n+"]";
	d = "tipoEstablecimiento["+n+"]";
	e = "dptoSucursal["+n+"]";
	f = "provSucursal["+n+"]";
	g = "distSucursal["+n+"]";
	empresa              = document.getElementById('empresa_persona').value;
	nombre_sucursal      = document.getElementById(a).value;
	direccion_sucursal   = document.getElementById(b).value;
	dpto_sucursal        = document.getElementById(e).value;
	prov_sucursal        = document.getElementById(f).value;
	dist_sucursal        = document.getElementById(g).value;
	ubigeo_sucursal      = dpto_sucursal+prov_sucursal+dist_sucursal;
	tipo_establecimiento = document.getElementById(d).value;
	dataString = "empresa="+empresa+"&nombre_sucursal="+nombre_sucursal+"&direccion_sucursal="+direccion_sucursal+"&ubigeo_sucursal="+ubigeo_sucursal+"&tipo_establecimiento="+tipo_establecimiento;
	if(nombre_sucursal!='' && tipo_establecimiento!='' && direccion_sucursal!=''){
		url = base_url+"index.php/maestros/empresa/insertar_sucursal"
		$.post(url,dataString,function(data){
			$("#datosSucursales").html(data);
		});
	}
	else{
		alert('Debe ingresar todos los campos obligatorios.');
	}
}
function editar_sucursal(sucursal){
	empresa           = document.getElementById('empresa_persona').value;
	dataString        = "empresa="+empresa+"&sucursal="+sucursal;
	url = base_url+"index.php/maestros/empresa/editar_sucursal";
	$.post(url,dataString,function(data){
                $("#datosSucursales").html(data);
	});
}
function modificar_sucursal(n){
	a = "nombreSucursal["+n+"]";
	b = "direccionSucursal["+n+"]";
	c = "distritoSucursal["+n+"]";
	d = "tipoEstablecimiento["+n+"]";
	e = "dptoSucursal["+n+"]";
	f = "provSucursal["+n+"]";
	g = "distSucursal["+n+"]";
        h = "empresaSucursal["+n+"]";
	empresa              = document.getElementById('empresa_persona').value;
	nombre_sucursal      = document.getElementById(a).value;
	direccion_sucursal   = document.getElementById(b).value;
	dpto_sucursal        = document.getElementById(e).value;
	prov_sucursal        = document.getElementById(f).value;
	dist_sucursal        = document.getElementById(g).value;
	ubigeo_sucursal      = dpto_sucursal+prov_sucursal+dist_sucursal;
	tipo_establecimiento = document.getElementById(d).value;
        sucursal_empresa     = document.getElementById(h).value;
        dataString = "empresa="+empresa+"&sucursal_empresa="+sucursal_empresa+"&nombre_sucursal="+nombre_sucursal+"&direccion_sucursal="+direccion_sucursal+"&ubigeo_sucursal="+ubigeo_sucursal+"&tipo_establecimiento="+tipo_establecimiento;
	url = base_url+"index.php/maestros/empresa/modificar_sucursal"
	$.post(url,dataString,function(data){
		$("#datosSucursales").html(data);
	});
}
function editar_contacto(persona){
    var empresa         = document.getElementById('empresa_persona').value;
    var dataString        = "empresa="+empresa+"&persona="+persona;
    var url = base_url+"index.php/maestros/empresa/editar_contacto";
    $.post(url,dataString,function(data){
            $("#datosContactos").html(data);
    });
}
function modificar_contacto(id){
	a = "contactoNombre["+id+"]";
	b = "contactoArea["+id+"]";
	c = "cargo_encargado["+id+"]";
	d = "contactoTelefono["+id+"]";
	e = "contactoEmail["+id+"]";
	f = "contactoPersona["+id+"]";
	empresa           = document.getElementById('empresa_persona').value;
	nombre_contacto   = document.getElementById(a).value;
	area_contacto     = document.getElementById(b).value;
	cargo_contacto    = document.getElementById(c).value;
	telefono_contacto = document.getElementById(d).value;
	email_contacto    = document.getElementById(e).value;
	contacto_persona  = document.getElementById(f).value;
	dataString        = "empresa="+empresa+"&persona_contacto="+contacto_persona+"&nombre_contacto="+nombre_contacto+"&area_contacto="+area_contacto+"&cargo_contacto="+cargo_contacto+"&telefono_contacto="+telefono_contacto+"&email_contacto="+email_contacto;
	url = base_url+"index.php/maestros/empresa/modificar_contacto"
	$.post(url,dataString,function(data){
		$("#datosContactos").html(data);
	});
}
function eliminar_contacto(persona){
    if(confirm('Esta seguro desea eliminar a esta persona de su lista de contactos?')){
        var empresa = document.getElementById('empresa_persona').value;
        var dataString = "empresa="+empresa+"&persona="+persona;
        var url = base_url+"index.php/maestros/empresa/eliminar_contacto"
        $.post(url,dataString,function(data){
                $("#datosContactos").html(data);
        });
    }
}
function eliminar_sucursal(sucursal){
    if(confirm('Esta seguro desea eliminar a este establecimiento?')){
        var empresa = document.getElementById('empresa_persona').value;
        var dataString = "empresa="+empresa+"&sucursal="+sucursal;
        var url = base_url+"index.php/maestros/empresa/eliminar_sucursal";
        $.post(url,dataString,function(data){
                $("#datosSucursales").html(data);
        });
    }
}
/*Combos*/
function listar_tipoEstablecimientos(n){
    a      = "tipoEstablecimiento["+n+"]";
    select = document.getElementById(a);
    url = base_url+"index.php/maestros/establecimiento/listar_tiposEstablecimiento";
    $.getJSON(url,function(data){
          $.each(data, function(i,item){
                codigo      = item.TESTP_Codigo;
                descripcion = item.TESTC_Descripcion;
                opt         = document.createElement('option');
                texto       = document.createTextNode(descripcion);
                opt.appendChild(texto);
                opt.value = codigo;
                select.appendChild(opt);
          });
    });
}
function listar_areas(n){
    a      = "contactoArea["+n+"]";
    select = document.getElementById(a);
    url = base_url+"index.php/maestros/area/listar_areas";
    $.getJSON(url,function(data){
          $.each(data, function(i,item){
                codigo      = item.AREAP_Codigo;
                descripcion = item.AREAC_Descripcion;
                opt         = document.createElement('option');
                texto       = document.createTextNode(descripcion);
                opt.appendChild(texto);
                opt.value = codigo;
                select.appendChild(opt);
          });
          listar_cargos(n);
    });
}
function listar_cargos(n){
	a      = "cargo_encargado["+n+"]";
	select = document.getElementById(a);
	url = base_url+"index.php/maestros/cargo/listar_cargos";
	$.getJSON(url,function(data){
		  $.each(data, function(i,item){
			codigo      = item.CARGP_Codigo;
			descripcion = item.CARGC_Descripcion;
			opt         = document.createElement('option');
			texto       = document.createTextNode(descripcion);
			opt.appendChild(texto);
			opt.value = codigo;
			select.appendChild(opt);
		  });
	});
}
function listar_contactos(proveedor){
    a      = "contacto";
    select = document.getElementById(a);
    url = base_url+"index.php/compras/proveedor/listar_contactosProveedor/"+proveedor;
    $.getJSON(url,function(data){
          $.each(data, function(i,item){
            codigo      = item.persona;
            descripcion = item.nombre_persona;
            opt         = document.createElement('option');
            texto       = document.createTextNode(descripcion);
            opt.appendChild(texto);
            opt.value = codigo;
            select.appendChild(opt);
          });
    });
}
function listar_distritos(n){

}
function cargar_provincia(obj){
    departamento = obj.value;
    provincia    = "01";
    if(departamento!='00'){
        url = base_url+"index.php/maestros/ubigeo/cargar_ubigeo/"+departamento+"/"+provincia;
        $("#divUbigeo").load(url);
    }
}
function cargar_distrito(obj){
    departamento = $("#cboDepartamento").val();
    provincia    = obj.value;
    if(departamento!='00' && provincia!='00'){
        url = base_url+"index.php/maestros/ubigeo/cargar_ubigeo/"+departamento+"/"+provincia;
        $("#divUbigeo").load(url);
    }
}
function mostrar_homonimos(n){
    a = "homonimos["+n+"]";
    b = "contactoNombre["+n+"]";
    nombre = document.getElementById(b).value;
    url = base_url+"index.php/maestros/persona/busqueda_personas";
    if(nombre.length!='0'){
            dataString = "nombre="+nombre+"&n="+n;
            $.ajax({
                    type    : "POST",
                    url     : url,
                    data    : dataString,
                    success : function(response) {
                            if(response){
                                document.getElementById(a).style.display = "block";
                                document.getElementById(a).innerHTML = response;
                            }
                    }
                });
    }
    else{
        alert('Debe ingresar el nombre de su contacto');
        document.getElementById(b).focus();
    }
}
function ocultar_homonimos(n){
    a = "homonimos["+n+"]";
    b = "contactoNombre["+n+"]";
    nombre_contacto = document.getElementById(b).value;
    if(nombre_contacto.length!='0'){
        document.getElementById(a).style.display = 'none';
    }
}
function mostrar_encargado(n){
    a = "divEncargado["+n+"]";
    b = "encargado_area["+n+"]";
    nombre_encargado = document.getElementById(b).value;
    url = base_url+"index.php/maestros/persona/busqueda_personas";
}
function obtener_persona(persona,n){
	a = "homonimos["+n+"]";
	b = "contactoNombre["+n+"]";
	url = base_url+"index.php/maestros/persona/obtener_persona/"+persona;
	$.getJSON(url,function(data){
		  $.each(data, function(i,item){
			codigo  = item.PERSP_Codigo;
			nombre  = item.PERSC_Nombre;
			paterno = item.PERSC_ApellidoPaterno;
			materno = item.PERSC_ApellidoMaterno;
			document.getElementById(b).value = nombre+" "+paterno+" ";
			document.getElementById(a).style.display = "none";
		  });
	});
}
function abrir_formulario_ubigeo_sucursal(n){
	a = "dptoSucursal["+n+"]";
	b = "provSucursal["+n+"]";
	c = "distSucursal["+n+"]";
	dpto_nac = document.getElementById(a).value;
	prov_nac = document.getElementById(b).value;
	dist_nac = document.getElementById(c).value;
	ubigeo   = dpto_nac+""+prov_nac+""+dist_nac;
	seccion  = "sucursal";
	url = base_url+"index.php/maestros/ubigeo/formulario_ubigeo_complementario/"+ubigeo+"/"+seccion+"/"+n;
	window.open(url,'Formulario Ubigeo','menubar=no,resizable=no,width=200,height=180');
}

