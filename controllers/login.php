<?php
class Login extends CI_controller{
    public function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->model('user_model');
    }

    public function index(){
        #if(strtolower($this->input->server('REQUEST_METHOD')) === 'post'){
        $params = $this->input->post(null,true);
        if( count($params) === 2 and ( isset($params['username']) or isset($params['email'])) and isset($params['pass']) ){

            $user = $this->user_model->autenticar_user($params['username'],$params['pass']);
            $this->session->set_userdata($user);
            $this->load->view('json', array( 'data' => $this->session->all_userdata() ));
            
        }else{
            $this->load->view('json', array( 'data' => array(
                'mensagem' => 'Parametros inválidos'
            )));
        }
    }    
}
?>
