<?php

class Post_model extends My_model {

    private $__numeroposts = 10;

	public function __construct() {
        parent::__construct();
	}

	public function get_posts($seq = 1) {
        $query = $this->db->select('idpost,titulo,texto,post.iduser,nomeusuario,post.datacadastro');
        $query->order_by('post.datacadastro','desc');
        $query->join('user','post.iduser = user.iduser');
        $query->order_by('idpost','desc');
        return $query->get('post', 
             $this->__numeroposts , 
            $this->__numeroposts * ( $seq -1))->result_array();
	}

    public function get_post($id) {
        $query = $this->db->select('idpost,titulo,texto,post.iduser,nomeusuario,post.datacadastro');
        $query->where('idpost', $id);
        $query->join('user','post.iduser = user.iduser');
        $query->order_by('post.datacadastro','desc');
		return $query->get('post')->row();
	}
	
	public function get_posts_iduser($id, $seq = 1) {
        $query = $this->db->select('idpost,titulo,texto,post.iduser,nomeusuario,post.datacadastro');
        $query->where('user.iduser', $id);
        $query->join('user','post.iduser = user.iduser');
        $query->order_by('post.datacadastro','desc');
        $query->order_by('idpost','desc');
        return $query->get('post',
            $this->__numeroposts,
            $this->__numeroposts * ( $seq -1))->result_array();
	}

    public function get_posts_username($username){ // certeza que retorna os posts??
        return array();
    }

    public function gravar_post($params){
        return array( 'mensagem' => 'ok' , 'post' => $params);
    }
}
