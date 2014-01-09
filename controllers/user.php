<?php
class User extends My_controller {
    public function __construct(){
        parent::__construct();
        $this->_check_login();
        $this->load->model('user_model');
   }
    
    public function index(){
        echo "<h2>please get another resource</h2>";
    }

    public function list_users(){
        $name = $this->uri->segment(2);
        if(!$name){
            $this->load->view('json',array(
                'data' => [ 'user' => $this->user_model->get_users() ]
            ));
        }else{
            $this->load->view('json',array(
                'data' => [ 'user' => $this->user_model->get_users_by_name($name) ]
            ));
        }
    }

    public function user_by_username(){
        $name = $this->uri->segment(2);
        if(isset($name)){
            $this->load->view('json' , array(
                'data' => $this->user_model->get_user_by_username($name)
            ));
        }
    }

    public function user_by_id(){
        $id = $this->uri->segment(2);
        if(isset($id)){
            $this->load->view('json' , array(
                'data' => $this->user_model->get_user($id)
            ));
        }
    }
}

?>
