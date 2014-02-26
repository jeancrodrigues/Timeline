<?php

class Post_model extends My_model {

    private $__numeroposts = 10;

    public function __construct() {
        parent::__construct();
        $this -> load -> helper('array');
        $this->load->database();
    }

    public function get_posts($seq = 1) {
        $query = $this->db->select('idpost,titulo,texto,post.iduser,nomeusuario,post.datacadastro');
        $query->order_by('post.datacadastro', 'desc');
        $query->join('user', 'post.iduser = user.iduser');
        $query->order_by('idpost', 'desc');
        return $query->get('post', $this->__numeroposts, $this->__numeroposts * ( $seq - 1))->result_array();
    }

    public function get_posts_recentes($idpost){
        $query = $this->db->select('idpost,titulo,texto,post.iduser,nomeusuario,post.datacadastro');
        $query->join('user', 'post.iduser = user.iduser');
        $query->where('idpost>',$idpost);
        $query->order_by('post.datacadastro', 'desc');
        $query->order_by('idpost', 'desc');
        return $query->get('post')->result_array();
    }

    public function get_post($id) {
        $query = $this->db->select('idpost,titulo,texto,post.iduser,nomeusuario,post.datacadastro');
        $query->where('idpost', $id);
        $query->join('user', 'post.iduser = user.iduser');
        $query->order_by('post.datacadastro', 'desc');
        return $query->get('post')->row();
    }

    public function get_posts_iduser($id, $seq = 1) {
        $query = $this->db->select('idpost,titulo,texto,post.iduser,nomeusuario,post.datacadastro');
        $query->where('user.iduser', $id);
        $query->join('user', 'post.iduser = user.iduser');
        $query->order_by('post.datacadastro', 'desc');
        $query->order_by('idpost', 'desc');
        return $query->get('post')->result_array();
    }

    public function get_posts_username($username) { // certeza que retorna os posts??
        return array();
    }

    public function gravar_post($params) {
        if ($this->valida_post($params)) {
            $this->db->trans_start();
            $dadosPost = array('iduser' => element('iduser', $params), 'titulo' => element('titulo', $params),
                'texto' => element('texto', $params));
            $this->db->insert('post', $dadosPost);
            $this->db->trans_complete();

            if ($this->db->trans_status() === TRUE) {
                return true;
            }else{
                return array('mensagem' => 'Game Over', 'post' => $params);
            }
        }
    }

    private function valida_post($params) {
        $this->form_validation->set_rules('titulo', 'titulo', 'trim|required|max_lenght[50]|ucwords');
        $this->form_validation->set_rules('texto', 'texto', 'trim|required|max_lenght[500]');
        $this->form_validation->set_rules('iduser', 'iduser', 'trim|required|strtolower|integer');

        if ($this->form_validation->run() == TRUE) {
            return true;
        } else {
            $this->put_mensagem_validacao(explode(',', validation_errors(',', ' ')));
            return false;
        }
    }

}
