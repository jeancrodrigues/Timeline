<?php
class Login extends My_controller{
    public function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->model('user_model');
    }

    public function index(){
        if($this->_httpmethod === 'post'){
            $params = $this->input->post(null,true);
            if( count($params) === 2 and (isset($params['username']) or isset($params['email'])) and isset($params['pass']) ){
                $this->return_json_view($this->login_usuario($params['username'],$params['pass']));
            }else{
                $this->return_json_view( array(
                    'mensagem' => 'Parametros inválidos'
                ));
            }
        }else{
            $this->return_json_view(array(
                'mensagem'=>'Url inválida'
            ));
        }
    } 
    
    private function login_usuario($usuario,$senha){
        $user = $this->user_model->autenticar_user($usuario,$senha);
        if($user){
            $this->session->set_userdata('login',$user);
            // se o usuário for válido retorna o seu perfil 
            $this->return_json_view($user);        
        }else{
            $this->return_json_view($this->session->flashdata('mensagens_validacao')); 
        }
    }   
}
?>
