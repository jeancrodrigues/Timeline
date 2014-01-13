<?php

class Post extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('post_model');
    }

	public function index() {

		echo "<h2>please get another resource!!</h2>";
	}

	public function list_posts() {
		$this -> load -> view('json', array('data' => $this -> post_model -> get_posts()));
	}

	public function post_by_id() {
		$id = $this -> uri -> segment(2);
		if (isset($id)) {
			$this -> load -> view('json', array('data' => $this -> post_model -> get_post($id)));
		}
	}
	
	public function posts_by_iduser() {
		$id = $this -> uri -> segment(2);
		if (isset($id)) {
			$this -> load -> view('json', array('data' => $this -> post_model -> get_posts_iduser($id)));
		}
	}
}
