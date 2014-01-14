<?php 

class Login_model extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function autenticar_user($username,$pass){
        $query = $this->db->from('login');
        $query->join('user' , 'user.iduser = login.iduser');
        $query->where('nomeusuario' , $username);
        $query->where('senha' , $pass);
        return $query->get()->row();
    }
?>
