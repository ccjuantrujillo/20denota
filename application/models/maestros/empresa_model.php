<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Empresa_model extends CI_Model
{
    var $compania;
    var $table;  
    public function __construct()
    {
        parent::__construct();
        $this->compania = $this->session->userdata('compania');
        $this->table   = "empresa";
    }
    
    public function listar_sucursalesEmpresa($empresa){
        $where = array("cji_emprestablecimiento.EMPRP_Codigo"=>$empresa,"EESTABC_FlagEstado"=>1,"EESTABC_FlagTipo"=>0);
        
        $query = $this->db->order_by('EESTABC_Descripcion')
                          ->join('cji_ubigeo', 'cji_ubigeo.UBIGP_Codigo = cji_emprestablecimiento.UBIGP_Codigo', 'left')
                          ->join('cji_tipoestablecimiento', 'cji_tipoestablecimiento.TESTP_Codigo = cji_emprestablecimiento.TESTP_Codigo', 'left')
                          ->where($where)
                          ->select('cji_emprestablecimiento.*, cji_ubigeo.UBIGC_Descripcion UBIGC_Descripcion, cji_tipoestablecimiento.TESTC_Descripcion TESTC_Descripcion')
                          ->from('cji_emprestablecimiento')
                          ->get();
        if($query->num_rows>0){
            foreach($query->result() as $fila){
                $data[] = $fila;
            }
            return $data;
        }
    }
    public function listar_contactosEmpresa($empresa){
        $where = array('ECONC_FlagEstado'=>'1','cji_emprcontacto.EMPRP_Codigo'=>$empresa);
        
        $query = $this->db->order_by('cji_emprcontacto.ECONP_Contacto')
                            ->join('cji_persona', 'cji_persona.PERSP_Codigo = cji_emprcontacto.ECONC_Persona', 'left')
                            ->join('cji_directivo', 'cji_directivo.EMPRP_Codigo = cji_emprcontacto.EMPRP_Codigo and cji_directivo.PERSP_Codigo=cji_emprcontacto.ECONC_Persona', 'left')
                            ->join('cji_cargo', 'cji_cargo.CARGP_Codigo = cji_directivo.CARGP_Codigo', 'left')
                            ->join('cji_emprarea', 'cji_emprarea.EMPRP_Codigo = cji_emprcontacto.EMPRP_Codigo and cji_emprarea.DIREP_Codigo=cji_directivo.DIREP_Codigo', 'left')
                            ->join('cji_area', 'cji_area.AREAP_Codigo = cji_emprarea.AREAP_Codigo', 'left')
                            ->where($where)
                            ->group_by('cji_emprcontacto.ECONP_Contacto')
                            ->from('cji_emprcontacto')
                            ->select('cji_emprcontacto.*, cji_persona.PERSC_Nombre , cji_persona.PERSC_ApellidoPaterno , 
                                   cji_persona.PERSC_ApellidoMaterno, cji_area.AREAP_Codigo  AREAP_Codigo,
                                   cji_area.AREAC_Descripcion AREAC_Descripcion,cji_cargo.CARGC_Descripcion  CARGC_Descripcion')
                            ->get();

        if($query->num_rows>0){
            foreach($query->result() as $fila){
                $data[] = $fila;
            }
            return $data;
        }
    }
    public function listar_areasEmpresa($empresa){
        $query = $this->db->order_by('EAREAC_Descripcion')->where('EAREAC_FlagEstado','1','EMPRP_Codigo',$empresa)->get('cji_emprarea');
        if($query->num_rows>0){
            foreach($query->result() as $fila){
                $data[] = $fila;
            }
            return $data;
        }
    }
    public function listar_empresas(){
        $query = $this->db->order_by('EMPRC_RazonSocial')->where('EMPRC_FlagEstado','1')->get('cji_empresa');
        if($query->num_rows>0){
            foreach($query->result() as $fila){
                $data[] = $fila;
            }
            return $data;
        }
    }
    public function buscar_empresas($filter,$number_items='',$offset='')
    {       
        if(isset($filter->EMPRC_Ruc) && $filter->EMPRC_Ruc!="")
            $this->db->where('EMPRC_Ruc',$filter->EMPRC_Ruc);
        if(isset($filter->EMPRC_RazonSocial) && $filter->EMPRC_RazonSocial!="")
            $this->db->like('EMPRC_RazonSocial',$filter->EMPRC_RazonSocial);
        if(isset($filter->EMPRC_Telefono) && $filter->EMPRC_Telefono!="")
            $this->db->like('EMPRC_Telefono',$filter->EMPRC_Telefono)->or_like('EMPRC_Movil',$filter->EMPRC_Telefono);
        
        $query = $this->db->order_by('EMPRC_RazonSocial')
                          ->where('EMPRC_FlagEstado','1')
                          ->get('cji_empresa',$number_items='',$offset='');
        if($query->num_rows>0){
            foreach($query->result() as $fila){
                    $data[] = $fila;
            }
            return $data;
        }
    }
    public function obtener_datosEmpresa($empresa){
        $query = $this->db->where('EMPRP_Codigo',$empresa)->get('cji_empresa');
        if($query->num_rows>0){
            foreach($query->result() as $fila){
                    $data[] = $fila;
            }
            return $data;
        }
    }
    public function obtener_datosEmpresa2($ruc){
        $query = $this->db->where('EMPRC_Ruc',$ruc)->where('EMPRC_FlagEstado','1')->get('cji_empresa');
        if($query->num_rows>0){
            foreach($query->result() as $fila){
                $data[] = $fila;
            }
            return $data;
        }
    }
    public function obtener_establecimientoEmpresa($empresa,$tipo_establecimiento){
        $where = array("EMPRP_Codigo"=>$empresa,"TESTP_Codigo"=>$tipo_establecimiento);
        $query = $this->db->where($where)->get('cji_emprestablecimiento');
        if($query->num_rows>0){
            foreach($query->result() as $fila){
                    $data[] = $fila;
            }
            return $data;
        }
    }
    public function obtener_establecimientosEmpresa($empresa){
            $where = array("EMPRP_Codigo"=>$empresa,"EESTABC_FlagEstado"=>1);
            $query = $this->db->order_by('EESTABC_Descripcion')->where($where)->get('cji_emprestablecimiento');
            if($query->num_rows>0){
                    foreach($query->result() as $fila){
                            $data[] = $fila;
                    }
                    return $data;
            }
    }
    public function obtener_establecimientosEmpresa_principal($empresa){
            $where = array("EMPRP_Codigo"=>$empresa,"EESTABC_FlagEstado"=>1,"EESTABC_FlagTipo"=>1);
            $query = $this->db->order_by('EESTABC_Descripcion')->where($where)->get('cji_emprestablecimiento');
            if($query->num_rows>0){
                    foreach($query->result() as $fila){
                            $data[] = $fila;
                    }
                    return $data;
            }
    }
    public function obtener_contactoEmpresa($empresa){
            $where = array('ECONC_FlagEstado'=>'1','EMPRP_Codigo'=>$empresa);
            $query = $this->db->order_by('ECONP_Contacto')->where($where)->get('cji_emprcontacto');
            if($query->num_rows>0){
                foreach($query->result() as $fila){
                        $data[] = $fila;
                }
                return $data;
            }
    }
    public function obtener_areaEmpresa($empresa,$directivo){
            $where = array('EMPRP_Codigo'=>$empresa,'DIREP_Codigo'=>$directivo);
            $query = $this->db->where($where)->get('cji_emprarea');
            if($query->num_rows>0){
                    foreach($query->result() as $fila){
                            $data[] = $fila;
                    }
                    return $data;
            }
    }


    public function insertar_datosEmpresa($tipocodigo, $ruc,$razon_social,$telefono,$fax,$web,$movil,$email){
            $data = array(
                                    "TIPCOD_Codigo"    => $tipocodigo,
                                    "EMPRC_Ruc"        => $ruc,
                                    "EMPRC_RazonSocial"=> strtoupper($razon_social),
                                    "EMPRC_Telefono"   => $telefono,
                                    "EMPRC_Movil"      => $movil,
                                    "EMPRC_Fax"        => $fax,
                                    "EMPRC_Web"        => strtolower($web),
                                    "EMPRC_Email"      => strtolower($email)
                                    );
            $this->db->insert("cji_empresa",$data);
            return $this->db->insert_id();
    }


    public function insertar_sucursalEmpresa($tipo_establecimiento,$empresa,$ubigeo,$descripcion,$direccion){
            $this->db->set('TESTP_Codigo',$tipo_establecimiento);
            $this->db->set('EMPRP_Codigo',$empresa);
            $this->db->set('UBIGP_Codigo',$ubigeo);
            $this->db->set('EESTABC_Descripcion',strtoupper($descripcion));
            $this->db->set('EESTAC_Direccion',strtoupper($direccion));
            $this->db->insert('cji_emprestablecimiento');
    }
    public function insertar_sucursalEmpresaPrincipal($tipo_establecimiento,$empresa,$ubigeo,$descripcion,$direccion){
            $this->db->set('TESTP_Codigo',$tipo_establecimiento);
            $this->db->set('EMPRP_Codigo',$empresa);
            $this->db->set('UBIGP_Codigo',$ubigeo);
            $this->db->set('EESTABC_Descripcion',strtoupper($descripcion));
            $this->db->set('EESTAC_Direccion',strtoupper($direccion));
            $this->db->set('EESTABC_FlagTipo','1');
            $this->db->insert('cji_emprestablecimiento');
    }
    public function insertar_contactoEmpresa($empresa,$descripcion,$telefono,$movil,$email,$persona){
            $data = array(
                                    "EMPRP_Codigo"      => $empresa,
                                    "ECONC_Descripcion" => strtoupper($descripcion),
                                    "ECONC_Telefono"    => $telefono,
                                    "ECONC_Movil"       => $movil,
                                    "ECONC_Email"       => $email,
                                    "ECONC_Persona"     => $persona
                                    );
            $this->db->insert("cji_emprcontacto",$data);
    }
    public function insertar_directivoEmpresa($empresa,$persona,$cargo){
            $data = array(
                                    "EMPRP_Codigo" => $empresa,
                                    "PERSP_Codigo" => $persona,
                                    "CARGP_Codigo" => $cargo
                                    );
            $this->db->insert("cji_directivo",$data);
            return $this->db->insert_id();
    }
    public function insertar_areaEmpresa($area,$empresa,$directivo,$descripcion){
            $data = array(
                                    "AREAP_Codigo"       => $area,
                                    "EMPRP_Codigo"       => $empresa,
                                    "DIREP_Codigo"       => $directivo,
                                    "EAREAC_Descripcion" => strtoupper($descripcion)
                                    );
            $this->db->insert("cji_emprarea",$data);
    }
    public function modificar_datosEmpresa($empresa, $tipocodigo, $ruc,$razon_social,$telefono,$movil,$fax,$web,$email){
        $data = array(
                    "TIPCOD_Codigo"     => $tipocodigo,
                    "EMPRC_Ruc"         => $ruc,
                    "EMPRC_RazonSocial" => strtoupper($razon_social),
                    "EMPRC_Telefono"    => $telefono,
                    "EMPRC_Movil"       => $movil,
                    "EMPRC_Fax"         => $fax,
                    "EMPRC_Web"         => strtolower($web),
                    "EMPRC_Email"       => strtolower($email)
                     );
        $this->db->where("EMPRP_Codigo",$empresa);
        $this->db->update("cji_empresa",$data);
    }
    public function modificar_sucursalEmpresa($empresa_sucursal,$tipo_establecimiento,$ubigeo,$nombre_sucursal,$direccion){
            $data = array(
                                     "UBIGP_Codigo"        =>$ubigeo,
                                     "EESTABC_Descripcion" =>strtoupper($nombre_sucursal),
                                     "EESTAC_Direccion"    =>$direccion,
                                     "TESTP_Codigo"        =>$tipo_establecimiento
                                     );
            $where = array("EESTABP_Codigo"=>$empresa_sucursal);
            $this->db->where($where);
            $this->db->update("cji_emprestablecimiento",$data);
    }
    public function modificar_sucursalEmpresa2($empresa,$tipo_sucursal,$ubigeo,$descripcion,$direccion){
            $data = array(
                                     "UBIGP_Codigo"        =>$ubigeo,
                                     "EESTABC_Descripcion" =>strtoupper($descripcion),
                                     "EESTAC_Direccion"    =>$direccion
                                     );
            $where = array("EMPRP_Codigo"=>$empresa,"TESTP_Codigo"=>$tipo_sucursal);
            $this->db->where($where);
            $this->db->update("cji_emprestablecimiento",$data);
    }
    public function modificar_sucursalEmpresaPrincipal($empresa,$tipo_sucursal,$ubigeo,$descripcion,$direccion){
            $data = array(
                         "UBIGP_Codigo"        =>$ubigeo,
                         "EESTABC_Descripcion" =>strtoupper($descripcion),
                         "EESTAC_Direccion"    =>$direccion
                         );
            print_r($data);
            $where = array("EMPRP_Codigo"=>$empresa,"TESTP_Codigo"=>$tipo_sucursal,"EESTABC_FlagTipo"=>'1');
            $this->db->where($where);
            $this->db->update("cji_emprestablecimiento",$data);
    }
    public function modificar_contactoEmpresa($empresa,$descripcion,$persona,$telefono,$movil,$fax,$email){
            $data  = array("ECONC_Descripcion"=>$descripcion,"ECONC_Telefono"=>$telefono,"ECONC_Movil"=>$movil,"ECONC_Fax"=>$fax,"ECONC_Email"=>$email);
            $where = array("EMPRP_Codigo"=>$empresa,"ECONC_Persona"=>$persona);
            $this->db->where($where);
            $this->db->update("cji_emprcontacto",$data);
    }
    public function modificar_areaEmpresa($empresa,$directivo,$area,$descripcion){
            $data  = array("AREAP_Codigo"=>$area,"EAREAC_Descripcion"=>$descripcion);
            $where = array("EMPRP_Codigo"=>$empresa,"DIREP_Codigo"=>$directivo);
            $this->db->where($where);
            $this->db->update('cji_emprarea',$data);
    }
    public function modificar_directivoEmpresa($empresa,$persona,$cargo){
            $data  = array("CARGP_Codigo"=>$cargo);
            $where = array("EMPRP_Codigo"=>$empresa,"PERSP_Codigo"=>$persona);
            $this->db->where($where);
            $this->db->update('cji_directivo',$data);
    }
    /*Eliminar*/
    public function eliminar_sucursalEmpresa($sucursal){
        $this->db->delete('cji_emprestablecimiento',array('EESTABP_Codigo' => $sucursal));
    }
    public function eliminar_empresarContacto($empresa,$persona,$directivo){
            //Elimino de empresacontacto
            $data  = array("ECONC_FlagEstado"=>'0');
            $where = array("EMPRP_Codigo"=>$empresa,"ECONC_Persona"=>$persona);
            $this->db->where($where);
            $this->db->update('cji_emprcontacto',$data);
            //Elimino de directivo
            $data  = array("DIREC_FlagEstado"=>'0');
            $where = array("EMPRP_Codigo"=>$empresa,"PERSP_Codigo"=>$persona);
            $this->db->where($where);
            $this->db->update('cji_directivo',$data);
            //Elimino de empresarea
            $data  = array("EAREAC_FlagEstado"=>'0');
            $where = array("EMPRP_Codigo"=>$empresa,"DIREP_Codigo"=>$directivo);
            $this->db->where($where);
            $this->db->update('cji_emprarea',$data);
            //Elimino de persona
            $data  = array("PERSC_FlagEstado"=>'0');
            $where = array("PERSP_Codigo"=>$persona);
            $this->db->where($where);
            $this->db->update('cji_persona',$data);
    }
    public function eliminar_areaEmpresa($empresa,$area){

    }
    public function eliminar_empresa_total($empresa){
            $this->eliminar_empresa($empresa);
            $this->eliminar_empresaContacto($empresa);
            $this->eliminar_empresaArea($empresa);
            $this->eliminar_empresaSucursal($empresa);
    }
    public function eliminar_empresaSucursal($empresa){
            $data  = array("EESTABC_FlagEstado"=>'0');
            $where = array("EMPRP_Codigo"=>$empresa);
            $this->db->where($where);
            $this->db->update('cji_emprestablecimiento',$data);
    }
    public function eliminar_empresa($empresa){
            $data  = array("EMPRC_FlagEstado"=>'0');
            $where = array("EMPRP_Codigo"=>$empresa);
            $this->db->where($where);
            $this->db->update('cji_empresa',$data);
    }
    public function eliminar_empresaContacto($empresa){
            $data  = array("ECONC_FlagEstado"=>'0');
            $where = array("EMPRP_Codigo"=>$empresa);
            $this->db->where($where);
            $this->db->update('cji_emprcontacto',$data);
    }
    public function eliminar_empresaArea($empresa){
            $data  = array("EAREAC_FlagEstado"=>'0');
            $where = array("EMPRP_Codigo"=>$empresa);
            $this->db->where($where);
            $this->db->update('cji_emprarea',$data);
    }
    public function eliminar_empresaDirectivo($empresa){
            $data  = array("DIREC_FlagEstado"=>'0');
            $where = array("EMPRP_Codigo"=>$empresa);
            $this->db->where($where);
            $this->db->update('cji_directivo',$data);
    }
    
    /*public function buscar_empresa($ruc,$razon_social, $telefono=''){
    $this->db->select('*');
    $this->db->from('cji_empresa');
    $this->db->join('cji_emprcontacto','cji_emprcontacto.EMPRP_Codigo=cji_empresa.EMPRP_Codigo','left');
   $this->db->like('cji_empresa.EMPRC_Ruc',$ruc);
    $this->db->or_like('cji_empresa.EMPRC_RazonSocial',$razon_social,'after');
   //$this->db->or_like('cji_emprcontacto.ECONC_Telefono',$telefono,'after');
   //$this->db->or_like('cji_emprcontacto.ECONC_Movil',$telefono,'after');
            $query = $this->db->get();
            if($query->num_rows>0){
                    foreach($query->result() as $fila){
                            $data[] = $fila;
                    }
                    return $data;
            }
    }*/
    /*varios*/
    public function busca_xnumeroDoc($tipo_docummento, $numero_documento){
            
            $query = $this->db->where('TIPCOD_Codigo',$tipo_docummento)->where('EMPRC_Ruc',$numero_documento)->get('cji_empresa');
            if($query->num_rows>0){
                    foreach($query->result() as $fila){
                            $data[] = $fila;
                    }
                    return $data;
            }
    }
}
?>