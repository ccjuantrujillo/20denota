<?php header("Content-type: text/html; charset=utf-8"); 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Rol extends Controller{
	public function __construct(){
            parent::Controller();
            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->load->library('pagination');
            $this->load->library('html');

            $this->load->model('seguridad/rol_model');
            $this->load->model('seguridad/permiso_model');
            $this->somevar['compania'] = $this->session->userdata('compania');
	}
	public function index(){
		$this->layout->view('seguridad/rol_index');
  }
  public function listar($j='0'){
           $this->load->library('layout','layout');
            $data['txtNombre'] = "";
            $data['registros']  = count($this->rol_model->listar_roles());
            $conf['base_url']   = site_url('seguridad/roles/');
            $conf['per_page']   = 10;
            $conf['num_links']  = 3;
            $conf['first_link'] = "&lt;&lt;";
            $conf['last_link']  = "&gt;&gt;";
            $conf['total_rows'] = $data['registros'];
            $offset             = (int)$this->uri->segment(3);
            $listado_roles   = $this->rol_model->listar_roles($conf['per_page'],$offset);
            $item               = $j+1;
            $lista              = array();
            if(count($listado_roles)>0){
                foreach($listado_roles as $indice=>$valor)
                {
                    $codigo         = $valor->ROL_Codigo;
                    $nombre_rol     = $valor->ROL_Descripcion;
                    $editar         = "<a href='#' onclick='editar_rol(".$codigo.")'><img src='".base_url()."images/modificar.png' width='16' height='16' border='0' title='Modificar'></a>";
                    $ver            = "<a href='#' onclick='ver_rol(".$codigo.")'><img src='".base_url()."images/ver.png' width='16' height='16' border='0' title='Modificar'></a>";
                    $eliminar       = "<a href='#' onclick='eliminar_rol(".$codigo.")'><img src='".base_url()."images/eliminar.png' width='16' height='16' border='0' title='Modificar'></a>";
                    $lista[]        = array($item,$nombre_rol,$editar,$ver,$eliminar);
                    $item++;
                }
            }
            $data['action']          = base_url()."index.php/seguridad/rol/buscar_roles";
            $data['titulo_busqueda'] = "BUSCAR ROL";
            $data['titulo_tabla']    = "RELACI&Oacute;N de ROLES";
            $data['lista']           = $lista;
            $data['oculto']          = form_hidden(array('base_url'=>base_url()));
            $this->pagination->initialize($conf);
            $data['paginacion']      = $this->pagination->create_links();
            $this->layout->view('seguridad/rol_index',$data);
        }

     public function nuevo(){
		$this->load->library('layout','layout');
         $datos_roles = $this->rol_model->listar_roles();
		$arreglo = array(''=>'::Selecione::');
		foreach($datos_roles as $indice=>$valor){
			$indice1   = $valor->ROL_Codigo;
			$valor1    = $valor->ROL_Descripcion;
			$arreglo[$indice1] = $valor1;
		}
		$lblNombres = form_label('NOMBRE','nombre');

		$txtNombre = form_input(array('name'=>'txtRol','id'=>'txtRol','value'=>'','maxlength'=>'30','class'=>'cajaMedia'));

		$cboRol     = form_dropdown('cboRol',$arreglo,'large',"id='cboRol' class='fuente8'");
		$oculto     = form_hidden(array('accion'=>"",'codigo'=>"",'modo'=>"insertar",'base_url'=>base_url()));
		$data['titulo']     = "REGISTRAR ROL";
		$data['formulario'] = "frmRol";
		$data['campos']     = array($lblNombres);
		$data['valores']    = array($txtNombre);
		$data['oculto']     = $oculto;
		$data['onload']		= "onload=\"$('#txtNombre').focus();\"";
		$this->layout->view('seguridad/rol_nuevo',$data);
	}
     public function editar($codigo){
		$this->load->library('layout','layout');
		$datos_rol  = $this->rol_model->obtener_rol($codigo);
		$descripcion = $datos_rol[0]->ROL_Descripcion;
		$lblRol    = form_label('NOMBRE ROL','rol');
		$txtRol    = form_input(array('name'=>'txtRol','id'=>'txtRol','value'=>$descripcion,'maxlength'=>'50','class'=>'cajaMedia'));
		$oculto     = form_hidden(array('rol_id'=>$codigo,'base_url'=>base_url()));
		$data['titulo']     = "EDITAR ROL";
		$data['formulario'] = "frmRol";
		$data['campos']     = array($lblRol);
		$data['valores']    = array($txtRol);
		$data['oculto']     = $oculto;
                $data['codigo'] = $codigo;
		$data['onload']		= "onload=\"$('#txtRol').select();$('#txtRol').focus();\"";
		$this->layout->view('seguridad/rol_nuevo',$data);
	}
        
      public function grabar()
    {
        $this->form_validation->set_rules('txtRol','Nombre de rol','required'); 
        if($this->form_validation->run() == FALSE){
           $this->nuevo();

        }
        else{
            $descripcion  = $this->input->post('txtRol');
            $checkO = $this->input->post('checkO');
        if(is_array($checkO))
           
            $rol_id   = $this->input->post("rol_id");
            $filter = new stdClass();
            $filter->ROL_Descripcion = strtoupper($descripcion);
          
         if(isset($rol_id) && $rol_id>0){
              $this->rol_model->modificar($rol_id,$filter,$checkO);
            }
            else{
               $filter->CICLOP_Codigo = $this->somevar['compania'];
               $this->rol_model->insertar($filter,$checkO);
            }
            header("location:".base_url()."index.php/seguridad/rol/listar");
        }
              
      }

    public function eliminar()
     {
       $rol = $this->input->post('rol');
       $this->rol_model->eliminar($rol);
        
     }
    public function buscar_roles($j='0'){
            $nombres  = $this->input->post('txtNombre');           
            $data['txtNombre']     = $nombres;
            $filter   = new stdClass();
            $filter->nombres = $nombres;           
            $data['registros']   = count($this->rol_model->buscar_roles($filter));
            $conf['base_url']    = site_url('seguridad/rol/buscar_roles/');
            $conf['total_rows']  = $data['registros'];
            $conf['per_page']    = 10;
            $conf['num_links']   = 3;
            $conf['next_link']   = "&gt;";
            $conf['prev_link']   = "&lt;";
            $conf['first_link']  = "&lt;&lt;";
            $conf['last_link']   = "&gt;&gt;";
            $conf['uri_segment'] = 4;
            $this->pagination->initialize($conf);
            $data['paginacion'] = $this->pagination->create_links();
            $listado_roles   = $this->rol_model->buscar_roles($filter,$conf['per_page'],$j);
            $item               = $j+1;
            $lista              = array();
            if(count($listado_roles)>0)
            {
                foreach($listado_roles as $indice=>$valor)
                {
                    $codigo         = $valor->ROL_Codigo;
                    $nombre_rol     = $valor->ROL_Descripcion;
                    $editar         = "<a href='#' onclick='editar_rol(".$codigo.")'><img src='".base_url()."images/modificar.png' width='16' height='16' border='0' title='Modificar'></a>";
                    $ver            = "<a href='#' onclick='ver_rol(".$codigo.")'><img src='".base_url()."images/ver.png' width='16' height='16' border='0' title='Modificar'></a>";
                    $eliminar       = "<a href='#' onclick='eliminar_rol(".$codigo.")'><img src='".base_url()."images/eliminar.png' width='16' height='16' border='0' title='Modificar'></a>";
                    $lista[]        = array($item,$nombre_rol,$editar,$ver,$eliminar);
                    $item++;
                }
            }
            $data['action']         = base_url()."index.php/seguridad/rol/buscar_roles";
            $data['titulo_tabla']   = "RESULTADO DE BUSQUEDA de ROLES";
            $data['titulo_busqueda']= "BUSCAR ROLES";
            $data['lista']      = $lista;
            $data['oculto']     = form_hidden(array('base_url'=>base_url()));
            $this->layout->view('seguridad/rol_index',$data);
        }
     public function ver($codigo){
		$this->load->library('layout','layout');
		$data['datos_rol']    = $this->rol_model->obtener_rol($codigo);
                $data['titulo']       = "VER ROL";
		$data['oculto']       = form_hidden(array('base_url'=>base_url()));
		$this->layout->view('seguridad/rol_ver',$data);
	}
}
?>