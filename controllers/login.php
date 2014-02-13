<?php
class Login extends My_controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('login_model');
    }

    public function index(){
        if($this->_httpmethod === 'post'){
            $params = $this->input->post(null,true);
            
            if( count($params) === 2 and (isset($params['username']) or isset($params['email'])) and isset($params['pass']) ){
                $this->return_json_view( $this->login_usuario($params['username'],$params['pass']) );
            }else{
                $this->return_json_view( array(
                    'mensagem' => 'Parametros inválidos',
                    'post' => $params
                ));
            }
        }else{
            $this->return_json_view(array(
                'mensagem'=>'Url inválida'
            ));
        }
    } 
    
    private function login_usuario($usuario,$senha){
        $user = $this->login_model->autenticar_user($usuario,$senha);
        if($user){
            return $user;        
        }else{
            return array('mensagem' => $this->login_model->get_mensagem_validacao()); 
        }
    }   
}
?>
