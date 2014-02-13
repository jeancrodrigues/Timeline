<?php

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_users() {
        $query = $this->db->get('user');
        return $query->result_array();
    }

    public function get_users_by_name($name) {
        $query = $this->db->like('nome', $name, 'after');
        return $query->get('user')->result_array();
    }

    public function get_user($id) {
        $query = $this->db->where('iduser', $id);
        return $query->get('user')->row();
    }

    public function gravar_user($usuario) {
        if ($this->valida_user($usuario)) {
            $this->db->trans_start();
            $dadosUser = array('nome' => element('nome', $usuario), 'email' => element('email', $usuario),
                'datanascimento' => element('datanascimento', $usuario), 'sexo' => element('sexo', $usuario),
                'nomeusuario' => element('nomeusuario', $usuario));
            $this->db->insert('user', $dadosUser);
            $id = $this->db->insert_id();
            $dadosLogin = array('senha' => element('senha', $usuario), 'iduser' => $id);
            $this->db->insert('login', $dadosLogin);
            $this->db->trans_complete();

            if ($this->db->trans_status() === TRUE) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    private function valida_user($usuario) {
        return true;
    }

}

?>
