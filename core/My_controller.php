<?php
abstract class My_controller extends CI_controller{

    protected $_httpmethod;

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->_options();
        $this->_httpmethod = strtolower($this->input->server('REQUEST_METHOD'));
     }

    protected function return_json_view($data){
        $this->load->view('json', array('data'=>$data));
    }
    
    private function _options() {
        $this->output->set_header('Access-Control-Allow-Origin: *');
        $this->output->set_header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS' );
        $this->output->set_header('Access-Control-Allow-Headers: content-type' );
        $this->output->set_content_type('application/json');
    }

    protected function autenticar_post(){
        $id = $this->input->post('iduser',true);
        $token = $this->input->post('token',true);
        $this->load->model('login_model');
        return $this->login_model->valida_token_usuario($id,$token);        
    }
}
?>
