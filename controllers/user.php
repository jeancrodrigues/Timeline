<?php
class User extends CI_controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('user_model');
    }
    
    public function index(){
        $this->load->view('user',array(
            'users' => $this->user_model->get_users()
        ));
    }
}
?>
