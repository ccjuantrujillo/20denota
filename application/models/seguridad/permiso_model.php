<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Permiso_model extends CI_Model{
    var $compania;
    var $table;
    public function __construct()
    {
        parent::__construct();
        $this->compania = $this->session->userdata('compania');
        $this->table    = "permiso";
        $this->tableref = "menu";
    }
    
    public function listar($filter,$filter_not='',$number_items='',$offset='')
    {
        $where  = array('CICLOP_Codigo'=>$this->compania,"PERM_FlagEstado"=>1,"MENU_FlagEstado"=>1);
        if(isset($filter->menu) && $filter->menu!='')       $where = array_merge($where,array("m.MENU_Codigo"=>$filter->menu));
        if(isset($filter->codigo) && $filter->codigo!='')   $where = array_merge($where,array("m.MENU_Codigo_Padre"=>$filter->codigo));
        if(isset($filter->rol) && $filter->rol!='')         $where = array_merge($where,array("p.ROL_Codigo"=>$filter->rol));
        $this->db->select('*');
        $this->db->from($this->table." as p",$number_items,$offset);
        $this->db->join($this->tableref." as m",'m.MENU_Codigo=p.MENU_Codigo');
        $this->db->where($where);
        if(isset($filter->order_by) && is_array($filter->order_by)){
            foreach($filter->order_by as $indice=>$value) $this->db->order_by($indice,$value);
        }  
        $query = $this->db->get();
        $resultado = array();
        if($query->num_rows>0){
            $resultado = $query->result();
        }
        return $resultado;
    }
    
//        function busca_permiso($rol, $menu){
//		$query = $this->db->where('ROL_Codigo',$rol)->where('MENU_Codigo', $menu)->get('cji_permiso');
//		if($query->num_rows>0){
//			foreach($query->result() as $fila){
//				$data[] = $fila;
//			}
//			return $data;
//		}
//                else
//                    return array();
//	}
//        public function insertar(stdClass $filter = null)
//        {
//            $this->db->insert("cji_permiso",(array)$filter);
//        }
//
//        public function eliminar_varios($rol)
//        {
//            $this->db->delete('cji_permiso',array('ROL_Codigo' => $rol));
//        }
//	public function obtener_permisosMenu($perfil_id){
//		$CI = get_instance();
//                $qu = $CI->db->from('cji_menu')
//                        ->join('cji_permiso','cji_permiso.MENU_Codigo  = cji_menu.MENU_Codigo ','inner')
//                        ->where('cji_permiso.ROL_Codigo',$perfil_id)
//                        ->where('MENU_Codigo_Padre',0)
//                        ->where('cji_menu.MENU_FlagEstado',1)
//                        ->get();
//                $rows = $qu->result();
//                
//                foreach($rows as $row){
//                    $qur = $CI->db->from('cji_menu')
//                        ->join('cji_permiso','cji_permiso.MENU_Codigo  = cji_menu.MENU_Codigo ','inner')
//                        ->where('cji_permiso.ROL_Codigo ',$perfil_id)
//                        ->where('MENU_Codigo_Padre',$row->MENU_Codigo)
//                        ->get();
//                     $row->submenus = $qur->result();
//                }
//                return $rows;
//	}
}
?>