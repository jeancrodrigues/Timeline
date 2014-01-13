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
         $this->load->view('json',array(
            'data' => $this->user_model->get_users()
        ));
    }
    
    public function user_by_id(){
        $id = $this->uri->segment(2);
        if(isset($id)){
            $this->load->view('json' , array(
                'data' => $this->user_model->get_user($id)
            ));
        }
    }
	
	public function user_by_name(){
		$name = $this->uri->segment(2);
        if(isset($name)){
            $this->load->view('json' , array(
                'data' => $this->user_model->get_users_by_name($name)
            ));
        }
	}
	
	public function update_user() {
			$dados = elements('nome',$this->input->post());
			$cond = $this->input->post('idusuario');
			$this->user_model->do_update($dados,$cond);
	}
}
?>
