<?php header("Content-type: text/html; charset=utf-8"); 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Empresa extends CI_Controller
{
    public $configuracion;
    public $codigo;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('maestros/empresa_model');
        $this->load->model('maestros/sector_model');
        $this->load->model('seguridad/permiso_model');
        $this->load->helper('menu');
    }
    public function listar($j=0){
        $filter           = new stdClass();
        $filter->rol      = $this->session->userdata('rolusu');		
        $filter->order_by = array("m.MENU_Orden"=>"asc");
        $menu       = get_menu($filter);  
        $filter     = new stdClass();
        $filter_not = new stdClass();
        $registros = count($this->empresa_model->listar($filter));
        $empresas  = $this->empresa_model->listar($filter,$filter_not,$this->configuracion['per_page'],$j);
        $item      = 1;
        $lista     = array();
        if(count($empresas)>0){
            foreach($empresas as $indice => $value){
                $lista[$indice]             = new stdClass();
                $lista[$indice]->codigo   = $value->EMPRP_Codigo;
                $lista[$indice]->ruc      = $value->EMPRC_Ruc;
                $lista[$indice]->rsocial  = $value->EMPRC_RazonSocial;
                $lista[$indice]->telefono  = $value->EMPRC_Telefono;
                $lista[$indice]->movil     = $value->EMPRC_Movil;
                $lista[$indice]->fax       = $value->EMPRC_Fax;
                $lista[$indice]->web       = $value->EMPRC_Web;
                $lista[$indice]->email     = $value->EMPRC_Email;
                $lista[$indice]->estado    = $value->EMPRC_FlagEstado;
                $lista[$indice]->sector    = $value->SECTORC_Descripcion;
            }
        }
        $configuracion = $this->configuracion;
        $configuracion['base_url']    = base_url()."index.php/maestros/empresa/listar";
        $configuracion['total_rows']  = $registros;
        $this->pagination->initialize($configuracion);
        /*Enviamos los datos a la vista*/
        $data['lista']           = $lista;
        $data['menu']            = $menu;
        $data['header']          = get_header();
        $data['titulo']          = "Listado de Empresas";
        $data['nuevo']           = "Crear una nueva Empresa";      
        $data['registros']       = $registros;
        $data['paginacion']      = $this->pagination->create_links();
        $this->load->view("maestros/empresa_index",$data);
    }

    public function editar($accion,$codigo=""){
         $lista = new stdClass();
         if($accion == "e"){
             $filter             = new stdClass();
             $filter->empresa    = $codigo;
             $empresas           = $this->empresa_model->obtener($filter);
             $lista->codigo      = $empresas->EMPRP_Codigo;
             $lista->sector      = $empresas->SECTORP_Codigo;
             $lista->ruc         = $empresas->EMPRC_Ruc;
             $lista->rsocial     = $empresas->EMPRC_RazonSocial;
             $lista->telefono    = $empresas->EMPRC_Telefono;
             $lista->movil       = $empresas->EMPRC_Movil;
             $lista->fax         = $empresas->EMPRC_Fax;
             $lista->web         = $empresas->EMPRC_Web;
             $lista->email       = $empresas->EMPRC_Email;
             $lista->direccion   = $empresas->EMPRC_Direccion;
             $lista->estado      = $empresas->EMPRC_FlagEstado;
         }
         elseif($accion == "n"){
             $lista->codigo  = "";
             $lista->sector    = "";
             $lista->ruc       = "";
             $lista->rsocial   = "";
             $lista->telefono  = "";
             $lista->movil     = "";
             $lista->fax       = "";
             $lista->web       = "";
             $lista->email     = "";
             $lista->direccion = "";
             $lista->estado    = "";
         }
         $arrEstado          = array("0"=>"::Seleccione::","1"=>"ACTIVO","2"=>"INACTIVO");
         $data['titulo']     = $accion=="e"?"Editar Empresa":"Crear Empresa";
         $data['form_open']  = form_open('',array("name"=>"frmEmpresa","id"=>"frmEmpresa","onsubmit"=>"return valida_guiain();"));
         $data['form_close'] = form_close();
         $data['lista']	     = $lista;
         $data['selestado']  = form_dropdown('estado',$arrEstado,$lista->estado,"id='estado' class='comboMedio'");
         $data['selsector']  = form_dropdown('sector',$this->sector_model->seleccionar('0'),$lista->sector,"id='sector' class='comboMedio'");
         $data['oculto']     = form_hidden(array("accion"=>$accion,"codigo_padre"=>$codigo,"codigo"=>$lista->codigo));
         $this->load->view("maestros/empresa_nueva",$data);
     }

    public function grabar(){
        $accion = $this->input->get_post('accion');
        $codigo = $this->input->get_post('codigo');
        $data   = array(
                        "EMPRC_Ruc"         => $this->input->post('ruc'),
                        "EMPRC_RazonSocial" => $this->input->post('rsocial'),
                        "SECTORP_Codigo"    => $this->input->post('sector'),
                        "EMPRC_Telefono"    => $this->input->post('telefono'),
                        "EMPRC_Movil"       => $this->input->post('movil'),
                        "EMPRC_Fax"         => $this->input->post('fax'),
                        "EMPRC_Web"         => $this->input->post('web'),
                        "EMPRC_Email"       => $this->input->post('email'),
                        "EMPRC_Direccion"   => $this->input->post('direccion'),
                        "EMPRC_FlagEstado"  => $this->input->post('estado')
                       );
        if($accion == "n"){
            $this->codigo = $this->empresa_model->insertar($data);
        }
        elseif($accion == "e"){
            $this->empresa_model->modificar($codigo,$data);
        }
    }     
     
    public function obtener($codigo=""){
        $obj    = $this->input->post('objeto');
        $filter = json_decode($obj);
        $locales  = $this->local_model->listar($filter);
        $resultado = json_encode($locales);
        echo $resultado;
    }

    public function eliminar()
    {
        $obj    = $this->input->post('objeto');
        $filter = json_decode($obj);        
        $this->empresa_model->eliminar($filter);
        $resultado = true;
        echo json_encode($resultado);  
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
        $data['registros']      = count($this->local_model->buscar($filter));
        $conf['base_url']       = site_url('maestros/almacen/buscar/');
        $conf['total_rows']     = $data['registros'];
        $conf['per_page']       = 10;
        $conf['num_links']      = 3;
        $conf['first_link']     = "&lt;&lt;";
        $conf['last_link']      = "&gt;&gt;";
        $offset                 = (int)$this->uri->segment(4);
        $listado                = $this->local_model->buscar($filter,$conf['per_page'],$offset);
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
        $this->load->view('maestros/local_index',$data);
    }
}
?>