<?php header("Content-type: text/html; charset=utf-8"); 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//require_once "Spreadsheet/Excel/Writer.php";

class Cursotipoestudio extends CI_Controller {
    var $compania;
    var $configuracion;
    public function __construct(){
        parent::__construct();
        if(!isset($_SESSION['login'])) die("Sesion terminada. <a href='".  base_url()."'>Registrarse e ingresar.</a> ");        
        $this->load->model(almacen.'curso_model');        
        $this->load->model(almacen.'cursociclo_model');
        $this->load->model(almacen.'cursotipoestudio_model');
        $this->load->model(almacen.'semana_model');
        $this->load->model(maestros.'persona_model');
        $this->load->model(maestros.'ciclo_model');
        $this->load->model(maestros.'tipoestudio_model');
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
        $filter_not = new stdClass(); 
        $filter->order_by    = array("f.COMPC_Nombre"=>"desc","e.PROD_Nombre"=>"asc");
        $registros = count($this->cursotipoestudio_model->listar($filter,$filter_not));
        $cursotipoestudios = $this->cursotipoestudio_model->listar($filter,$filter_not,$this->configuracion['per_page'],$j);
        $item      = 1;
        $lista     = array();
        if(count($cursotipoestudios)>0){
            foreach($cursotipoestudios as $indice=>$valor){
                $lista[$indice]              = new stdClass();
                $lista[$indice]->codigo      = $valor->CURSOTIPOP_Codigo;
                $lista[$indice]->ciclo       = $valor->COMPC_Nombre;
                $lista[$indice]->curso       = $valor->PROD_Nombre;
                $lista[$indice]->tipoestudio = $valor->TIPC_Nombre;
                $lista[$indice]->estado      = $valor->CURSOTIPOC_FlagEstado;
                $lista[$indice]->fechareg    = $valor->fechareg;
            }
        }
        $configuracion = $this->configuracion;
        $configuracion['base_url']    = base_url()."index.php/almacen/curso/listar";
        $configuracion['total_rows']  = $registros;
        $this->pagination->initialize($configuracion);
        /*Enviamos los datos a la vista*/  
        $data['titulo']     = "Listar Cursos por Tipo Estudio";
        $data['lista']      = $lista;
        $data['menu']       = $menu;
        $data['header']          = get_header();        
        $data['registros']  = $registros;
        $data['j']          = $j;
        $data['paginacion'] = $this->pagination->create_links();
        $this->load->view('almacen/cursotipoestudio_index',$data);
    }

    public function editar($accion,$codigo=""){
        $ciclo = $this->input->get_post('ciclo'); 
        $lista = new stdClass();
        if($accion == "e"){
            $filter             = new stdClass();
            $filter->cursotipoestudio = $codigo;
            $cursotipoestudio         = $this->cursotipoestudio_model->obtener($filter);
            $lista->cursotipoestudio = $codigo;
            $lista->curso            = $cursotipoestudio->PROD_Codigo;  
            $lista->ciclo            = $ciclo!=""?$ciclo:$cursotipoestudio->CICLOP_Codigo;        
            $lista->cursociclo       = $cursotipoestudio->CURSOCIP_Codigo; 
            $lista->tipoestudio      = $cursotipoestudio->TIPP_Codigo;        
            $lista->estado           = $cursotipoestudio->CURSOTIPOC_FlagEstado;  
        }
        elseif($accion == "n"){
            $lista->cursotipoestudio = "";
            $lista->curso            = "";
            $lista->ciclo            = $ciclo;
            $lista->cursociclo       = 0;
            $lista->tipoestudio      = "";
            $lista->estado           = 1; 
        }
        $filter = new stdClass();
        $filter->ciclo = $lista->ciclo;
        $ciclos = $this->ciclo_model->obtener($filter);
        $lista->tipociclo   = isset($ciclos->TIPOCICLOP_Codigo)?$ciclos->TIPOCICLOP_Codigo:0;
        $arrEstado          = array("0"=>"::Seleccione::","1"=>"ACTIVO","2"=>"INACTIVO");
        $data['titulo']     = $accion=="e"?"Modificar Curso por Tipo de estudio":"Nuevo Curso por Tipo de estudio";
        $data['form_open']  = form_open("",array("name"=>"frmPersona","id"=>"frmPersona","class"=>"formulario"));
        $data['form_close'] = form_close();    
        $data['lista']	    = $lista;
        $data['selestado']  = form_dropdown('estado',$arrEstado,$lista->estado,"id='estado' class='comboMedio'");
        $data['selcurso']   = form_dropdown('curso',$this->curso_model->seleccionar('0'),$lista->curso,"id='curso' class='comboMedio'");        
        $filter = new stdClass();
        $filter->ciclo = $lista->ciclo;
        $data['selcursociclo']  = form_dropdown('cursociclo',$this->cursociclo_model->seleccionar('0',$filter),$lista->cursociclo,"id='cursociclo' class='comboMedio'"); 
        $data['selciclo']       = form_dropdown('ciclo',$this->ciclo_model->seleccionar('0'),$lista->ciclo,"id='ciclo' class='comboMedio'");        
        $filter = new stdClass();
        $filter->tipociclo = $lista->tipociclo;        
        $data['seltipoestudio'] = form_dropdown('tipoestudio',$this->tipoestudio_model->seleccionar('0',$filter),$lista->tipoestudio,"id='tipoestudio' class='comboMedio'"); 
        $data['oculto']         = form_hidden(array('accion'=>$accion,'codigo'=>$codigo));
        $this->load->view('almacen/cursotipoestudio_nuevo',$data);
    }  
    
    public function grabar(){
        $accion = $this->input->get_post('accion');
        $codigo = $this->input->get_post('codigo');
        $data   = array(
                        "CURSOCIP_Codigo"       => $this->input->post('cursociclo'),
                        "TIPP_Codigo"           => $this->input->post('tipoestudio'),
                        "CURSOTIPOC_FlagEstado" => $this->input->post('estado')
                       );
        if($accion == "n"){
            $this->cursotipoestudio_model->insertar($data);
        }
        elseif($accion == "e"){
            $this->cursotipoestudio_model->modificar($codigo,$data);
        }
    }
    
    public function eliminar(){
        $codigo = $this->input->post('codigo');
        $filter = new stdClass();
        $filter->cursotipoestudio = $codigo;
        $resultado = true;
        $this->cursotipoestudio_model->eliminar($filter);
        echo json_encode($resultado);
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