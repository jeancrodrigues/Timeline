<?php

class User_model extends My_model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_users() {
        $query = $this->db->get('user');
        return $query->result_array();
    }

    public function get_user_by_name($name) {
        $query = $this->db->like('nome', $name);
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
            }
        }
        return false;
    }

    private function valida_user($usuario) {
        $this->form_validation->set_rules('nome', 'nome', 'trim|required|max_lenght[30]|ucwords');
        $this->form_validation->set_rules('email', 'email', 'trim|required|max_lenght[50]|strtolower|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('nomeusuario', 'nome usuario', 'trim|required|max_lenght[25]|strtolower|is_unique[user.nomeusuario]');
        $this->form_validation->set_rules('sexo', 'sexo', 'trim|required|strtolupper|exact_length[1]|alpha');
        $this->form_validation->set_rules('senha', 'senha', 'trim|required|min_length[4]');

        if ($this->form_validation->run() == TRUE) {
            return true;
        } else {
            $this->put_mensagem_validacao(explode(',', validation_errors(',', ' ')));
            return false;
        }
    }
}

?>
