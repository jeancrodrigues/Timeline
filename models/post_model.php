<?php
class Post_model extends CI_Model {
	public function __construct() {
		parent::__construct();

	}

	public function get_posts() {
		$query = $this -> db -> get('post');
		return $query -> result_array();
	}

	public function get_post($id) {
		$query = $this -> db -> where('idpost', $id);
		return $query -> get('post') -> row(); 

	}
	
	public function get_posts_iduser($id) {
		$query = $this -> db -> where('iduser', $id);
		return $query -> get('post') -> result_array(); 

	}

    public function get_posts_username(){
    	 $this->db->from('user');
        $this->db->join('login', 'user.iduser = login.iduser','inner');
		return $this -> db -> get();
    }
	public function gravar_user($usuario) {
		if ($this -> valida_user($usuario)) {
			$query = $this -> db -> insert('user', $usuario);
		}
	}

	private function valida_user($usuario) {
		return true;
	}

}
