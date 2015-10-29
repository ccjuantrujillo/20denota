<?php header("Content-type: text/html; charset=utf-8"); 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//require_once "Spreadsheet/Excel/Writer.php";

class Curso extends CI_Controller {
    var $compania;
    var $configuracion;
    public function __construct(){
        parent::__construct();
        if(!isset($_SESSION['login'])) die("Sesion terminada. <a href='".  base_url()."'>Registrarse e ingresar.</a> ");        
        $this->load->model(almacen.'curso_model');
        $this->load->model(almacen.'semana_model');
        $this->load->model(almacen.'fabricante_model');
        $this->load->model(almacen.'tipoproducto_model');
        $this->load->model(almacen.'plantilla_model');
        $this->load->model(almacen.'productoproveedor_model');
        $this->load->model(almacen.'unidadmedida_model');
        $this->load->model(almacen.'marca_model');  
        $this->load->model(maestros.'empresa_model');
        $this->load->model(maestros.'moneda_model');
        $this->load->model(maestros.'persona_model');
        $this->load->model(seguridad.'permiso_model');  
        $this->load->helper('menu');
        $this->configuracion = $this->config->item('conf_pagina');
        $this->login   = $this->session->userdata('login');
    }

    public function index(){
        $this->load->view('seguridad/inicio');
    }
    
    public function listar($j=0){
        $filter           = new stdClass();
        $filter->rol      = $this->session->userdata('rolusu');	
        $filter->order_by = array("m.MENU_Orden"=>"asc");
        $menu       = get_menu($filter);
        $filter     = new stdClass();
        if(isset($_SESSION["codcurso"]) && $_SESSION["codcurso"]!=0)  $filter->curso = $_SESSION["codcurso"];       
        $filter_not = new stdClass(); 
        $filter->order_by    = array("p.PROD_Nombre"=>"asc");
        $registros = count($this->curso_model->listar($filter,$filter_not));
        $productos = $this->curso_model->listar($filter,$filter_not,$this->configuracion['per_page'],$j);
        $item      = 1;
        $lista     = array();
        if(count($productos)>0){
            foreach($productos as $indice=>$valor){
                $filter       = new stdClass();
                $filter->tipo = $valor->TIPPROD_Codigo;
                $tipo       = $this->tipoproducto_model->obtener($filter);  
                $lista[$indice]             = new stdClass();
                $lista[$indice]->codigo     = $valor->PROD_Codigo;
                $lista[$indice]->nombre     = $valor->PROD_Nombre;
                $lista[$indice]->estado     = $valor->PROD_FlagEstado;
                $lista[$indice]->fechareg   = $valor->fechareg;
                $lista[$indice]->tipo       = $tipo->TIPPROD_Descripcion;
            }
        }
        $configuracion = $this->configuracion;
        $configuracion['base_url']    = base_url()."index.php/almacen/curso/listar";
        $configuracion['total_rows']  = $registros;
        $this->pagination->initialize($configuracion);
        /*Enviamos los datos a la vista*/       
        $data['lista']      = $lista;
        $data['menu']       = $menu;
        $data['header']     = get_header();        
        $data['registros']  = $registros;
        $data['j']          = $j;
        $data['paginacion'] = $this->pagination->create_links();
        $this->load->view('almacen/curso_index',$data);
    }

    public function editar($accion,$codigo=""){
        $lista = new stdClass();
        if($accion == "e"){
            $filter                = new stdClass();
            $filter->curso         = $codigo;
            $productos             = $this->curso_model->obtener($filter);
            $filter                = new stdClass();
            $filter->curso         = $codigo;
            $productoatributo      = $this->semana_model->listar($filter);
            $lista->producto       = $codigo;
            $lista->tipo           = $productos->TIPPROD_Codigo;
            $lista->nombre         = $productos->PROD_Nombre;  
            $lista->descripcion    = $productos->PROD_DescripcionBreve;  
            $lista->imagen         = $productos->PROD_Imagen==""?"no_disponible.jpg":$productos->PROD_Imagen;
            $lista->imagenpdf      = $productos->PROD_Silabus!=""?"pdf.png":"";  
            $lista->silabus        = $productos->PROD_Silabus;
            $lista->especificacion = $productos->PROD_EspecificacionPDF;  
            $lista->comentario     = $productos->PROD_Comentario;  
            $lista->cantidad       = $productos->PROD_Cantidad;  
            $lista->cargados       = count($productoatributo); 
            $lista->intentos       = $productos->PROD_Intentos;  
            $lista->tiempo         = $productos->PROD_Tiempo;  
            $lista->tiempoprueba   = $productos->PROD_TiempoExamen;  
            $lista->puntaje        = $productos->PROD_Puntaje;  
            $lista->estado         = $productos->PROD_FlagEstado;         
        }
        elseif($accion == "n"){
            $lista->producto       = "";
            $lista->tipo           = 0;
            $lista->nombre         = "";  
            $lista->descripcion    = "";  
            $lista->imagen         = "no_disponible.jpg";  
            $lista->imagenpdf      = "";  
            $lista->silabus        = "";
            $lista->especificacion = "";  
            $lista->comentario     = "";  
            $lista->cantidad       = "";  
            $lista->cargados       = "";
            $lista->tiempo         = 5;  
            $lista->tiempoprueba   = 30;
            $lista->intentos       = 5;  
            $lista->puntaje        = 14;
            $lista->estado         = 1; 
        }
        $arrEstado          = array("0"=>"::Seleccione::","1"=>"ACTIVO","2"=>"INACTIVO");
        $data['titulo']     = $accion=="e"?"Modificar Curso":"Nuevo Curso";
        $data['form_open']  = form_open(base_url()."index.php/almacen/curso/grabar",array("name"=>"frmBusqueda","id"=>"frmBusqueda","class"=>"formulario","enctype"=>"multipart/form-data"));
        $data['form_close'] = form_close();    
        $data['lista']	    = $lista;
        $data['selestado']  = form_dropdown('estado',$arrEstado,$lista->estado,"id='estado' class='comboMedio'");
        $data['seltipo']    = form_dropdown('tipoprod',$this->tipoproducto_model->seleccionar(),$lista->tipo,"id='tipoprod' class='comboMedio'");        
        $data['oculto']     = form_hidden(array('accion'=>$accion,'codigo'=>$codigo));
        $data['links']     = array("urlprod"=>base_url()."index.php/almacen/curso/editar/".$accion."/".$codigo,"urlatrib"=>base_url()."index.php/almacen/semana/listar/".$accion."/".$codigo,"urlcomp"=>"");
        $this->load->view('almacen/curso_nuevo',$data);
    }  
    
    public function grabar(){
        /*Grabamos formulario*/
        $mensaje = array("subimage"=>false,"subarchivo"=>false);        
        $accion = $this->input->get_post('accion');
        $codigo = $this->input->get_post('codigo');
        $data   = array(
                        "PROD_Nombre"            => ($this->input->post('nombre')),
                        "PROD_DescripcionBreve"  => ($this->input->post('descripcion')),
                        "PROD_EspecificacionPDF" => ($this->input->post('pdf')),
                        "PROD_Comentario"        => ($this->input->post('comentario')),
                        "PROD_Cantidad"          => ($this->input->post('cantidad')),
                        "PROD_Intentos"          => ($this->input->post('intentos')),
                        "PROD_Tiempo"            => ($this->input->post('tiempo')),
                        "PROD_Puntaje"           => ($this->input->post('puntaje')),
                        "TIPPROD_Codigo"         => ($this->input->post('tipoprod')),
                        "PROD_FlagEstado"        => ($this->input->post('estado')),
                        "PROD_TiempoExamen"      => ($this->input->post('tiempoprueba'))
                       );     
        /*Subimos imagen*/
        if(isset($_FILES['imagen']['name']) && trim($_FILES['imagen']['name'])!=""){
            //$upload_folder  = "D:/Dropbox/script/php/puertosaber/img";
            $upload_folder  = "img";
            $nombre_archivo = $_FILES["imagen"]["name"];
            $tmp_archivo    = $_FILES["imagen"]["tmp_name"];
            $archivador     = $upload_folder."/".$nombre_archivo;
            $mensaje["subimage"] = true;
            if (!move_uploaded_file($tmp_archivo, $archivador)) {
                $mensaje["subimage"] = false;
            }
            $data["PROD_Imagen"] = $nombre_archivo;
        }
        /*Subimos archivo*/
        if(isset($_FILES['archivo']['name']) && trim($_FILES['archivo']['name'])!=""){
            $upload_folder  = "files";
            $nombre_archivo = $_FILES["archivo"]["name"];
            $tmp_archivo    = $_FILES["archivo"]["tmp_name"];
            $archivador     = $upload_folder."/".$nombre_archivo;
            $mensaje["subarchivo"] = true;
            if (!move_uploaded_file($tmp_archivo, $archivador)) {
                $mensaje["subarchivo"] = false;
            }
            $data["PROD_Silabus"] = $nombre_archivo;
        }
        if($accion == "n"){
            $this->curso_model->insertar($data);
        }
        elseif($accion == "e"){
            $data['PROD_FechaModificacion'] = date("Y-m-d H:i:s",time());
            $this->curso_model->modificar($codigo,$data);
        }
        //echo json_encode($mensaje);
		echo "<script>alert('Operacion realizada con exito.');location.href='".base_url()."index.php/almacen/curso/listar';</script>";
    }
    
    public function eliminar(){
        $codigo = $this->input->post('codigo');
        $filter = new stdClass();
        $filter->curso = $codigo;
        //$videos = $this->semana_model->listar($filter);
        $resultado = false;
        //if(count($videos)==0){
            $resultado = true;
            $this->curso_model->eliminar($codigo);
        //}
        echo json_encode($resultado);
    } 

    public function obtener(){
        $obj    = $this->input->post('objeto');
        $filter = json_decode($obj);
        $profesores  = $this->curso_model->listar($filter);
        $resultado = json_encode($profesores);
        echo $resultado;
    }    
    
    public function export_excel($type){
            if($this->session->userdata('data_'.$type)){
                $result = $this->session->userdata('data_'.$type);
                switch ($type) {
                    case 'stock_productos':
                        $arr_columns = array();
                        $arr_export_detalle = array();
                        $arr_columns[]['STRING'] = 'CODIGO';
                        $arr_columns[]['STRING'] = 'ALMACEN';
                        $arr_columns[]['STRING'] = 'MATERIAL';
                        $arr_columns[]['STRING'] = 'LINEA';
                        $arr_columns[]['STRING'] = 'PRODUCTO';
                        $arr_columns[]['NUMERIC'] = 'PESO';
                        $arr_columns[]['STRING'] = 'UNIDAD';
                        $arr_columns[]['NUMERIC'] = 'STOCK ACTUAL';
                        $arr_columns[]['NUMERIC'] = 'STOCK COMPROM';
                        $arr_columns[]['NUMERIC'] = 'STOCK TRANS';
                        $arr_columns[]['NUMERIC'] = 'STOCK DISPONIBLE';
                        
                        $arr_group = array('H5:K5'=>'STOCK');
                        $this->reports_model->rpt_general('rpt_'.$type,'Stock_Productos', $arr_columns, $result["rows"],$arr_group);
                        break;         
                    case 'detalle_stock':
                        $arr_columns = array();
                        $arr_export_detalle = array();
                        $arr_columns[]['STRING'] = 'Fecha';
                        $arr_columns[]['STRING'] = 'Tipo_Mov';
                        $arr_columns[]['STRING'] = 'Documento';
                        $arr_columns[]['STRING'] = 'Numero';
                        $arr_columns[]['NUMERIC'] = 'Ingreso';
                        $arr_columns[]['NUMERIC'] = 'Salida';
                        $arr_columns[]['NUMERIC'] = 'Saldo';
                        $arr_columns[]['STRING'] = 'OT';
                        $arr_columns[]['STRING'] = 'REQUIRIMIENTO';
                        $arr_group = array();
                        $this->reports_model->rpt_general('rpt_'.$type,'Detalle de Producto',$arr_columns,$result["rows"],$arr_group);                          
                        break;
                    
                    case 'stock_comprometido':
                        
                        $arr_columns = array();
                        $arr_export_detalle = array();
                        $arr_columns[]['STRING']='NUM.REQ';
                        $arr_columns[]['STRING']='FECHA';
                        $arr_columns[]['STRING']='NROOT';		
                        $arr_columns[]['STRING']='CODRES';
                        $arr_columns[]['STRING']='APROBADO';
                        $arr_columns[]['STRING']='USERAPROB';
                        $arr_columns[]['NUMERIC']='CANTIDAD';
                        $arr_columns[]['NUMERIC']='CANTIDAD V.S.</td>';
                        $arr_columns[]['NUMERIC']='STOCK COMPROM.';
                        $arr_columns[]['STRING']='FECHA V.S.';
                        $arr_columns[]['STRING']='NUMERO V.S.';
                        $arr_columns[]['STRING']='VALUSER';
                        $arr_group = array();
                        $this->reports_model->rpt_general('rpt_'.$type,'Detalle de Stock Comprometido',$arr_columns,$result["rows"],$arr_group);                          
                        break;
                    
                    case 'stock_transito':
                        $arr_columns[]['STRING']='FECHA OC';
                        $arr_columns[]['STRING']='NUM OC';
                        $arr_columns[]['NUMERIC']='CANT. OC';		
                        $arr_columns[]['STRING']='FECHA NEA';
                        $arr_columns[]['STRING']='NUM. NEA';
                        $arr_columns[]['NUMERIC']='CANT. NEA';
                        $arr_columns[]['NUMERIC']='STOCK TRANS.';
                        $arr_group = array();
                        $this->reports_model->rpt_general('rpt_'.$type,'Detalle de Stock Transito',$arr_columns,$result["rows"],$arr_group);                          
                        break;
                }
            }
            else{
                echo "<div style='color:rgb(150,150,150);padding:10px;width:560px;height:160px;border:1px solid rgb(210,210,210);'>
                No hay datos para exportar
                </div>";
            }
        }
}
?>