<?php
class Marca extends controller
{
    public function __construct()
    {
        parent::Controller();
        $this->load->helper('html');
        $this->load->helper('url');
        $this->load->library('pagination');
        $this->load->library('html');
        $this->load->library('form_validation');
        $this->load->model('almacen/marca_model');
        $this->somevar['compania'] = $this->session->userdata('compania');
    }
    public function listar($j='0')
    {
        $this->load->library('layout', 'layout');
        $data['nombre_marca']  = "";
        $data['registros']   = count($this->marca_model->listar());
        $conf['base_url']    = site_url('almacen/marca/listar/');
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
        $listado            = $this->marca_model->listar($conf['per_page'],$offset);
        $item               = $j+1;
        $lista              = array();
        if(count($listado)>0){
            foreach($listado as $indice=>$valor)
            {
                $codigo         = $valor->MARCP_Codigo;
                $editar         = "<a href='#' onclick='editar_marca(".$codigo.")'><img src='".base_url()."images/modificar.png' width='16' height='16' border='0' title='Modificar'></a>";
                $ver            = "<a href='#' onclick='ver_marca(".$codigo.")'><img src='".base_url()."images/ver.png' width='16' height='16' border='0' title='Modificar'></a>";
                $eliminar       = "<a href='#' onclick='eliminar_marca(".$codigo.")'><img src='".base_url()."images/eliminar.png' width='16' height='16' border='0' title='Modificar'></a>";
                $lista[]        = array($item++,$valor->MARCC_Descripcion, $valor->MARCC_CodigoUsuario,$editar,$ver,$eliminar);
            }
        }
        $data['lista']            = $lista;
        $data['titulo_busqueda']  = "BUSCAR MARCA";
        $data['nombre_marca'] = form_input(array( 'name'  => 'nombre_marca','id' => 'nombre_marca','value' => '','maxlength' => '100','class' => 'cajaMedia'));
        $data['form_open']        = form_open(base_url().'index.php/almacen/marca/buscar',array("name"=>"form_busquedaMarca","id"=>"form_busquedaMarca"));
        $data['form_close']       = form_close();
        $data['titulo_tabla']     = "Relaci&oacute;n DE MARCAS";
        $data['oculto']           = form_hidden(array('accion'=>"",'codigo'=>"",'modo'=>"insertar",'base_url'=>base_url()));
        $this->layout->view('almacen/marca_index',$data);
			
    }
    public function nuevo()
    {
        $this->load->library('layout', 'layout');
        $lblDescripcion     = form_label("Nombre MARCA","Nombre MARCA");
        $lblCodigoUsuario       = form_label("Código","CodigoUsuario");
        $nombre_marca   = form_input(array( 'name'  => 'nombre_marca','id' => 'nombre_marca','value' => '','maxlength' => '100','class' => 'cajaMedia'));
        $codigo_usuario         = form_input(array( 'name'  => 'codigo_usuario','id' => 'codigo_usuario','value' => '','maxlength' => '20','class' => 'cajaPequena'));
        $data['titulo']     = "REGISTRAR MARCA";
        $data['form_open']  = form_open(base_url().'index.php/almacen/marca/grabar',array("name"=>"frmMarca","id"=>"frmMarca"));
        $data['form_close'] = form_close();
        $data['campos']     = array($lblDescripcion, $lblCodigoUsuario);
        $data['valores']    = array($nombre_marca, $codigo_usuario);
        $data['oculto']     = form_hidden(array('codigo'=>"",'base_url'=>base_url(),'marca_id'=>''));
        $data['onload']	    = "onload=\"$('#nombres').focus();\"";
        $this->layout->view('almacen/marca_nueva',$data);
    }
    public function editar($id)
    {
        $this->load->library('layout', 'layout');
        $oMarca             = $this->marca_model->obtener($id);
        $lblDescripcion         = form_label("Nombre Forma pago","Nombre Forma pago");
        $lblCodigoUsuario       = form_label("Código","CodigoUsuario");
        $nombre_marca       = form_input(array( 'name'  => 'nombre_marca','id' => 'nombre_marca','value' => $oMarca[0]->MARCC_Descripcion,'maxlength' => '100','class' => 'cajaMedia'));
        $codigo_usuario         = form_input(array( 'name'  => 'codigo_usuario','id' => 'codigo_usuario','value' => $oMarca[0]->MARCC_CodigoUsuario,'maxlength' => '20','class' => 'cajaPequena'));
        $data['form_open']      = form_open(base_url().'index.php/almacen/marca/grabar/',array("name"=>"frmMarca","id"=>"frmMarca"));
        $data['campos']         = array($lblDescripcion, $lblCodigoUsuario);
        $data['valores']        = array($nombre_marca, $codigo_usuario);
        $data['oculto']         = form_hidden(array('codigo'=>"",'base_url'=>base_url(),'marca_id'=>$id));
        $data['form_hidden']    = form_hidden("base_url",base_url());
        $data['form_close']     = form_close();
        $data['titulo']  = "EDITAR MARCA";
        $this->layout->view('almacen/marca_nueva',$data);
    }
    public function grabar()
    {
        $this->form_validation->set_rules('nombre_marca','Nombre de MARCA','required');
        if($this->form_validation->run() == FALSE){
            $this->nuevo();
        }
        else{
            $descripcion  = $this->input->post("nombre_marca");
            $marca_id   = $this->input->post("marca_id");
            $codigo_usuario   = $this->input->post("codigo_usuario");
            $filter = new stdClass();
            $filter->MARCC_Descripcion = strtoupper($descripcion);
            $filter->MARCC_CodigoUsuario = $codigo_usuario;
            if(isset($marca_id) && $marca_id>0){
              $this->marca_model->modificar($marca_id,$filter);
            }
            else{
               $this->marca_model->insertar($filter);
            }
            header("location:".base_url()."index.php/almacen/marca/listar");
        }
    }
    public function eliminar()
    {
        $id = $this->input->post('marca');
        $this->marca_model->eliminar($id);
    }
    public function ver($codigo)
    {
        $this->load->library('layout', 'layout');
        $datos_marca       = $this->marca_model->obtener($codigo);
        $data['nombre_marca']= $datos_marca[0]->MARCC_Descripcion;
        $data['marca']= $datos_marca[0]->MARCP_Codigo;
        $data['titulo']        = "VER MARCA";
        $data['oculto']        = form_hidden(array('base_url'=>base_url()));
        $this->layout->view('almacen/marca_ver',$data);
    }
    public function buscar($j=0)
    {
        $this->load->library('layout','layout');
        $nombre_marca = $this->input->post('nombre_marca');
        $filter = new stdClass();
        $filter->MARCC_Descripcion = $nombre_marca;
        $data['registros']      = count($this->marca_model->buscar($filter));
        $conf['base_url']       = site_url('almacen/almacen/buscar/');
        $conf['total_rows']     = $data['registros'];
        $conf['per_page']       = 10;
        $conf['num_links']      = 3;
        $conf['first_link']     = "&lt;&lt;";
        $conf['last_link']      = "&gt;&gt;";
        $offset                 = (int)$this->uri->segment(4);
        $listado                = $this->marca_model->buscar($filter,$conf['per_page'],$offset);
        $item                   = $j+1;
        $lista                  = array();
        if(count($listado)>0){
            foreach($listado as $indice=>$valor){
                $codigo       = $valor->MARCP_Codigo;
                $editar       = "<a href='#' onclick='editar_marca(".$codigo.")' target='_parent'><img src='".base_url()."images/modificar.png' width='16' height='16' border='0' title='Modificar'></a>";
                $ver          = "<a href='#' onclick='ver_marca(".$codigo.")' target='_parent'><img src='".base_url()."images/ver.png' width='16' height='16' border='0' title='Modificar'></a>";
                $eliminar     = "<a href='#' onclick='eliminar_marca(".$codigo.")' target='_parent'><img src='".base_url()."images/eliminar.png' width='16' height='16' border='0' title='Modificar'></a>";
                $lista[]      = array($item++,$valor->MARCC_Descripcion,$valor->MARCC_CodigoUsuario,$editar,$ver,$eliminar);
            }
        }
        $data['titulo_tabla']    = "RESULTADO DE BUSQUEDA de MARCAS";
        $data['titulo_busqueda'] = "BUSCAR MARCA";
        $data['nombre_marca']  = form_input(array( 'name'  => 'nombre_marca','id' => 'nombre_marca','value' => $nombre_marca,'maxlength' => '100','class' => 'cajaMedia'));
        $data['form_open']       = form_open(base_url().'index.php/almacen/marca/buscar',array("name"=>"form_busquedaMarca","id"=>"form_busquedaMarca"));
        $data['form_close']      = form_close();
        $data['lista']           = $lista;
        $data['oculto']          = form_hidden(array('base_url'=>base_url()));
        $this->pagination->initialize($conf);
        $data['paginacion'] = $this->pagination->create_links();
        $this->layout->view('almacen/marca_index',$data);
    }
}
?>