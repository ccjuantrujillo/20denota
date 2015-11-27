<?php header("Content-type: text/html; charset=utf-8"); 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tareo extends CI_Controller {
    public function __construct(){
        parent::__construct(); 
        if(!isset($_SESSION['login'])) die("Sesion terminada. <a href='".  base_url()."'>Registrarse e ingresar.</a> ");           
        $this->load->model(ventas.'acta_model');
        $this->load->model(ventas.'actadetalle_model');
        $this->load->model(ventas.'alumno_model');
        $this->load->model(ventas.'actividad_model');
        $this->load->model(ventas.'profesor_model');
        $this->load->model(ventas.'tareo_model');
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

    public function index()
    {
        $this->load->view('seguridad/inicio');	
    }

    public function listar(){
         $filter           = new stdClass();
        $filter->rol      = $this->session->userdata('rolusu');		
        $filter->order_by = array("m.MENU_Orden"=>"asc");
        $menu       = get_menu($filter);              
        $filter     = new stdClass();
        $filter->order_by = array("f.PERSC_ApellidoPaterno"=>"asc","f.PERSC_ApellidoMaterno"=>"asc");
        $filter_not = new stdClass(); 
        $registros = count($this->acta_model->listar($filter,$filter_not));
        $matricula   = $this->acta_model->listar($filter,$filter_not,$this->configuracion['per_page'],$j);
        $item      = 1;
        $lista     = array();
        if(count($matricula)>0){
            foreach($matricula as $indice => $value){
                $lista[$indice]           = new stdClass();
                $lista[$indice]->codigo   = $value->ACTAP_Codigo;
                $lista[$indice]->nombres  = $value->PERSC_Nombre;
                $lista[$indice]->paterno  = $value->PERSC_ApellidoPaterno;
                $lista[$indice]->materno  = $value->PERSC_ApellidoMaterno;
                $lista[$indice]->fechareg = $value->fechareg;
                $lista[$indice]->fecha    = date_sql($value->ACTAC_Fecha);
                $lista[$indice]->numero   = $value->ACTAC_Numero;
                $lista[$indice]->titulo   = $value->ACTAC_Titulo;
            }
        }
        $configuracion = $this->configuracion;
        $configuracion['base_url']    = base_url()."index.php/ventas/orden/listar";
        $configuracion['total_rows']  = $registros;
        $this->pagination->initialize($configuracion);
        /*Enviamos los datos a la vista*/
        $data['lista']        = $lista;
        $data['titulo']       = "Actas de reunion";
        $data['menu']         = $menu;
        $data['header']          = get_header();
        $data['form_open']    = form_open('',array("name"=>"frmPersona","id"=>"frmPersona","onsubmit"=>"return valida_guiain();"));     
        $data['form_close']   = form_close();         
        $data['j']            = $j;
        $data['registros']    = $registros;
        $data['paginacion']   = $this->pagination->create_links();
        $this->load->view("ventas/tareo_index",$data);
    }

    public function editar(){
//       $ciclo  = $this->input->get_post('ciclo'); 
        $local  = $this->input->get_post('local'); 
        $aula   = $this->input->get_post('aula'); 
        $fecha  = $this->input->get_post('fecha'); 
        if($aula=="")  $aula = 0;
//        if($ciclo=="") $ciclo = 2;       
        if($fecha=="") $fecha = date("d/m/Y");  
        $filter           = new stdClass();
        $filter->rol      = $this->session->userdata('rolusu');		
        $filter->order_by = array("m.MENU_Orden"=>"asc");
        $menu       = get_menu($filter);           
        $filter        = new stdClass();
        $filter->aula  = $aula;
        $filter->fecha = $fecha;
       $filter->order_by = array("f.PERSC_ApellidoPaterno"=>"asc","f.PERSC_ApellidoMaterno"=>"asc");
        $filter_not = new stdClass(); 
        $tareo     = $this->tareo_model->listar($filter,$filter_not);
        $lista     = new stdClass();
//        $lista->ciclo = $ciclo;
        $lista->aula  = $aula;
        $lista->local = $local;
        $lista->fecha = $fecha;;
        $lista->fila  = array();
        if(count($tareo)>0){
            foreach($tareo as $indice => $value){
                $lista->fila[$indice]           = new stdClass();
                $lista->fila[$indice]->codigo   = $value->TAREOP_Codigo;
                $lista->fila[$indice]->nombres  = $value->PERSC_Nombre;
                $lista->fila[$indice]->paterno  = $value->PERSC_ApellidoPaterno;
                $lista->fila[$indice]->materno  = $value->PERSC_ApellidoMaterno;
                $lista->fila[$indice]->fecha    = $value->TAREOC_Fecha;
                $lista->fila[$indice]->hinicio  = substr($value->TAREOC_Hinicio,0,5);
                $lista->fila[$indice]->hfin     = substr($value->TAREOC_Hfin,0,5);
                $lista->fila[$indice]->tipo     = $value->TIPOASISC_Nombre; 
                $filter = new stdClass();
                $filter->profesor  = $value->TAREOC_ProfesorReemplazado;                  
                $reemplazo = $this->profesor_model->obtener($filter);
                $lista->fila[$indice]->nombres_reemp = isset($reemplazo->PERSC_Nombre)?$reemplazo->PERSC_Nombre:"";
                $lista->fila[$indice]->paterno_reemp = isset($reemplazo->PERSC_ApellidoPaterno)?$reemplazo->PERSC_ApellidoPaterno:"";
                $lista->fila[$indice]->materno_reemp = isset($reemplazo->PERSC_ApellidoMaterno)?$reemplazo->PERSC_ApellidoMaterno:"";
            }
        }
        $data['lista']      = $lista;
        $data['titulo']     = "Tardanzas y Reemplazos";
        $data['menu']       = $menu;
        $data['form_open']  = form_open('ventas/tareo/editar',array("name"=>"frmPersona","id"=>"frmPersona"));     
        $data['form_close'] = form_close();         
        $filter = new stdClass();
        $filter->local = $lista->local;        
        $data['sellocal']   = form_dropdown('local',$this->local_model->seleccionar('0'),$lista->local,"id='local' class='comboMedio' onchange=\"$('#aula').val('0');submit();\"");  
        $data['selaula']    = form_dropdown('aula',$this->aula_model->seleccionar('0',$filter),$lista->aula,"id='aula' class='comboMedio' onchange=\"submit();\"");          
        $this->load->view("ventas/tareo_nuevo",$data);
    }

    public function grabar(){
        $codigo        = $this->input->get_post('codigo');
        $codigodetalle = $this->input->get_post('codigodetalle');
        $aula      = $this->input->get_post('aula');
        $fecha     = $this->input->get_post('fecha');
        $profesor  = $this->input->get_post('profesor');
        $hinicio   = $this->input->get_post('hinicio');
        $hfin      = $this->input->get_post('hfin');
        $tipo      = $this->input->get_post('tipo');
        $reemplazo = $this->input->get_post('reemplazo');
        if(count($codigodetalle)>0 && is_array($codigodetalle)){
            foreach($codigodetalle as $item=>$value){
                $data = array(
                            "PROP_Codigo"                => $profesor[$item],
                            "AULAP_Codigo"               => $aula,
                            "TAREOC_ProfesorReemplazado" => $reemplazo[$item],
                            "TAREOC_Fecha"               => date_sql_ret($fecha),
                            "TAREOC_Hinicio"             => trim($hinicio[$item]).":00",
                            "TAREOC_Hfin"                => trim($hfin[$item]).":00",
                            "TAREOC_Tipo"                => $tipo[$item]
                        );
                if($codigodetalle[$item]==""){//Insertar
                    $this->tareo_model->insertar($data); 
                }
                else{//Editar
                    $this->tareo_model->modificar($codigodetalle[$item],$data); 
                }                 
            }
        }
        echo json_encode(true);
    }
	
    public function eliminar(){
        $codigo = $this->input->post('codigo');
        $resultado = false;
        $this->tareo_model->eliminar($codigo);
        $resultado = true;
        echo json_encode($resultado);
    }
    
    public function eliminardetalle(){
        $codigo = $this->input->post('codigo');
        $resultado = false;
        $this->actadetalle_model->eliminar($codigo);
        $resultado = true;
        echo json_encode($resultado);
    }        
    
    public function obtener(){
        $obj    = $this->input->post('objeto');
        $filter = json_decode($obj);
        $aulas  = $this->tareo_model->obtener($filter);
        $resultado = json_encode($aulas);       
        echo $resultado;        
    } 
    
    public function ver($codigo){
        $filter           = new stdClass();
        $filter->orden    = $codigo;
        $ordenes          = $this->acta_model->obtener($filter);
        $codproducto      = $ordenes->PROD_Codigo;
        $codcliente       = $ordenes->CLIP_Codigo;
        $filter           = new stdClass();
        $filter->cliente  = $codcliente; 
        $clientes         = $this->alumno_model->obtener($filter);
        $filter           = new stdClass();
        $filter->curso = $codproducto; 
        $productos        = $this->curso_model->obtener($filter);        
        $this->load->library("fpdf/pdf");
        $CI = & get_instance();
        $CI->pdf->FPDF('P');
        $CI->pdf->AliasNbPages();
        $CI->pdf->AddPage();
        $CI->pdf->SetTextColor(0,0,0);
        $CI->pdf->SetFillColor(216,216,216);
        $CI->pdf->SetFont('Arial','B',11);
        $CI->pdf->Image('img/puertosaber.jpg',10,8,10);
        $CI->pdf->Cell(0,13,"MATRICULA Nro ".$ordenes->ORDENC_Numero,0,1,"C",0);
         $CI->pdf->SetFont('Arial','B',7);
        $CI->pdf->Cell(120,10, "" ,0,1,"L",0);
        $CI->pdf->Cell(90,5, "CURSO : " ,1,0,"L",0);
        $CI->pdf->Cell(1,1, "" ,0,0,"L",0);
        $CI->pdf->Cell(90,5,$productos->PROD_Nombre,1,1,"L",0);
        $CI->pdf->Cell(90,1, "" ,0,1,"L",0);
        $CI->pdf->Cell(90,5, "APELLIDOS Y NOMBRES: " ,1,0,"L",0);
        $CI->pdf->Cell(1,1, "" ,0,0,"L",0);
        $CI->pdf->Cell(90,5,$clientes->PERSC_ApellidoPaterno." ".$clientes->PERSC_ApellidoMaterno.", ".$clientes->PERSC_Nombre,1,1,"L",0); 
        $CI->pdf->Cell(90,1, "" ,0,1,"L",0);
        $CI->pdf->Cell(90,5, "USUARIO: " ,1,0,"L",0);
        $CI->pdf->Cell(1,1, "" ,0,0,"L",0);
        $CI->pdf->Cell(90,5,$ordenes->ORDENC_Usuario ,1,1,"L",0);
         $CI->pdf->Cell(90,1, "" ,0,1,"L",0);
        $CI->pdf->Cell(90,5, "CLAVE: " ,1,0,"L",0);
        $CI->pdf->Cell(1,1,$ordenes->ORDENC_Password,0,0,"L",0);
        $CI->pdf->Cell(90,5, "" ,1,1,"L",0);
         $CI->pdf->Cell(90,1, "" ,0,1,"L",0);         
        $CI->pdf->Cell(90,5, "RESPONSABLE: " ,1,0,"L",0);
        $CI->pdf->Cell(1,1, "" ,0,0,"L",0);
        $CI->pdf->Cell(90,5, "" ,1,1,"L",0);   
         $CI->pdf->Cell(90,1, "" ,0,1,"L",0);
        $CI->pdf->SetTextColor(0,0,0);
        $CI->pdf->SetFillColor(255,255,255);
        $CI->pdf->Cell(181,5, "OBSERVACION : " ,0,1,"L",1);
        $CI->pdf->Cell(181,5,$ordenes->ORDENC_Observacion,1,1,"L",1);
        $CI->pdf->Output();
    }

    public function buscar($n=""){
        $tipo    = $this->input->get_post('tipo');
        $ot      = $this->input->get_post('ot');
        $rsocial = $this->input->get_post('rsocial');
        $filter  = new stdClass();
        $filter->anio = date('Y',time());
        $filter->tipo = "OT";
        $tipoots = $this->tipoot_model->listar($filter);
        if($tipo=='') $tipo = isset($tipoots->cod_argumento)?$tipoots->cod_argumento:"";
        $fila   = "";
        $filter = new stdClass();
        $filter->tipoot = $tipo;
        if($ot!='')      $filter->nroot      = $ot;
        if($rsocial!='') $filter->codcliente = $rsocial;
        if($tipo=="04")  $filter->estado     = "P";
        $ots = $this->ot_model->listarg($filter,array('ot.nroOt'=>'asc'));         
        $tipoOt     = form_dropdown('tipo',$this->tipoot_model->seleccionar('',''),$tipo,"id='tipo' class='comboMedio' onchange='busca_tipoOt();'");   
        if(count($ots)>0){
            foreach($ots as $indice=>$value){
                $nroot  = $value->NroOt;
                $site   = $value->DirOt;
                $codcli = $value->CodCli;
                $codot  = $value->CodOt; 
                $finot  = $value->FinOt;
                $ftermino  = $value->FteOt;
                $razon_social = $tipo=='04'?$site:$value->razcli;
              // quitar esto { 
                $finot_envia = $tipo=='04'?date("d/m/Y",time()):$value->FinOt;
              // } 
                $fila .= "<tr   title='Fecha Termino: ".$ftermino."'     id='".$codot."' id2='".$tipo."'  id3='".$finot."' onclick='listadoot(this);'>";
                $fila .= "<td style='width:10%;' align='center'><p class='listadoot'>".$nroot."</p></td>";
                $fila .= "<td style='width:35%;' align='left'><p class='listadoot'>".$site."</p></td>";
                $fila .= "<td style='width:12%;' align='left'><p class='listadoot'>".$finot."</p></td>";
                $fila .= "<td style='width:12%;' align='left'><p class='listadoot'>".$ftermino."</p></td>";
                $fila .= "<td style='width:31%;' align='left'><p class='listadoot'>".$razon_social."</p></td>";
                $fila .= "</tr>";
            }
        }  
        else{
            $fila.="<tr>";
            $fila.="<td colspan='3'>NO EXISTEN RESULTADOS</td>";
            $fila.="</tr>";
        }
        $data['ot']   = $ot;
        $data['n']    = $n;
        $data['fila'] = $fila;
        $data['tipoot']  = $tipoOt;
        $data['rsocial'] = $rsocial;
        $this->load->view(ventas."ot_buscar",$data);  
    }
}