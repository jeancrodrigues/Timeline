<?php 
class User_model extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get_users(){
        $query = $this->db->get('user');
        return $query->result_array();
    }

    public function get_users_by_name($name){
        $query = $this->db->like('nome',$name,'after');
        return $query->get('user')->result_array(); 
    }

    public function get_user($id){
        $query = $this->db->where('iduser',$id);
        return $query->get('user')->row();
    }

    public function gravar_user($usuario){
        if($this->valida_user($usuario)){
            $query = $this->db->insert('user',$usuario);
        }
    }

    private function valida_user($usuario){
        return true;
    }
}
?>
