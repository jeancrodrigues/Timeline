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

    public function autenticar_user($username,$pass){
        $query = $this->db->from('login');
        $query->join('user' , 'user.iduser = login.iduser');
        $query->where('nomeusuario' , $username);
        $query->where('senha' , $pass);
        return $query->get()->row();
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
