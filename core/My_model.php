<?php 

class My_model extends CI_Model{
    public $mensagem_validacao = null;
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    
    public function get_mensagem_validacao(){
        $ret = $this->mensagem_validacao;
        $this->mensagem_validacao = null;
        return $ret;
    }

    public function put_mensagem_validacao($mensagem){
        if($mensagem){
            $this->mensagem_validacao = $mensagem;
        }
    }
}
?>
