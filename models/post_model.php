<?php

class Post_model extends My_model {

    private $__numeroposts = 5;

	public function __construct() {
		parent::__construct();
	}

	public function get_posts($seq = 1) {
        $query = $this->db->order_by('datacadastro','desc');
        $query->order_by('idpost','desc');
        $query->get('post', 
            0 + ( $this->__numeroposts * $seq -1 ) , // inicio
            $this->__numeroposts * $seq); // fim
        return $query->result_array();
	}

	public function get_post($id) {
		$query = $this->db->where('idpost', $id);
		return $query->get('post')->row();
	}
	
	public function get_posts_iduser($id, $seq = 1) {
        $query = $this->db->where('iduser', $id);
        $query->order_by('datacadastro','desc');
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
