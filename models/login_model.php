<?php 

class Login_model extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    public function autenticar_user($username,$pass){
        $query = $this->db->from('login');
        $query->join('user' , 'user.iduser = login.iduser');
        $query->where('nomeusuario' , $username);
        $res = $query->get();
        if($res->count_all_results() === 1 ){
            if($res->row()["senha"] === $pass){
                return $res->row();
            }else{
                $this->session->set_flashdata('mensagensvalidacao' , array('mensagem' => 'Senha inválida'));
            }
        }else{
            $this->session->set_flashdata('mensagensvalidacao' , array('mensagem' => 'Usuário não existe'));
        }
    }
?>
