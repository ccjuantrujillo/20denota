<?php
class Fabricante extends controller
{
    public function __construct()
    {
        parent::Controller();
        $this->load->helper('html');
        $this->load->helper('url');
        $this->load->library('pagination');
        $this->load->library('html');
        $this->load->library('form_validation');
        $this->load->model('almacen/fabricante_model');
        $this->somevar['compania'] = $this->session->userdata('compania');
    }
    public function listar($j='0')
    {
        $this->load->library('layout', 'layout');
        $data['nombre_fabricante']  = "";
        $data['registros']   = count($this->fabricante_model->listar());
        $conf['base_url']    = site_url('almacen/fabricante/listar/');
        $conf['total_rows']  = $data['registros'];
        $conf['per_page']    = 10;
        $conf['num_links']   = 3;
        $conf['next_link']   = "&gt;";
        $conf['prev_link']   = "&lt;";
        $conf['first_link']  = "&lt;&lt;";
        $conf['last_link']   = "&gt;&gt;";
        $conf['uri_segment'] = 4;
        $offset              = (int)$this->uri->segment(4);
        $this->pagination->initialize($conf);
        $data['paginacion'] = $this->pagination->create_links();
        $listado            = $this->fabricante_model->listar($conf['per_page'],$offset);
        $item               = $j+1;
        $lista              = array();
        if(count($listado)>0){
            foreach($listado as $indice=>$valor)
            {
                $codigo         = $valor->FABRIP_Codigo;
                $editar         = "<a href='#' onclick='editar_fabricante(".$codigo.")'><img src='".base_url()."images/modificar.png' width='16' height='16' border='0' title='Modificar'></a>";
                $ver            = "<a href='#' onclick='ver_fabricante(".$codigo.")'><img src='".base_url()."images/ver.png' width='16' height='16' border='0' title='Modificar'></a>";
                $eliminar       = "<a href='#' onclick='eliminar_fabricante(".$codigo.")'><img src='".base_url()."images/eliminar.png' width='16' height='16' border='0' title='Modificar'></a>";
                $lista[]        = array($item++,$valor->FABRIC_Descripcion,$valor->FABRIC_CodigoUsuario,$editar,$ver,$eliminar);
            }
        }
        $data['lista']            = $lista;
        $data['titulo_busqueda']  = "BUSCAR FABRICANTE";
        $data['nombre_fabricante'] = form_input(array( 'name'  => 'nombre_fabricante','id' => 'nombre_fabricante','value' => '','maxlength' => '100','class' => 'cajaMedia'));
        $data['form_open']        = form_open(base_url().'index.php/almacen/fabricante/buscar',array("name"=>"form_busquedaFabricante","id"=>"form_busquedaFabricante"));
        $data['form_close']       = form_close();
        $data['titulo_tabla']     = "Relaci&oacute;n DE FABRICANTES";
        $data['oculto']           = form_hidden(array('accion'=>"",'codigo'=>"",'modo'=>"insertar",'base_url'=>base_url()));
        $this->layout->view('almacen/fabricante_index',$data);
			
    }
    public function nuevo()
    {
        $this->load->library('layout', 'layout');
        $lblDescripcion     = form_label("NOMBRE FABRICANTE","Nombre Fabricante");
        $lblCodigoUsuario    = form_label("Código","CodigoUsuario");
        $nombre_fabricante   = form_input(array( 'name'  => 'nombre_fabricante','id' => 'nombre_fabricante','value' => '','maxlength' => '100','class' => 'cajaMedia'));
        $codigo_usuario     = form_input(array( 'name'  => 'codigo_usuario','id' => 'codigo_usuario','value' => '','maxlength' => '20','class' => 'cajaPequena'));
        $data['titulo']     = "REGISTRAR FABRICANTE";
        $data['form_open']  = form_open(base_url().'index.php/almacen/fabricante/grabar',array("name"=>"frmFabricante","id"=>"frmFabricante"));
        $data['form_close'] = form_close();
        $data['campos']     = array($lblDescripcion, $lblCodigoUsuario);
        $data['valores']    = array($nombre_fabricante, $codigo_usuario);
        $data['oculto']     = form_hidden(array('codigo'=>"",'base_url'=>base_url(),'fabricante_id'=>''));
        $data['onload']	    = "onload=\"$('#nombres').focus();\"";
        $this->layout->view('almacen/fabricante_nuevo',$data);
    }
    public function editar($id)
    {
        $this->load->library('layout', 'layout');
        $oFabricante            = $this->fabricante_model->obtener($id);
        $lblDescripcion         = form_label("Nombre Fabricante","Nombre Fabricante");
        $lblCodigoUsuario    = form_label("Código","CodigoUsuario");
        $nombre_fabricante       = form_input(array( 'name'  => 'nombre_fabricante','id' => 'nombre_fabricante','value' => $oFabricante[0]->FABRIC_Descripcion,'maxlength' => '100','class' => 'cajaMedia'));
        $codigo_usuario     = form_input(array( 'name'  => 'codigo_usuario','id' => 'codigo_usuario','value' => $oFabricante[0]->FABRIC_CodigoUsuario,'maxlength' => '20','class' => 'cajaPequena'));
        $data['form_open']      = form_open(base_url().'index.php/almacen/fabricante/grabar/',array("name"=>"frmFabricante","id"=>"frmFabricante"));
        $data['campos']         = array($lblDescripcion, $lblCodigoUsuario);
        $data['valores']        = array($nombre_fabricante, $codigo_usuario);
        $data['oculto']         = form_hidden(array('codigo'=>"",'base_url'=>base_url(),'fabricante_id'=>$id));
        $data['form_hidden']    = form_hidden("base_url",base_url());
        $data['form_close']     = form_close();
        $data['titulo']  = "EDITAR FABRICANTE";
        $this->layout->view('almacen/fabricante_nuevo',$data);
    }
    public function grabar()
    {
        $this->form_validation->set_rules('nombre_fabricante','Nombre de fabricante','required');
        if($this->form_validation->run() == FALSE){
            $this->nuevo();
        }
        else{
            $descripcion  = $this->input->post("nombre_fabricante");
            $fabricante_id   = $this->input->post("fabricante_id");
            $codigo_usuario   = $this->input->post("codigo_usuario");
            $filter = new stdClass();
            $filter->FABRIC_Descripcion = strtoupper($descripcion);
            $filter->FABRIC_CodigoUsuario = $codigo_usuario;
            if(isset($fabricante_id) && $fabricante_id>0){
              $this->fabricante_model->modificar($fabricante_id,$filter);
            }
            else{
               $this->fabricante_model->insertar($filter);
            }
            header("location:".base_url()."index.php/almacen/fabricante/listar");
        }
    }
    public function eliminar()
    {
        $id = $this->input->post('fabricante');
        $this->fabricante_model->eliminar($id);
    }
    public function ver($codigo)
    {
        $this->load->library('layout', 'layout');
        $datos_fabricante       = $this->fabricante_model->obtener($codigo);
        $data['nombre_fabricante']= $datos_fabricante[0]->FABRIC_Descripcion;
        $data['fabricante']    = $datos_fabricante[0]->FABRIP_Codigo;
        $data['titulo']        = "VER FABRICANTE";
        $data['oculto']        = form_hidden(array('base_url'=>base_url()));
        $this->layout->view('almacen/fabricante_ver',$data);
    }
    public function buscar($j=0)
    {
        $this->load->library('layout','layout');
        $nombre_fabricante = $this->input->post('nombre_fabricante');
        $filter = new stdClass();
        $filter->FABRIC_Descripcion = $nombre_fabricante;
        $data['registros']      = count($this->fabricante_model->buscar($filter));
        $conf['base_url']       = site_url('maestros/almacen/buscar/');
        $conf['total_rows']     = $data['registros'];
        $conf['per_page']       = 10;
        $conf['num_links']      = 3;
        $conf['first_link']     = "&lt;&lt;";
        $conf['last_link']      = "&gt;&gt;";
        $offset                 = (int)$this->uri->segment(4);
        $listado                = $this->fabricante_model->buscar($filter,$conf['per_page'],$offset);
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
        $this->layout->view('almacen/fabricante_index',$data);
    }
}
?>