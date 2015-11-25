<?php header("Content-type: text/html; charset=utf-8"); 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Estudio extends CI_Controller
{
    public $configuracion;
    public $codigo;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ventas/estudios_model');
        $this->load->model('seguridad/permiso_model');
        $this->load->helper('menu');
        $this->load->model(maestros.'universidad_model');        
        $this->load->model(maestros.'grado_model');           
        $this->somevar['compania'] = $this->session->userdata('compania');
    }
    public function listar($codigo){
         $lista  = new stdClass();
        $filter = new stdClass();
        $filter->profesor = $codigo;
        $lista->estudios = $this->estudios_model->listar($filter);    
        $lista->profesor  = $codigo;
         $arrMes             = array("00"=>"Mes","01"=>"Enero","02"=>"Febrero","03"=>"Marzo","04"=>"Abril","05"=>"Mayo","06"=>"Junio","07"=>"Julio","08"=>"Agosto","09"=>"Setiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre");
         $arrAno[0]="Año";
         for($i=1950;$i<=2020;$i++)  $arrAno[$i]=$i;
         $data['arrmes']     = $arrMes;  
         $data['lista']      = $lista;
         $this->load->view("ventas/estudios_index",$data);
    }
    
     public function editar($accion,$codigo=""){
         $lista  = new stdClass();
         $data   = array();
         if($accion == "e"){
             $filter = new stdClass();
             $filter->estudio = $codigo;
             $estudios = $this->estudios_model->obtener($filter);   
             $lista->universidadestudio = $estudios->UNIVP_Codigo;
             $lista->grado              = $estudios->GRADOP_Codigo;
             $lista->descripcion        = $estudios->ESTUDIOC_Descripcion;
             $lista->estado             = $estudios->UNIVP_Codigo;
             $arrFechai           = explode("-",$estudios->ESTUDIOC_FechaInicio);
             $arrFechaf           = explode("-",$estudios->ESTUDIOC_FechaFin);
             $lista->mesi         = $arrFechai[1];
             $lista->anoi         = $arrFechai[0];
             $lista->mesf         = $arrFechaf[1];
             $lista->anof         = $arrFechaf[0];   
         }
         elseif($accion == "n"){
             $lista->universidadestudio  = 0;  
             $lista->grado        = 0; 
             $lista->descripcion  = ""; 
             $lista->mesi         = ""; 
             $lista->anoi         = 0; 
             $lista->mesf         = ""; 
             $lista->anof         = 0;  
         } 
         $arrMes             = array("00"=>"Mes","01"=>"Enero","02"=>"Febrero","03"=>"Marzo","04"=>"Abril","05"=>"Mayo","06"=>"Junio","07"=>"Julio","08"=>"Agosto","09"=>"Setiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre");
         $arrAno[0]="Año";
         for($i=1950;$i<=2020;$i++)  $arrAno[$i]=$i;
         $data['arrmes']     = $arrMes;
         $data['selmesi']    = form_dropdown('mesi',$arrMes,$lista->mesi,"id='mesi' class='comboMedio'");
         $data['selmesf']    = form_dropdown('mesf',$arrMes,$lista->mesf,"id='mesf' class='comboMedio'");
         $data['selanoi']    = form_dropdown('anoi',$arrAno,$lista->anoi,"id='anoi' class='comboMedio'");
         $data['selanof']    = form_dropdown('anof',$arrAno,$lista->anof,"id='anof' class='comboMedio'");            
         $data['lista']          = $lista;
         $data['oculto_det']     = form_hidden(array("accion_det"=>$accion,"codigo_det"=>$codigo));
         $data['seluniversidad'] = form_dropdown('universidadestudio',$this->universidad_model->seleccionar('0'),$lista->universidadestudio,"id='universidadestudio' class='comboGrande'");
         $data['selgrado']       = form_dropdown('grado',$this->grado_model->seleccionar('0'),$lista->grado,"id='grado' class='comboMedio'");    
         $this->load->view("ventas/estudios_nuevo",$data);
    }
     
    public function grabar(){
        $accion = $this->input->get_post('accion_det');
        $codigo = $this->input->get_post('codigo_det');
        $data   = array(
                        "PROP_Codigo"          => ($this->input->post('profesor')),
                        "UNIVP_Codigo"         => ($this->input->post('universidadestudio')),
                        "GRADOP_Codigo"        => ($this->input->post('grado')),
                        "ESTUDIOC_Descripcion" => ($this->input->post('descripcion')),
                        "ESTUDIOC_Estado"      => ($this->input->post('estado')),
                        "ESTUDIOC_FechaInicio" => ($this->input->post('anoi'))."-".($this->input->post('mesi'))."-01",
                        "ESTUDIOC_FechaFin"    => ($this->input->post('anof'))."-".($this->input->post('mesf'))."-01"
                       );
        $resultado = false;
        if($accion == "n"){
            $this->codigo = $this->estudios_model->insertar($data);
        }
        elseif($accion == "e"){
            $this->estudios_model->modificar($codigo,$data);
        }
        echo json_encode($resultado);
    }
    
    public function eliminar(){
        $obj    = $this->input->post('objeto');
        $filter = json_decode($obj);        
        $this->estudios_model->eliminar($filter);
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