<?php

class Post extends My_controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('post_model');
    }

    public function index(){
        if($this->_httpmethod === 'post'){

        }else{
            $this->return_json_view(array(
                'mensagem' => 'Url inválida.'
            ));
        }
	}

	public function list_posts() {
		$this->return_json_view($this->post_model->get_posts());
	}

	public function post_by_id() {
		$id = $this->uri->segment(2);
        if (isset($id)) {
			$this->return_json_view($this->post_model->get_post($id));
		}
	}
	
	public function posts_by_iduser() {
		$id = $this->uri->segment(2);
        if (isset($id)) {
			$this->return_json_view($this->post_model->get_posts_iduser($id));
		}
	}
}
