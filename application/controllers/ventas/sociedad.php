<?php header("Content-type: text/html; charset=utf-8"); 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sociedad extends CI_Controller
{
    public $configuracion;
    public $codigo;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ventas/estudios_model');
        $this->load->model('seguridad/permiso_model');
        $this->load->model(maestros.'universidad_model');        
        $this->load->model(maestros.'grado_model');         
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
        $registros = count($this->estudios_model->listar($filter,$filter_not));
        $personas  = $this->estudios_model->listar($filter,$filter_not,$this->configuracion['per_page'],$j);
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
                $lista[$indice]->tipociclo    = $value->TIPOCICLOC_Descripcion;
                $lista[$indice]->estado       = $value->COMPC_FlagEstado;
            }
        }
        $configuracion = $this->configuracion;
        $configuracion['base_url']    = base_url()."index.php/ventas/estudios/listar";
        $configuracion['total_rows']  = $registros;
        $this->pagination->initialize($configuracion);
        /*Enviamos los datos a la vista*/
        $data['lista']           = $lista;
        $data['menu']            = $menu;
        $data['header']          = get_header();
        $data['j']               = $j;
        $data['registros']       = $registros;
        $data['paginacion']      = $this->pagination->create_links();
        $this->load->view("ventas/sociedad_index",$data);
    }
    
     public function editar($accion,$codigo=""){
         $lista = new stdClass();
         $data  = array();
         if($accion == "e"){
             $filter            = new stdClass();
             $filter->profesor  = $codigo;
             $profesores        = $this->profesor_model->obtener($filter);
             $filter = new stdClass();
             $filter->profesor = $codigo;
             $lista->sociedades = $this->profesorsociedad_model->listar($filter);              
         }
         elseif($accion == "n"){
             $lista->sociedades   = array();  
         }     
         $arrMes             = array("00"=>"Mes","01"=>"Enero","02"=>"Febrero","03"=>"Marzo","04"=>"Abril","05"=>"Mayo","06"=>"Junio","07"=>"Julio","08"=>"Agosto","09"=>"Setiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre");
         $arrAno[0]="Año";
         for($i=1950;$i<=2020;$i++)  $arrAno[$i]=$i;
         $data['arrmes']     = $arrMes;
         $data['selmesi']    = form_dropdown('mesi',$arrMes,0,"id='mesi' class='comboMedio'");
         $data['selmesf']    = form_dropdown('mesf',$arrMes,0,"id='mesf' class='comboMedio'");
         $data['selanoi']    = form_dropdown('anoi',$arrAno,0,"id='anoi' class='comboMedio'");
         $data['selanof']    = form_dropdown('anof',$arrAno,0,"id='anof' class='comboMedio'");   
         $data['seluniversidad'] = form_dropdown('universidad',$this->universidad_model->seleccionar('0'),0,"id='universidad' class='comboGrande'");
         $data['selgrado']       = form_dropdown('grado',$this->grado_model->seleccionar('0'),0,"id='grado' class='comboMedio'");           
         $data['lista']          = $lista;
         $this->load->view("ventas/sociedad_nuevo",$data);
    }
     
    public function grabar(){
        $accion      = $this->input->get_post('accion');
        $codigo      = $this->input->get_post('codigo');
        $data   = array(
                        "PROP_Codigo"          => ($this->input->post('profesor')),
                        "UNIVP_Codigo"         => ($this->input->post('unversidad')),
                        "GRADOP_Codigo"        => ($this->input->post('grado')),
                        "ESTUDIOC_Descripcion" => ($this->input->post('descripcion')),
                        "ESTUDIOC_Estado"      => ($this->input->post('estado')),
                        "ESTUDIOC_MesInicio"   => ($this->input->post('mesi')),
                        "ESTUDIOC_MesFin"      => ($this->input->post('mesf')),
                        "ESTUDIOC_AnoInicio"   => ($this->input->post('anoi')),
                        "ESTUDIOC_AnoFin"      => ($this->input->post('anof'))
                       );
        if($accion == "n"){
            $this->codigo = $this->estudios_model->insertar($data);
        }
        elseif($accion == "e"){
            $this->estudios_model->modificar($codigo,$data);
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