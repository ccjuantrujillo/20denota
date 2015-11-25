<?php header("Content-type: text/html; charset=utf-8"); 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Estudioidiomas extends CI_Controller
{
    public $configuracion;
    public $codigo;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ventas/estudios_model');
        $this->load->model('seguridad/permiso_model');
        $this->load->helper('menu');
        $this->load->model(maestros.'idiomas_model');        
        $this->load->model(maestros.'grado_model');             
        $this->load->model(ventas.'estudiosidiomas_model');   
        $this->somevar['compania'] = $this->session->userdata('compania');
    }
    
    public function listar($codigo){
        $filter = new stdClass();
        $lista = new stdClass();
        $filter->profesor = $codigo;
        $lista->estudiosidiomas = $this->estudiosidiomas_model->listar($filter);    
        $lista->profesor  = $codigo;
        $arrNivel           = array("00"=>"::Seleccione::","1"=>"Basico","2"=>"Intermedio","3"=>"Avanzado");
        $data['arrNivel']   = $arrNivel;
         $arrMes             = array("0"=>"Mes","01"=>"Enero","02"=>"Febrero","03"=>"Marzo","04"=>"Abril","05"=>"Mayo","06"=>"Junio","07"=>"Julio","08"=>"Agosto","09"=>"Setiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre");
         $arrAno[0]="Año";
         for($i=1950;$i<=2020;$i++)  $arrAno[$i]=$i;
         $data['arrmes']     = $arrMes;         
         $data['lista']      = $lista;
        $this->load->view("ventas/estudioidiomas_index",$data);
    }
    
     public function editar($accion,$codigo=""){
         $lista = new stdClass();
         $data  = array();
         if($accion == "e"){
             $filter = new stdClass();
             $filter->estudioidioma = $codigo;
             $estudioidiomas = $this->estudiosidiomas_model->obtener($filter); 
             $lista->idioma  = $estudioidiomas->IDIOMP_Codigo;
             $lista->nivel   = $estudioidiomas->ESTIDIOMC_Nivel;
             $lista->estado  = $estudioidiomas->ESTIDIOMC_Estado;
             $arrFechai      = explode("-",$estudioidiomas->ESTIDIOMC_FechaInicio);
             $arrFechaf      = explode("-",$estudioidiomas->ESTIDIOMC_FechaFin);
             $lista->mesi    = $arrFechai[1];
             $lista->anoi    = $arrFechai[0];
             $lista->mesf    = $arrFechaf[1];
             $lista->anof    = $arrFechaf[0];             
         }
         elseif($accion == "n"){
             $lista->idioma  = 0;  
             $lista->nivel   = 0;  
             $lista->estado  = 1;  
             $lista->mesi    = "";
             $lista->anoi    = "";
             $lista->mesf    = "";
             $lista->anof    = "";           
         }      
         $arrMes             = array("00"=>"Mes","01"=>"Enero","02"=>"Febrero","03"=>"Marzo","04"=>"Abril","05"=>"Mayo","06"=>"Junio","07"=>"Julio","08"=>"Agosto","09"=>"Setiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre");
         $arrAno[0]="Año";
         $arrNivel           = array("0"=>"::Seleccione::","1"=>"Basico","2"=>"Intermedio","3"=>"Avanzado");
         for($i=1950;$i<=2020;$i++)  $arrAno[$i]=$i;
         $data['arrmes']     = $arrMes;
         $data['arrNivel']   = $arrNivel;
         $data['selmesi']    = form_dropdown('mesi',$arrMes,$lista->mesi,"id='mesi' class='comboMedio'");
         $data['selmesf']    = form_dropdown('mesf',$arrMes,$lista->mesf,"id='mesf' class='comboMedio'");
         $data['selanoi']    = form_dropdown('anoi',$arrAno,$lista->anoi,"id='anoi' class='comboMedio'");
         $data['selanof']    = form_dropdown('anof',$arrAno,$lista->anof,"id='anof' class='comboMedio'");   
         $data['selidiomas'] = form_dropdown('idioma',$this->idiomas_model->seleccionar('0'),$lista->idioma,"id='idioma' class='comboGrande'");
         $data['selnivel']   = form_dropdown('nivel',$arrNivel,$lista->nivel,"id='nivel' class='comboMedio'");   
         $data['lista']      = $lista;
         $data['oculto_det'] = form_hidden(array("accion_det"=>$accion,"codigo_det"=>$codigo));
         $this->load->view("ventas/estudioidiomas_nuevo",$data);
    }
     
    public function grabar(){
        $accion = $this->input->get_post('accion_det');
        $codigo = $this->input->get_post('codigo_det');
        $data   = array(
                        "PROP_Codigo"           => $this->input->post('profesor'),
                        "IDIOMP_Codigo"         => $this->input->post('idioma'),
                        "ESTIDIOMC_Estado"      => $this->input->post('estado'),
                        "ESTIDIOMC_Descripcion" => $this->input->post('descripcion'),
                        "ESTIDIOMC_Nivel"       => $this->input->post('nivel'),
                        "ESTIDIOMC_FechaInicio" => $this->input->post('anoi')."-".$this->input->post('mesi')."-00",
                        "ESTIDIOMC_FechaFin"    => $this->input->post('anof')."-".$this->input->post('mesf')."-00",
                       );
        $resultado = false;
        if($accion == "n"){
            $resultado = true;  
            $this->codigo = $this->estudiosidiomas_model->insertar($data);
        }
        elseif($accion == "e"){
            $resultado = true;  
            $this->estudiosidiomas_model->modificar($codigo,$data);
        }
        echo json_encode($resultado);
    }
    
    public function eliminar(){
        $obj    = $this->input->post('objeto');
        $filter = json_decode($obj);        
        $this->estudiosidiomas_model->eliminar($filter);
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