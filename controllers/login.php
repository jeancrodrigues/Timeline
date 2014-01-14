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
            
            if( count($params) === 2 and ( isset($params['username']) or isset($params['email'])) and isset($params['pass']) ){
                $user = $this->user_model->autenticar_user($params['username'],$params['pass']);
                $this->session->set_userdata($user);
                $this->return_json_view($this->session->all_userdata());
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
}
?>
