<?php
class User extends My_controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('user_model');
    }   
    
    public function index(){
        if($this->_httpmethod === 'post'){
            $post = $this->input->post(NULL,TRUE);
            $this->return_json_view(array('mensagem' => 'ok','user' => $post));
        }else{
            $this->return_json_view( array('mensagem' => 'Url inválida') );
        }
    }
    
    public function user_by_id(){
        $id = $this->uri->segment(2);
        if(isset($id)){
            $this->return_json_view($this->user_model->get_user($id));
        }
    }

    public function list_users(){
        $name = $this->uri->segment(2);
        if(!$name){
            $this->return_json_view($this->user_model->get_users());
        }else{
            $this->return_json_view($this->user_model->get_users_by_name($name));
        }
    }

    public function user_by_username(){
        $name = $this->uri->segment(2);
        if(isset($name)){
            $this->return_json_view($this->user_model->get_user_by_username($name));
        }
    } 
	
	public function user_by_name(){
		$name = $this->uri->segment(2);
        if(isset($name)){
            $this->return_json_view($this->user_model->get_users_by_name($name));
        }
	}
	
	public function update_user() {
			$dados = elements('nome',$this->input->post());
			$cond = $this->input->post('idusuario');
			$this->user_model->do_update($dados,$cond);
	}
}
?>
