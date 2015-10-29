<?php header("Content-type: text/html; charset=utf-8"); 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tipoestudio extends CI_Controller
{
    public $configuracion;
    public $codigo;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('maestros/tipoestudio_model');
        $this->load->model('maestros/tipociclo_model');
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
        $filter->order_by    = array("c.TIPP_Codigo"=>"asc");
        $registros = count($this->tipoestudio_model->listar($filter,$filter_not));
        $tipoestudios  = $this->tipoestudio_model->listar($filter,$filter_not,$this->configuracion['per_page'],$j);
        $item      = 1;
        $lista     = array();
        if(count($tipoestudios)>0){
            foreach($tipoestudios as $indice => $value){
                $lista[$indice]              = new stdClass();
                $lista[$indice]->codigo      = $value->TIPP_Codigo;
                $lista[$indice]->nombre      = $value->TIPC_Nombre;
                $lista[$indice]->descripcion = $value->TIPC_Descripcion;
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
        $this->load->view("maestros/tipoestudio_index",$data);
    }
    
    public function editar($accion,$codigo=""){
         $lista = new stdClass();
         if($accion == "e"){
             $filter              = new stdClass();
             $filter->tipoestudio = $codigo;
             $tiposeestudio       = $this->tipoestudio_model->obtener($filter);
             $lista->codigo       = $tiposeestudio->TIPP_Codigo;
             $lista->nombre       = $tiposeestudio->TIPC_Nombre;
             $lista->descripcion  = $tiposeestudio->TIPC_Descripcion;
         }
         elseif($accion == "n"){
             $lista->codigo      = "";
             $lista->nombre      = "";
             $lista->descripcion = "";
         }
         $data['titulo']     = $accion=="e"?"Editar Tipo de Estudio":"Crear Tipo de Estudio";
         $data['form_open']  = form_open('',array("name"=>"frmPersona","id"=>"frmPersona","onsubmit"=>"return valida_guiain();"));
         $data['form_close'] = form_close();
         $data['lista']	     = $lista;
         $data['oculto']     = form_hidden(array("accion"=>$accion,"codigo_padre"=>$codigo,"codigo"=>$lista->codigo));
         $this->load->view("maestros/tipoestudio_nuevo",$data);
     }
    
    public function grabar(){
        $accion      = $this->input->get_post('accion');
        $codigo      = $this->input->get_post('codigo');
        $data   = array(
                        "TIPC_Nombre"       => ($this->input->post('nombre')),
                        "TIPC_Descripcion"  => ($this->input->post('descripcion'))
                       );
        if($accion == "n"){
            $this->codigo = $this->tipoestudio_model->insertar($data);
        }
        elseif($accion == "e"){
            $this->tipoestudio_model->modificar($codigo,$data);
        }
    }
    
    public function eliminar()
    {
        $codigo  = $this->input->post('codigo');
        $this->tipoestudio_model->eliminar($codigo);
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

    public function buscar($j=0)
    {

        $nombre_fabricante = $this->input->post('nombre_fabricante');
        $filter = new stdClass();
        $filter->FABRIC_Descripcion = $nombre_fabricante;
        $data['registros']      = count($this->aula_model->buscar($filter));
        $conf['base_url']       = site_url('maestros/almacen/buscar/');
        $conf['total_rows']     = $data['registros'];
        $conf['per_page']       = 10;
        $conf['num_links']      = 3;
        $conf['first_link']     = "&lt;&lt;";
        $conf['last_link']      = "&gt;&gt;";
        $offset                 = (int)$this->uri->segment(4);
        $listado                = $this->aula_model->buscar($filter,$conf['per_page'],$offset);
        $item                   = $j+1;
        $lista                  = array();
        if(count($listado)>0){
            foreach($listado as $indice=>$valor){
                $codigo       = $valor->FABRIP_Codigo;
                $editar       = "<a href='#' onclick='editar_fabricante(".$codigo.")' target='_parent'><img src='".base_url()."images/modificar.png' width='16' height='16' border='0' title='Modificar'></a>";
                $ver          = "<a href='#' onclick='ver_fabricante(".$codigo.")' target='_parent'><img src='".base_url()."images/ver.png' width='16' height='16' border='0' title='Modificar'></a>";
                $eliminar     = "<a href='#' onclick='eliminar_fabricante(".$codigo.")' target='_parent'><img src='".base_url()."images/eliminar.png' width='16' height='16' border='0' title='Modificar'></a>";
                $lista[]      = array($item++,$valor->FABRIC_Descripcion,$valor->FABRIC_CodigoUsuario,$editar,$ver,$eliminar);
            }
        }
        $data['titulo_tabla']    = "RESULTADO DE BUSQUEDA de FABRICANTES";
        $data['titulo_busqueda'] = "BUSCAR FABRICANTE";
        $data['nombre_fabricante']  = form_input(array( 'name'  => 'nombre_fabricante','id' => 'nombre_fabricante','value' => $nombre_fabricante,'maxlength' => '100','class' => 'cajaMedia'));
        $data['form_open']       = form_open(base_url().'index.php/almacen/fabricante/buscar',array("name"=>"form_busquedaFabricante","id"=>"form_busquedaFabricante"));
        $data['form_close']      = form_close();
        $data['lista']           = $lista;
        $data['oculto']          = form_hidden(array('base_url'=>base_url()));
        $this->pagination->initialize($conf);
        $data['paginacion'] = $this->pagination->create_links();
        $this->load->view('maestros/aula_index',$data);
    }
    
    public function obtener($codigo=""){
        $obj    = $this->input->post('objeto');
        $filter = json_decode($obj);
        $tipoestudios  = $this->tipoestudio_model->listar($filter);
        $resultado = json_encode($tipoestudios);
        echo $resultado;
    }    
}
?>