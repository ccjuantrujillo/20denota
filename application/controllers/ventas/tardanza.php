<?php header("Content-type: text/html; charset=utf-8"); 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tardanza extends CI_Controller
{
    public $configuracion;
    public $codigo;

    public function __construct()
    {
        parent::__construct(); 
        if(!isset($_SESSION['login'])) die("Sesion terminada. <a href='".  base_url()."'>Registrarse e ingresar.</a> ");           
        $this->load->model(ventas.'acta_model');
        $this->load->model(ventas.'actadetalle_model');
        $this->load->model(ventas.'alumno_model');
        $this->load->model(ventas.'actividad_model');
        $this->load->model(ventas.'profesor_model');
        $this->load->model(ventas.'tardanza_model');
        $this->load->model(maestros.'persona_model');        
        $this->load->model(seguridad.'permiso_model');          
        $this->load->model(almacen.'curso_model');  
        $this->load->model(maestros.'ciclo_model');  
        $this->load->model(maestros.'aula_model'); 
        $this->load->model(maestros.'tipoestudio_model'); 
        $this->load->model(maestros.'tipoasistencia_model');
        $this->load->model(maestros.'local_model'); 
        $this->load->helper('menu');
        $this->configuracion = $this->config->item('conf_pagina');
        $this->login   = $this->session->userdata('login');
    }
    public function listar($j=0){
        $filter           = new stdClass();
        $filter->rol      = $this->session->userdata('rolusu');		
        $filter->order_by = array("m.MENU_Orden"=>"asc");
        $menu       = get_menu($filter);    
        $filter     = new stdClass();
        if(isset($_SESSION["codcurso"]) && $_SESSION["codcurso"]!=0)  $filter->curso = $_SESSION["codcurso"];
        $filter->order_by = array("p.TAREOC_Fecha"=>"desc","h.AULAC_Nombre"=>"asc");
        $registros = count($this->tardanza_model->listar($filter));
        $tardanzas = $this->tardanza_model->listar($filter,"",$this->configuracion['per_page'],$j);
        $item      = 1;
        $lista     = array();
        if(count($tardanzas)>0){
            foreach($tardanzas as $indice => $value){
                $lista[$indice]           = new stdClass();
                $lista[$indice]->codigo   = $value->TAREOP_Codigo;
                $lista[$indice]->nombres  = $value->PERSC_Nombre;
                $lista[$indice]->paterno  = $value->PERSC_ApellidoPaterno;
                $lista[$indice]->materno  = $value->PERSC_ApellidoMaterno;
                $lista[$indice]->fecha    = $value->TAREOC_Fecha;
                $lista[$indice]->aula     = $value->AULAC_Nombre;
                $lista[$indice]->hinicio  = substr($value->TAREOC_Hinicio,0,5);
                $lista[$indice]->hfin     = substr($value->TAREOC_Hfin,0,5);
                $lista[$indice]->tipo     = $value->TIPOASISC_Nombre; 
                $lista[$indice]->curso    = $value->PROD_Nombre; 
                $filter = new stdClass();
                $filter->profesor  = $value->TAREOC_ProfesorReemplazado;                  
                $reemplazo = $this->profesor_model->obtener($filter);
                $lista[$indice]->nombres_reemp = isset($reemplazo->PERSC_Nombre)?$reemplazo->PERSC_Nombre:"";
                $lista[$indice]->paterno_reemp = isset($reemplazo->PERSC_ApellidoPaterno)?$reemplazo->PERSC_ApellidoPaterno:"";
                $lista[$indice]->materno_reemp = isset($reemplazo->PERSC_ApellidoMaterno)?$reemplazo->PERSC_ApellidoMaterno:"";                
            }
        }
        $configuracion = $this->configuracion;
        $configuracion['base_url']    = base_url()."index.php/maestros/persona/listar";
        $configuracion['total_rows']  = $registros;
        $this->pagination->initialize($configuracion);
        /*Enviamos los datos a la vista*/
        $data['lista']           = $lista;
        $data['titulo']          = "Tardanzas y Reemplazos";
        $data['menu']            = $menu;
        $data['header']          = get_header();
        $data['j']               = $j;
        $data['registros']       = $registros;
        $data['paginacion']      = $this->pagination->create_links();
        $this->load->view("ventas/tardanza_index",$data);
    }

     public function editar($accion,$codigo=""){   
         $lista = new stdClass();
         if($accion == "e"){
             $filter             = new stdClass();
             $filter->tareo      = $codigo;
             $tardanzas          = $this->tardanza_model->obtener($filter);
             $lista->fecha       = date_sql($tardanzas->TAREOC_Fecha);
             $lista->local       = $tardanzas->LOCP_Codigo;
             $lista->aula        = $tardanzas->AULAP_Codigo;
             $lista->tipo        = $tardanzas->TAREOC_Tipo;
             $lista->nombres     = $tardanzas->PERSC_Nombre." ".$tardanzas->PERSC_ApellidoPaterno." ".$tardanzas->PERSC_ApellidoMaterno;
             $lista->hinicio     = $tardanzas->TAREOC_Hinicio;
             $lista->hfin        = $tardanzas->TAREOC_Hfin;
             $lista->tipo        = $tardanzas->TAREOC_Tipo;
             $lista->codigo      = $tardanzas->TAREOP_Codigo;
             $lista->reemplazo   = $tardanzas->TAREOC_ProfesorReemplazado;
             $lista->profesor    = $tardanzas->PROP_Codigo;
             $filter             = new stdClass();
             $filter->profesor   = $lista->reemplazo;
             $reemplazo          = $this->profesor_model->obtener($filter);
             $lista->nombres_reemp = isset($reemplazo->PERSP_Codigo)?($reemplazo->PERSC_Nombre.' '.$reemplazo->PERSC_ApellidoPaterno.' '.$reemplazo->PERSC_ApellidoMaterno):"";
         }
         elseif($accion == "n"){
             $lista->fecha     = date("d/m/Y",time());
             $lista->local     = "";
             $lista->aula      = "";
             $lista->tipo      = "";
             $lista->nombres   = "";
             $lista->profesor  = "";
             $lista->hinicio   = "";
             $lista->hfin      = "";
             $lista->codigo    = "";
             $lista->reemplazo = "";
             $lista->nombres_reemp = "";
         }
         $data['titulo']       = $accion=="e"?"Editar Tardanza Reemplazo":"Crear Tardanza Reemplazo";
         $data['form_open']    = form_open('',array("name"=>"frmPersona","id"=>"frmPersona","onsubmit"=>"return valida_guiain();"));
         $data['form_close']   = form_close();
         $data['lista']	       = $lista;
         $data['sellocal']     = form_dropdown('local',$this->local_model->seleccionar('0'),$lista->local,"id='local' class='comboMedio'");
         $filter = new stdClass();
         $filter->local        = $lista->local;
         $data['selaula']      = form_dropdown('aula',$this->aula_model->seleccionar('0',$filter),$lista->aula,"id='aula' class='comboMedio'");
         $data['seltipo']      = form_dropdown('tipo',$this->tipoasistencia_model->seleccionar('0'),$lista->tipo,"id='tipo' class='comboMedio'");         
         $data['oculto']       = form_hidden(array("accion"=>$accion,"codigo"=>$codigo));
         $this->load->view("ventas/tardanza_nuevo",$data);
    }
     
    public function grabar(){
        $accion      = $this->input->get_post('accion');
        $codigo      = $this->input->get_post('codigo');
        $data   = array(
                        "PROP_Codigo"   => $this->input->post('profesor'),
                        "AULAP_Codigo"  => $this->input->post('aula'),
                        "TAREOC_Tipo"   => $this->input->post('tipo'),
                        "TAREOC_ProfesorReemplazado"  => $this->input->post('reemplazo'),
                        "TAREOC_Fecha" => date_sql_ret($this->input->post('fecha')),
                        "TAREOC_Hinicio" => $this->input->post('hinicio'),
                        "TAREOC_Hfin" => $this->input->post('hfin')
                       );
        if($accion == "n"){
            $this->codigo = $this->tardanza_model->insertar($data);
        }
        elseif($accion == "e"){
            $this->tardanza_model->modificar($codigo,$data);
        }
    }
    
    public function eliminar()
    {
        $resultado = true;
        $codigo  = $this->input->post('codigo');
        $this->tardanza_model->eliminar($codigo);
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