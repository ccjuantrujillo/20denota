<?php
class Ciclo extends CI_Controller
{
    public $configuracion;
    public $codigo;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('maestros/ciclo_model');
        $this->load->model('seguridad/permiso_model');
        $this->somevar['compania'] = $this->session->userdata('compania');
    }
    public function listar($j=0){
        $filter           = new stdClass();
        $filter->rol      = $this->session->userdata('rolusu');		
        $filter->order_by = array("p.MENU_Codigo"=>"asc");
        $menu  = $this->permiso_model->listar($filter);  
        $filter     = new stdClass();
        $filter_not = new stdClass();
        $filter_not->persona = "0";
//        $filter->order_by    = array("p.PERSC_ApellidoPaterno"=>"asc","p.PERSC_ApellidoMaterno"=>"asc","p.PERSC_Nombre"=>"asc");
        $registros = count($this->ciclo_model->listar($filter,$filter_not));
        $personas  = $this->ciclo_model->listar($filter,$filter_not,$this->configuracion['per_page'],$j);
        $item      = 1;
        $lista     = array();
        if(count($personas)>0){
            foreach($personas as $indice => $value){
                $lista[$indice]         = new stdClass();
                $lista[$indice]->codigo = $value->CICLOP_Codigo;
                $lista[$indice]->nombre = $value->COMPC_Nombre;
                $lista[$indice]->fecha_inicio = date_sql(substr($value->CICC_FECHA_INICIO,0,10));
                $lista[$indice]->fecha_fin    = date_sql(substr($value->CICC_FECHA_FIN,0,10));
                $lista[$indice]->descripcion  = $value->CICC_DESCRIPCION;
            }
        }
        $configuracion = $this->configuracion;
        $configuracion['base_url']    = base_url()."index.php/maestros/persona/listar";
        $configuracion['total_rows']  = $registros;
        $this->pagination->initialize($configuracion);
        /*Enviamos los datos a la vista*/
        $data['lista']           = $lista;
        $data['menu']            = $menu;
        $data['j']               = $j;
        $data['registros']       = $registros;
        $data['paginacion']      = $this->pagination->create_links();
        $this->load->view("maestros/ciclo_index",$data);
    }

     public function editar($accion,$codigo=""){
         $lista = new stdClass();
         if($accion == "e"){
             $filter             = new stdClass();
             $filter->ciclo      = $codigo;
             $ciclos             = $this->ciclo_model->obtener($filter);
             $lista->finicio     = date_sql(substr($ciclos->CICC_FECHA_INICIO,0,10));
             $lista->ffin        = date_sql(substr($ciclos->CICC_FECHA_FIN,0,10));
             $lista->descripcion = $ciclos->CICC_DESCRIPCION;
             $lista->codigo      = $ciclos->CICLOP_Codigo;
             $lista->nombre      = $ciclos->COMPC_Nombre;
         }
         elseif($accion == "n"){
             $lista->finicio     = "";
             $lista->ffin        = "";
             $lista->descripcion = "";
             $lista->codigo      = "";
             $lista->nombre      = "";
         }
         $arrSexo            = array("0"=>"::Seleccione::","1"=>"MASCULINO","2"=>"FEMENINO");
         $arrEstado          = array("0"=>"::Seleccione::","1"=>"ACTIVO","2"=>"INACTIVO");
         $data['titulo']     = $accion=="e"?"Editar Ciclo":"Crear Ciclo";
         $data['form_open']  = form_open('',array("name"=>"frmPersona","id"=>"frmPersona","onsubmit"=>"return valida_guiain();"));
         $data['form_close'] = form_close();
         $data['lista']	     = $lista;
         $data['oculto']     = form_hidden(array("accion"=>$accion,"codigo_padre"=>$codigo,"codigo"=>$lista->codigo));
         $this->load->view("maestros/ciclo_nuevo",$data);
    }
     
    public function grabar(){
        $accion      = $this->input->get_post('accion');
        $codigo      = $this->input->get_post('codigo');
        $data   = array(
                        "COMPC_Nombre" => strtoupper($this->input->post('nombre')),
                        "CICC_FECHA_INICIO" => date_sql_ret($this->input->post('finicio')),
                        "CICC_FECHA_FIN"    => date_sql_ret($this->input->post('ffin')),
                        "CICC_DESCRIPCION"  => strtoupper($this->input->post('descripcion'))
                       );
        if($accion == "n"){
            $this->codigo = $this->ciclo_model->insertar($data);
        }
        elseif($accion == "e"){
            $this->ciclo_model->modificar($codigo,$data);

        }
    }
    
    public function eliminar()
    {
        $codigo  = $this->input->post('codigo');
        $this->ciclo_model->eliminar($codigo);
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
}
?>