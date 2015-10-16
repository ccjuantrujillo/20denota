<?php header("Content-type: text/html; charset=utf-8"); 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tipoestudiociclo extends CI_Controller
{
    public $configuracion;
    public $codigo;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('maestros/tipoestudio_model');
        $this->load->model('maestros/tipoestudiociclo_model');
        $this->load->model('maestros/ciclo_model');
        $this->load->model('seguridad/permiso_model');
        $this->load->helper('menu');
        $this->somevar['compania'] = $this->session->userdata('compania');
    }
    public function listar($j=0){
        $filter           = new stdClass();
        $filter->rol      = $this->session->userdata('rolusu');		
        $filter->order_by = array("m.MENU_Orden"=>"asc");
        $menu       = get_menu($filter);  
        $filter     = new stdClass();
        $filter_not = new stdClass();
        $filter_not->persona = "0";
        $filter->order_by    = array("d.COMPC_Nombre"=>"desc","e.TIPC_Nombre"=>"asc");
        $registros = count($this->tipoestudiociclo_model->listar($filter,$filter_not));
        $tipoestudiosciclo  = $this->tipoestudiociclo_model->listar($filter,$filter_not,$this->configuracion['per_page'],$j);
        $item      = 1;
        $lista     = array();
        if(count($tipoestudiosciclo)>0){
            foreach($tipoestudiosciclo as $indice => $value){
                $lista[$indice]              = new stdClass();
                $lista[$indice]->codigo      = $value->TIPCICLOP_Codigo;
                $lista[$indice]->nombre      = $value->TIPC_Nombre;
                $lista[$indice]->ciclo       = $value->COMPC_Nombre;
                $lista[$indice]->descripcion = $value->TIPC_Descripcion;
                $lista[$indice]->estado      = $value->TIPCICLOC_FlagEstado;
            }
        }
        $configuracion = $this->configuracion;
        $configuracion['base_url']    = base_url()."index.php/maestros/persona/listar";
        $configuracion['total_rows']  = $registros;
        $this->pagination->initialize($configuracion);
        /*Enviamos los datos a la vista*/
        $data['lista']           = $lista;
        $data['menu']            = $menu;
        $data['header']          = get_header();        
        $data['j']               = $j;
        $data['registros']       = $registros;
        $data['paginacion']      = $this->pagination->create_links();
        $this->load->view("maestros/tipoestudiociclo_index",$data);
    }
    
    public function editar($accion,$codigo=""){
         $lista = new stdClass();
         if($accion == "e"){
             $filter              = new stdClass();
             $filter->tipoestudiociclo = $codigo;
             $tiposeestudiociclo       = $this->tipoestudiociclo_model->obtener($filter);
             $lista->codigo            = $tiposeestudiociclo->TIPCICLOP_Codigo;
             $lista->observacion       = $tiposeestudiociclo->TIPCICLOC_Observacion;
             $lista->ciclo             = $tiposeestudiociclo->CICLOP_Codigo;
             $lista->estado            = $tiposeestudiociclo->TIPCICLOC_FlagEstado;
             $lista->tipoestudio       = $tiposeestudiociclo->TIPP_Codigo;
         }
         elseif($accion == "n"){
             $lista->codigo      = "";
             $lista->observacion = "";
             $lista->ciclo       = "";
             $lista->estado      = 1;
             $lista->tipoestudio = "";
         }
         $arrEstado          = array("0"=>"::Seleccione::","1"=>"ACTIVO","2"=>"INACTIVO");
         $data['titulo']     = $accion=="e"?"Editar Tipo de Estudio por ciclo":"Crear Tipo de Estudio por ciclo";
         $data['form_open']  = form_open('',array("name"=>"frmPersona","id"=>"frmPersona","onsubmit"=>"return valida_guiain();"));
         $data['form_close'] = form_close();
         $data['lista']	     = $lista;
         $data['selestado']  = form_dropdown('estado',$arrEstado,$lista->estado,"id='estado' class='comboMedio'");
         $data['selciclo']   = form_dropdown('ciclo',$this->ciclo_model->seleccionar('0'),$lista->ciclo,"id='ciclo' class='comboMedio'");      
         $data['seltipoestudio'] = form_dropdown('tipoestudio',$this->tipoestudio_model->seleccionar('0'),$lista->tipoestudio,"id='tipoestudio' class='comboMedio'"); 
         $data['oculto']     = form_hidden(array("accion"=>$accion,"codigo_padre"=>$codigo,"codigo"=>$lista->codigo));
         $this->load->view("maestros/tipoestudiociclo_nuevo",$data);
     }
    
    public function grabar(){
        $accion      = $this->input->get_post('accion');
        $codigo      = $this->input->get_post('codigo');
        $data   = array(
                        "TIPP_Codigo"    => ($this->input->post('tipoestudio')),
                        "CICLOP_Codigo"  => ($this->input->post('ciclo')),
                        "TIPCICLOC_Observacion" => ($this->input->post('observacion')),
                        "TIPCICLOC_FlagEstado"  => ($this->input->post('estado'))
                       );
        if($accion == "n"){
            $this->codigo = $this->tipoestudiociclo_model->insertar($data);
        }
        elseif($accion == "e"){
            $this->tipoestudiociclo_model->modificar($codigo,$data);
        }
    }
    
    public function eliminar()
    {
        $codigo  = $this->input->post('codigo');
        $this->tipoestudiociclo_model->eliminar($codigo);
    }
    
    public function ver($codigo)
    {

        $datos_fabricante       = $this->fabricante_model->obtener($codigo);
        $data['nombre_fabricante']= $datos_fabricante[0]->FABRIC_Descripcion;
        $data['fabricante']    = $datos_fabricante[0]->FABRIP_Codigo;
        $data['titulo']        = "VER FABRICANTE";
        $data['oculto']        = form_hidden(array('base_url'=>base_url()));
        $this->load->view('almacen/fabricante_ver',$data);
    }
    
    public function obtener(){
        $obj    = $this->input->post('objeto');
        $filter = json_decode($obj);
        $tipoestudios  = $this->tipoestudiociclo_model->listar($filter);
        $resultado = json_encode($tipoestudios);
        echo $resultado;
    }    
}
?>