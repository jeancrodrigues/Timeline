<?php
abstract class My_controller extends CI_controller{

    protected $_usuariologado;

    public function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->_options();
     }

    private function _options() {
        $this->output->set_header( 'Access-Control-Allow-Origin: *' );
        $this->output->set_header( "Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS" );
        $this->output->set_header( 'Access-Control-Allow-Headers: content-type' );
//        $this->output->set_content_type( 'application/json' );
//        $this->output->set_output( "*" );
    }

    protected function _check_login(){
        $this->_usuariologado = $this->session->userdata('usuario');
        if(!$this->_usuariologado){
            
        }
    }

    protected function _display_login_msg(){
        $this->load->view('json', array(
            'data' => array(
                'msg' => 'Usuário não está logado',
                'code' => 401
            )
        ));
    }
}
?>
