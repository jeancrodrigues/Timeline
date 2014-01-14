<?php
class User extends CI_controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('user_model');
        $this->output->set_header( 'Access-Control-Allow-Origin: *' );
        $this->output->set_header( 'Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS' );
        $this->output->set_header( 'Access-Control-Allow-Headers: content-type' );
    }

    private function return_json_view($data){
        $this->load->view('json', array('data'=>$data));
    }
    
    public function index(){
        if(strtolower($this->input->server('REQUEST_METHOD')) === 'post'){
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
<<<<<<< HEAD

    public function post_user(){
        $user = $this->input->post(null,true);
        var_dump($user);
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
=======
	
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
>>>>>>> 34e52e371173cb410b620dbac39bf8160d4b3262
}
?>
