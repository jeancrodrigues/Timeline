<?php

class Post_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public function get_posts() {
        $query = $this->db->from('post');
        $query->order_by('datacadastro','desc');
        $query->limit(25);
        return $query->get()->result_array();
	}

	public function get_post($id) {
		$query = $this->db->where('idpost', $id);
		return $query->get('post')->row();
	}
	
	public function get_posts_iduser($id) {
		$query = $this->db->where('iduser', $id);
		return $query->get('post')->result_array();
	}

    public function get_posts_username(){ // certeza que retorna os posts??
        $this->db->from('user');
        $this->db->join('login', 'user.iduser = login.iduser','inner');
		return $this->db->get();
    }
}
