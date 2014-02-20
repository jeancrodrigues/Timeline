<?php

class Post_model extends My_model {

    private $__numeroposts = 10;

	public function __construct() {
        parent::__construct();
	}

	public function get_posts($seq = 1) {
        $query = $this->db->select('*');
        $query->order_by('post.datacadastro','desc');
        $query->join('user','post.iduser = user.iduser');
        $query->order_by('idpost','desc');
        return $query->get('post', 
            0 + ( $this->__numeroposts * $seq -1 ) , // inicio
            $this->__numeroposts * $seq)->result_array();
	}

    public function get_post($id) {
        $query = $this->db->select('*');
        $query->where('idpost', $id);
        $query->join('user','post.iduser = user.iduser');
        $query->order_by('post.datacadastro','desc');
		return $query->get('post')->row();
	}
	
	public function get_posts_iduser($id, $seq = 1) {
        $query = $this->db->select('*');
            #'idpost','titulo','texto','iduser','nomeusuario','post.datacadastro');
        $query->where('iduser', $id);
        $query->order_by('post.datacadastro','desc');
        $query->order_by('idpost','desc');
        return $query->get(
            'post', 
            0 + ( $this->__numeroposts * $seq -1 ) ,
            $this->__numeroposts * $seq
        )->result_array();
	}

    public function get_posts_username($username){ // certeza que retorna os posts??
        return array();
    }
}
