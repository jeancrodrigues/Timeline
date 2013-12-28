<?php
class User extends CI_controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('user_model');
    }
    
    public function index(){
        echo "<h2>please get another resource</h2>";
    }

    public function list_users(){
         $this->load->view('user_json',array(
            'user' => $this->user_model->get_users()
        ));
    }

    public function user_by_id(){
        $id = $this->uri->segment(2);
        if(isset($id)){
            $this->load->view('user_json' , array(
                'user' => $this->user_model->get_user($id)
            ));
        }
    }
}
?>
